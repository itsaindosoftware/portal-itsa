<?php

namespace App\Http\Controllers;
use App\Requestdar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\FileBag;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Validator;
use Storage;

class RequestdarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        Carbon::setLocale('id');
    }
    public function index(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        if ($request->ajax()) {
            if (Auth::user()->hasPermission('manage-dar-system')) {
                if (Auth::user()->hasRole('admin')) {
                    $data = Requestdar::query();
                } elseif (Auth::user()->hasRole('user-employee')) {
                    $data = DB::connection('dar-system')->table('request_dar')->leftJoin('users', 'request_dar.user_id', '=', 'users.id')
                        ->leftJoin('departments', 'request_dar.dept_id', '=', 'departments.id')
                        ->leftJoin('companys', 'request_dar.company_id', '=', 'companys.id')
                        ->leftJoin('positions', 'request_dar.position_id', '=', 'positions.id')
                        ->leftJoin('type_of_reqforms', 'request_dar.typereqform_id', '=', 'type_of_reqforms.id')
                        ->leftJoin('request_desc', 'request_dar.request_desc_id', '=', 'request_desc.id')
                        ->select(
                            'request_dar.*',
                            'request_dar.id as reqdar_id',
                            'users.*',
                            'departments.description as department',
                            'companys.company_desc as company',
                            'positions.position_desc as position',
                            'type_of_reqforms.request_type as reqtype',
                            'request_desc.request_descript'
                        )
                        ->where('request_dar.nik_req', Auth::user()->nik)->get();
                } elseif(Auth::user()->hasRole('manager')){

                    $data = DB::connection('dar-system')->table('request_dar')->leftJoin('users', 'request_dar.user_id', '=', 'users.id')
                        ->leftJoin('departments', 'request_dar.dept_id', '=', 'departments.id')
                        ->leftJoin('companys', 'request_dar.company_id', '=', 'companys.id')
                        ->leftJoin('positions', 'request_dar.position_id', '=', 'positions.id')
                        ->leftJoin('type_of_reqforms', 'request_dar.typereqform_id', '=', 'type_of_reqforms.id')
                        ->leftJoin('request_desc', 'request_dar.request_desc_id', '=', 'request_desc.id')
                        ->select(
                            'request_dar.*',
                            'request_dar.id as reqdar_id',
                            'users.*',
                            'departments.description as department',
                            'companys.company_desc as company',
                            'positions.position_desc as position',
                            'type_of_reqforms.request_type as reqtype',
                            'request_desc.request_descript'
                        )
                        ->where('request_dar.nik_atasan', Auth::user()->nik);

                    if ($request->has('date_range') && !empty($request->date_range)) {
                        $dateRange = explode(' - ', $request->date_range);
                        if (count($dateRange) == 2) {
                            $data->whereBetween('request_dar.created_date', [$dateRange[0], $dateRange[1]]);
                        }
                    }

                    if ($request->has('nik_name') && !empty($request->nik_name)) {
                        $nikName = $request->nik_name;
                        $data->where(function($query) use ($nikName) {
                            $query->where('request_dar.nik_req', 'like', '%' . $nikName . '%')
                                ->orWhere('users.name', 'like', '%' . $nikName . '%');
                        });
                    }

                    if ($request->has('reqtype') && !empty($request->reqtype)) {
                        $data->where('request_dar.typereqform_id', $request->reqtype);
                    }

                    if ($request->has('status') && !empty($request->status)) {
                        if($request->status == 'Pending'){
                            $data->where('request_dar.approval_status1', '0');
                        } elseif ($request->status == 'Approved') {
                            $data->where('request_dar.approval_status1', '1');
                        } else {
                            $data->where('request_dar.approval_status1', '2');
                        }

                    }

                    $data = $data->get();
                }else {
                    // Role tidak dikenali
                    return response()->json([], 403);
                }
                return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        if (Auth::user()->hasRole('user-employee')) {
                            return view('datatables._action-user-reqdar', [
                                'model' => $data,
                                'edit_url' => route('requestdar.edit', $data->reqdar_id),
                                'show_url' => route('requestdar.show', $data->reqdar_id)
                            ]);
                        } elseif (Auth::user()->hasRole('manager')) {
                            return view('datatables._action-user-reqdar-mgr', [
                                'model' => $data,
                                'approve1' => route('requestdar.approvedby1', $data->reqdar_id),
                                'rejectedAppr1' => route('requestdar.rejectedAppr1', $data->reqdar_id),
                                'show_url' => route('requestdar.show', $data->reqdar_id)
                            ]);
                        }
                        return '-';
                    })
                    ->editColumn('nik_req', function ($data) {
                        return $data->nik_req . ' ' . '-' . ' ' . $data->name;
                    })
                    ->editColumn('approval_status1', function ($data) {
                        return view('datatables._action-approvalstatus1', [
                            'model' => $data
                        ]);
                    })
                    ->editColumn('approval_status2', function ($data) {
                        return view('datatables._action-approvalstatus2', [
                            'model' => $data
                        ]);
                    })
                    ->editColumn('approval_status3', function ($data) {
                        return view('datatables._action-approvalstatus3', [
                            'model' => $data
                        ]);
                    })
                    ->editColumn('created_date', function ($data) {
                        $formatDate = Carbon::parse($data->created_date);
                        return Carbon::parse($formatDate)->translatedFormat('d F Y');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        // request type
        $reqTypes = DB::connection('dar-system')
            ->table('type_of_reqforms')
            ->select('id', 'request_type')
            ->get();
        // request desc
        $requestDesc = DB::connection('dar-system')
            ->table('request_desc')
            ->select('id', 'request_descript')
            ->get();

        // department
        $department = DB::connection('dar-system')
            ->table('departments')
            ->select('id', 'description')
            ->get();
        if (Auth::user()->hasRole('user-employee')) {
            return view('request-dar.user-dashboard.index', compact('reqTypes', 'requestDesc', 'department'));
        } elseif (Auth::user()->hasRole('manager')) {
            return view('request-dar.user-approved1.index', compact('reqTypes', 'requestDesc', 'department'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission(['manage-dar-system', 'create-reqdar'])) {
            if (!Auth::check()) {
                abort(403);
            }

            $reqTypes = DB::connection('dar-system')
                ->table('type_of_reqforms')
                ->select('id', 'request_type')
                ->get();

            return view('request-dar.user-dashboard.create', compact('reqTypes'));
        } else {
            return view('error.403');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if (!Auth::check()) {
            abort(403);
        }

        if (Auth::user()->hasPermission(['create-reqdar'])) {
            $validated = $request->validate([
                'name_doc' => 'required|string|max:255',
                'no_doc' => 'required|string|max:50',
                'qty_pages' => 'required|integer|min:1',
                'reason' => 'required|string',
                'rev_no' => 'required|integer|min:0',
                'storage_type' => 'required|in:month,year',
                'file_doc' => 'required|file|mimes:pdf|max:5120', // 5MB max
            ]);
            try {
                // Begin transaction
                DB::beginTransaction();

                // Generate unique file name
                $originalFileName = $request->file('file_doc')->getClientOriginalName();
                $fileName = time() . '_' . $originalFileName;

                // Define upload path within the storage directory
                $uploadPath = 'dar_documents/' . date('Y-m');


                // Store file in storage/app/public directory with the defined path
                // dd($request->file('file_doc'));
                $filePath = $request->file('file_doc')->storeAs(
                    'public/' . $uploadPath,
                    $fileName
                );
                // dd($filePath);
                // dd($request->file_doc->extension());


                // Create new request DAR record
                $requestdar = new Requestdar();
                $requestdar->number_dar = $requestdar::generateDocumentNumber();
                $requestdar->nik_req = Auth::user()->nik;
                $requestdar->nik_atasan = '966.96.96';
                $requestdar->company_id = Auth::user()->company_id;
                $requestdar->position_id = Auth::user()->position_id;
                $requestdar->user_id = Auth::user()->id;
                $requestdar->typereqform_id = $request->typereqform_id;
                $requestdar->request_desc_id = $request->request_desc_id;
                $requestdar->dept_id = $request->dept_id;
                $requestdar->name_doc = $request->name_doc;
                $requestdar->no_doc = $request->no_doc;
                $requestdar->qty_pages = $request->qty_pages;
                $requestdar->reason = $request->reason;
                $requestdar->rev_no = $request->rev_no;
                $requestdar->storage_type = $request->storage_type;
                $requestdar->file_doc = $filePath;
                $requestdar->status = '1'; // Default status
                $requestdar->created_by = Auth::user()->nik;
                $requestdar->created_date = date('Y-m-d h:i:s');
                $requestdar->approval_status1 = '0';
                $requestdar->approval_status2 = '0';
                $requestdar->approval_status3 = '0';
                $requestdar->approval_by1 = 'Manager';
                $requestdar->approval_by2 = 'Sys Dev';
                $requestdar->approval_by3 = 'Manager SysDev & IT';
                // Save the record
                $requestdar->save();

                // Commit transaction
                DB::commit();

                // Return success response
                return response()->json([
                    'success' => true,
                    'message' => 'Dokumen DAR berhasil disubmit',
                    'data' => $requestdar
                ]);

            } catch (\Exception $e) {
                // Rollback transaction on error
                DB::rollBack();
                // Log the error
                \Log::error('Error submitting DAR request: ' . $e->getMessage());

                // Return error response
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk melakukan operasi ini'
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermission('show-dar')) {
            $data = DB::connection('dar-system')->table('request_dar')->leftJoin('users', 'request_dar.user_id', '=', 'users.id')
                ->leftJoin('departments', 'request_dar.dept_id', '=', 'departments.id')
                ->leftJoin('companys', 'request_dar.company_id', '=', 'companys.id')
                ->leftJoin('positions', 'request_dar.position_id', '=', 'positions.id')
                ->leftJoin('type_of_reqforms', 'request_dar.typereqform_id', '=', 'type_of_reqforms.id')
                ->leftJoin('request_desc', 'request_dar.request_desc_id', '=', 'request_desc.id')
                ->select(
                    'request_dar.*',
                    'request_dar.id as reqdar_id',
                    'users.*',
                    'departments.description as department',
                    'companys.company_desc as company',
                    'positions.position_desc as position',
                    'type_of_reqforms.request_type as reqtype',
                    'request_desc.request_descript'
                )
                ->where('request_dar.id', $id)->first();

            return response()->json($data);
        } else {
            return view('error.403');
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasPermission('edit-dar')) {
            $data = DB::connection('dar-system')->table('request_dar')->leftJoin('users', 'request_dar.user_id', '=', 'users.id')
                ->leftJoin('departments', 'request_dar.dept_id', '=', 'departments.id')
                ->leftJoin('companys', 'request_dar.company_id', '=', 'companys.id')
                ->leftJoin('positions', 'request_dar.position_id', '=', 'positions.id')
                ->leftJoin('type_of_reqforms', 'request_dar.typereqform_id', '=', 'type_of_reqforms.id')
                ->leftJoin('request_desc', 'request_dar.request_desc_id', '=', 'request_desc.id')
                ->select(
                    'request_dar.*',
                    'users.*',
                    'departments.description as department',
                    'companys.company_desc as company',
                    'positions.position_desc as position',
                    'type_of_reqforms.request_type as reqtype',
                    'request_desc.request_descript'
                )
                ->where('request_dar.id', $id)->first();

            return response()->json($data);
        } else {
            return view('error.403');
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Auth::user()->hasPermission('edit-dar')) {
            try {
                DB::beginTransaction();
                $rules = [
                    'file_doc' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => $validator->errors()
                    ], 422);
                }

                $data = Requestdar::find($id);

                if (!$data) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data DAR tidak ditemukan'
                    ], 404);
                }

                $data->dept_id = $request->dept_id;
                $data->name_doc = $request->name_doc;
                $data->no_doc = $request->no_doc;
                $data->qty_pages = $request->qty_pages;
                $data->reason = $request->reason;
                $data->rev_no = $request->rev_no;
                $data->storage_type = $request->storage_type;
                $data->typereqform_id = $request->typereqform_id;
                $data->request_desc_id = $request->request_desc_id;

                if ($request->hasFile('file_doc')) {
                    $oldFilePath = $data->file_doc;

                    $originalFileName = $request->file('file_doc')->getClientOriginalName();
                    $fileName = time() . '_' . $originalFileName;

                    $uploadPath = 'dar_documents/' . date('Y-m');

                    $filePath = $request->file('file_doc')->storeAs(
                        'public/' . $uploadPath,
                        $fileName
                    );
                    $data->file_doc = $filePath;

                    // Delete old file if it exists
                    if (!empty($oldFilePath) && Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }
                $data->updated_by_1 = Auth::user()->nik;
                $data->updated_bydate_1 = date('Y-m-d H:i:s');

                $data->save();

                DB::commit();

                return response()->json([
                    'status' => true
                ], 200);
            } catch (\Exception $e) {
                DB::rollback();

                \Log::error('Error updating request' . $e->getMessage());

                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan' . $e->getMessage()
                ], 500);
            }


        } else {
            return view('error.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function viewDocument($id)
    {
        $requestDar = RequestDar::findOrFail($id);

        if (!$requestDar->file_doc) {
            abort(404, 'File not found');
        }

        // Cek apakah file dimulai dengan 'public/'
        $filePath = $requestDar->file_doc;
        if (strpos($filePath, 'public/') === 0) {
            $filePath = substr($filePath, 7); // Hapus 'public/' dari awal path
        }

        // Cek file di storage
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            $altPath = public_path($filePath);
            if (!file_exists($altPath)) {
                abort(404, 'File not found on disk');
            }
            $fullPath = $altPath;
        }

        return response()->file($fullPath);
    }

    public function approvedBy1($id)
    {
        if (Auth::user()->hasPermission(['manager-dar-system','approved-by1'])) {
            DB::connection('dar-system')->table('request_dar')->where('id', $id)->update([
                'approval_date1' => date('Y-m-d H:i:s'),
                'approval_status1'=> '1'
            ]);

            return response()->json([
                'status'=> true
            ]);
        }
    }
    public function rejectedAppr1(Request $request, $id)
    {
        if (Auth::user()->hasPermission(['manager-dar-system','approved-by1','rejected-appr1'])) {
            DB::connection('dar-system')->table('request_dar')->where('id', $id)->update([
                'approval_date1' => date('Y-m-d H:i:s'),
                'approval_status1'=> '2',
                'remark_approval_by1' => $request->reject_reason
            ]);

            return response()->json([
                'status'=> true
            ]);
        }
    }

}
