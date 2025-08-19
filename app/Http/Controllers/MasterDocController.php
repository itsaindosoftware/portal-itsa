<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\FileBag;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Mail;
// use Storage;
use App\Masterdocs;
use App\Department;
use App\Typereqform;
use App\Requestdar;
class MasterDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasPermission('manage-masterdocs')) {
            if ($request->ajax()) {
                // dd($request->get('status'));
                $data = Masterdocs::query()->leftJoin(
                    'distribution_dar_depts',
                    'distribution_dar_depts.master_docs_id',
                    '=',
                    'master_documents.id'
                )
                    ->leftJoin('type_of_reqforms', 'master_documents.type_doc_id', '=', 'type_of_reqforms.id');


                // ->leftJoin('distribution_dar_depts','master_documents.')
                $data->select(
                    'master_documents.title',
                    // 'master_documents.*',
                    // 'departments.description as dept_name',
                    // 'type_of_reqforms.request_type as type_doc_name',
                    DB::raw('MAX(master_documents.id) as id'),
                    // DB::raw('MAX(master_documents.dept_id) as dept_id'),
                    // DB::raw('MAX(departments.description) as dept_name'),
                    DB::raw('MAX(master_documents.type_doc_id) as type_doc_id'),
                    DB::raw('MAX(type_of_reqforms.request_type) as type_doc_name'),
                    DB::raw('MAX(master_documents.file) as file'),
                    DB::raw('MAX(master_documents.effective_date) as effective_date'),
                    DB::raw('MAX(master_documents.archived_date) as archived_date'),
                    DB::raw('MAX(master_documents.created_at) as created_at')
                );


                // if ($user->hasRole('user-employee') && isset($user->dept)) {
                //     $data->where('distribution_dar_depts.dept_id', $user->dept->id)->where('is_archived', 'new');
                // }
                // dd($request->get('status'));
                if ($request->has('type_docs') && !empty($request->type_docs)) {
                    $data->where('master_documents.type_doc_id', $request->type_docs);
                }
                if ($request->get('status') == 'all-docs') {
                    $data->where('master_documents.is_archived', 'new');
                } elseif ($request->get('status') == 'archived') {
                    $data->where('master_documents.is_archived', 'archived');
                } elseif ($request->get('status') == 'my-docs') {
                    $data->where('master_documents.is_archived', 'archived')->where('distribution_dar_depts.dept_id', $user->department_id);
                }
                $data->groupBy('master_documents.title')
                    ->orderBy('created_at', 'desc');
                return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        return view('datatables._action-masterdocs', [
                            'model' => $data,
                            'edit_url' => route('masterdocs.edit', $data->id),
                            'show_url' => route('masterdocs.show', $data->id),
                            'delete_url' => route('masterdocs.destroy', $data->id),
                        ]);
                    })
                    ->editColumn('file', function ($row) {
                        return view('datatables._show-file', [
                            'data' => $row
                        ]);
                    })
                    ->editColumn('updated_at', function ($data) {
                        if ($data->updated_at) {
                            return Carbon::parse($data->updated_at0)->format('Y-m-d');
                        } else {
                            return '<span class="text-muted"><i>Belum ada revisi</i></span>';
                        }
                    })
                    ->editColumn('description', function ($row) {
                        return strlen($row->description) > 50 ?
                            substr($row->description, 0, 50) . '...' :
                            $row->description;
                    })
                    // ->editColumn('type_doc_id', function ($row) {

                    //     return '<span class="badge badge-warnings">' . $row->type_doc . '</span>';
                    // })
                    ->editColumn('created_at', function ($data) {
                        return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
                    })
                    ->rawColumns(['action', 'file', 'type_doc_id', 'updated_at'])
                    ->make(true);


            }

            $typeDoc = Typereqform::all();
            $departments = DB::connection('portal-itsa')->table('departments')->whereNotIn('description', [
                'Manager Directure ITSA',
                'Manager Directure ITSP',
                'Personal Assisten Manager',
                'Personal Assistant'
            ])->get();
            // dd($departments);
            return view('request-dar.masterdocs.index', [
                'typeDoc' => $typeDoc,
                'departments' => $departments
            ]);


        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = Auth::user();
        if ($user->hasPermission('create-masterdocs')) {

            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'type_docs' => 'required|exists:type_of_reqforms,id',
                'effective_date' => 'required|date',
                'is_archived' => 'required|in:new,archived',
            ];
            if (
                $request->is_archived === 'new' ||
                ($request->is_archived === 'archived' && !$request->existing_file_path)
            ) {
                $rules['file_doc'] = 'required|file|mimes:pdf,xlsx,xls,doc,docx|max:10240';
            } elseif ($request->has('file_doc') && $request->file_doc) {
                $rules['file_doc'] = 'file|mimes:pdf,xlsx,xls,doc,docx|max:10240';
            }

            $request->validate($rules);

            $filePath = null;
            $originalFileName = null;

            if (
                $request->is_archived === 'archived' &&
                $request->use_existing_file === '1' &&
                $request->existing_file_path &&
                !$request->replace_existing_file
            ) {

                // Use existing file from request DAR
                $filePath = $request->existing_file_path;
                $originalFileName = $request->existing_file_name;

                // Verify that the file actually exists
                $cleanPath = str_replace('public/', '', $filePath);
                if (!Storage::disk('public')->exists($cleanPath)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File dari request tidak ditemukan: ' . $originalFileName
                    ], 400);
                }

            } elseif ($request->hasFile('file_doc') && $request->is_archived === 'new') {
                $originalFileName = $request->file('file_doc')->getClientOriginalName();
                $fileName = $originalFileName;

                $uploadPath = 'reqdar/master-documents/' . date('Y-m');

                $filePath = $request->file('file_doc')->storeAs(
                    'public/' . $uploadPath,
                    $fileName
                );

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'File upload diperlukan'
                ], 400);
            }

            $getDistributiondepartments = count($request->departments);

            $data = new Masterdocs;
            $data->title = $request->get('title');
            $data->description = $request->get('description');
            $data->type_doc_id = $request->get('type_docs');
            $data->effective_date = $request->get('effective_date');
            $data->created_at = Carbon::now();
            $data->is_archived = $request->is_archived;
            $data->file = $filePath;
            $data->archived_date = $request->get('effective_date');
            $data->save();

            if ($request->is_archived == 'new') {
                for ($i = 0; $i < $getDistributiondepartments; $i++) {
                    DB::connection('portal-itsa')
                        ->table('distribution_dar_depts')
                        ->insert([
                            'dept_id' => $request->departments[$i],
                            'reqdar_id' => null,
                            'master_docs_id' => $data->id,
                            'effective_date' => $data->effective_date,
                            'created_at' => Carbon::now()
                        ]);
                }
            } elseif ($request->is_archived == 'archived') {
                // delete first
                DB::connection('portal-itsa')
                    ->table('distribution_dar_depts')
                    ->where('reqdar_id', $request->reqdar_id)
                    ->delete();

                for ($i = 0; $i < $getDistributiondepartments; $i++) {
                    DB::connection('portal-itsa')->table('distribution_dar_depts')
                        ->where('reqdar_id', $request->reqdar_id)
                        ->insert([
                            'dept_id' => $request->departments[$i],
                            'reqdar_id' => $request->reqdar_id,
                            'master_docs_id' => $data->id,
                            'effective_date' => $data->effective_date,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                }
            }



            return response()->json([
                'success' => true,
                'message' => 'Data documents succesfully added',
            ], 200);
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
        $user = Auth::user();
        $id = base64_decode($id);
        if ($user->hasPermission('manage-masterdocs', 'show-masterdocs')) {
            // $data = Masterdocs::find($id);
            $data = Masterdocs::query()
                ->leftJoin('type_of_reqforms', 'master_documents.type_doc_id', '=', 'type_of_reqforms.id')
                ->select(
                    'master_documents.*',
                    'master_documents.id as id',
                    'type_of_reqforms.request_type as type_doc_name'
                )->where('master_documents.id', $id)->first();

            $distributionDepts = DB::connection('portal-itsa')
                ->table('distribution_dar_depts')
                ->leftJoin('departments', 'distribution_dar_depts.dept_id', '=', 'departments.id')
                ->select(
                    'distribution_dar_depts.*',
                    'departments.description as dept_name'
                )
                ->where('distribution_dar_depts.master_docs_id', $id)
                ->get();

            // $data = (array) $data;
            $responseData = [
                'id' => $data->id,
                'title' => $data->title,
                'description' => $data->description,
                'file' => $data->file,
                'type_doc_id' => $data->type_doc_id,
                'type_doc_name' => $data->type_doc_name,
                'effective_date' => $data->effective_date,
                'is_archived' => $data->is_archived,
                'archived_date' => $data->archived_date,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
                'distribution_depts' => $distributionDepts,
                'distribution_dept' => $distributionDepts->pluck('dept_id')->toArray()
            ];
            // dd($responseData);
            // $data['distribution_depts'] = $distributionD
            return response()->json($responseData);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $id = base64_decode($id);
        if ($user->hasPermission('manage-masterdocs', 'edit-masterdocs')) {
            $data = Masterdocs::query()
                ->leftJoin('type_of_reqforms', 'master_documents.type_doc_id', '=', 'type_of_reqforms.id')
                ->select(
                    'master_documents.*',
                    'master_documents.id as id',
                    'type_of_reqforms.request_type as type_doc_name'
                )->where('master_documents.id', $id)->first();

            $distributionDepts = DB::connection('portal-itsa')
                ->table('distribution_dar_depts')
                ->leftJoin('departments', 'distribution_dar_depts.dept_id', '=', 'departments.id')
                ->select(
                    'distribution_dar_depts.*',
                    'departments.description as dept_name'
                )
                ->where('distribution_dar_depts.master_docs_id', $id)
                ->get();

            // $data = (array) $data;
            $responseData = [
                'id' => $data->id,
                'title' => $data->title,
                'description' => $data->description,
                'file' => $data->file,
                'type_doc_id' => $data->type_doc_id,
                'type_doc_name' => $data->type_doc_name,
                'effective_date' => $data->effective_date,
                'is_archived' => $data->is_archived,
                'archived_date' => $data->archived_date,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
                'distribution_depts' => $distributionDepts,
                'distribution_dept' => $distributionDepts->pluck('dept_id')->toArray()
            ];
            // $data['distribution_depts'] = $distributionDepts;
            // $data['distribution_dept'] = $distributionDepts->pluck('dept_id')->toArray();
            // dd($data);
            return response()->json($responseData);
        }
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
        // dd($request->all());
        $user = Auth::user();
        if ($user->hasPermission('manage-masterdocs', 'edit-masterdocs')) {
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'type_docs' => 'required|exists:type_of_reqforms,id',
                'effective_date' => 'required|date',
                'is_archived' => 'required|in:new,archived',
                'departments' => 'required|array|min:1',
                // 'departments.*' => 'exists:departments,id'
            ];

            // Add file validation if file is being uploaded
            if ($request->hasFile('file_doc')) {
                $rules['file_doc'] = 'file|mimes:pdf,xlsx,xls,doc,docx|max:10240';
            }

            $request->validate($rules);
            // dd($id);
            $data = Masterdocs::find($id);
            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data MasterDocs Not found'
                ], 404);
            }
            try {

                DB::beginTransaction();
                $data->title = empty($request->title) ? $data->title : $request->title;
                $data->description = empty($request->description) ? $data->description : $request->description;
                $data->type_doc_id = empty($request->type_docs) ? $data->type_doc : $request->type_docs;
                // $data->dept_id = empty($request->departments) ? $data->dept_id : $request->departments;
                $data->effective_date = empty($request->effective_date) ? $data->effective_date : $request->effective_date;
                if ($request->hasFile('file_doc')) {
                    $oldFilePath = $data->file;

                    $originalFileName = $request->file('file_doc')->getClientOriginalName();
                    $fileName = $originalFileName;
                    $uploadPath = 'reqdar/master-documents/' . date('Y-m');

                    $filePath = $request->file('file_doc')->storeAs(
                        'public/' . $uploadPath,
                        $fileName
                    );
                    $data->file = $filePath;

                    // Delete old file if it exists
                    if (!empty($oldFilePath) && Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }


                $data->save();
                //delete first
                DB::connection('portal-itsa')
                    ->table('distribution_dar_depts')
                    ->where('master_docs_id', $id)
                    ->delete();

                $distributionsDept = [];
                foreach ($request->departments as $deptId) {
                    $distributionsDept[] = [
                        'dept_id' => $deptId,
                        'master_docs_id' => $data->id,
                        'effective_date' => $request->effective_date,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                if (!empty($distributionData)) {
                    DB::connection('portal-itsa')
                        ->table('distribution_dar_depts')
                        ->insert($distributionData);
                }
                DB::commit();

                return response()->json([
                    'status' => true,
                    'success' => true,
                ], 200);

            } catch (\Exception $e) {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'status' => false,
                    'message' => 'Error updating document: ' . $e->getMessage()
                ], 500);
            }

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
        $user = Auth::user();
        if ($user->hasPermission('manage-masterdocs', 'destroy-masterdocs')) {
            $data = Masterdocs::find($id);
            $data->delete();


            return response()->json([
                'success' => true
            ]);
        }
    }
    public function viewDocument($id)
    {
        $requestMasterdocs = Masterdocs::findOrFail($id);

        if (!$requestMasterdocs->file) {
            abort(404, 'File not found');
        }

        // Cek apakah file dimulai dengan 'public/'
        $filePath = $requestMasterdocs->file;
        // dd($filePath);
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
    public function downloadDocument($id)
    {
        $requestDocs = Masterdocs::findOrFail($id);

        if (!$requestDocs->file) {
            abort(404, 'File not found');
        }

        // Cek apakah file dimulai dengan 'public/'
        $filePath = $requestDocs->file;
        if (strpos($filePath, 'public/') === 0) {
            $filePath = substr($filePath, 7);
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

        // Ekstrak nama file asli dari path file
        $originalFileName = basename($filePath);

        // Jika nama file tidak tersedia, gunakan judul dokumen atau nama default
        if (empty($originalFileName) || $originalFileName == $id) {
            $originalFileName = !empty($requestDocs->title) ?
                Str::slug($requestDocs->title, '-') . '.pdf' :
                'document-' . $requestDocs->id . '.pdf';
        }

        return response()->download($fullPath, $originalFileName);
    }
    private function baseQuery()
    {
        $data = Requestdar::query()->leftJoin('users', 'request_dar.user_id', '=', 'users.id')
            ->leftJoin('departments', 'request_dar.dept_id', '=', 'departments.id')
            ->leftJoin('companys', 'request_dar.company_id', '=', 'companys.id')
            ->leftJoin('positions', 'request_dar.position_id', '=', 'positions.id')
            ->leftJoin('type_of_reqforms', 'request_dar.typereqform_id', '=', 'type_of_reqforms.id')
            ->leftJoin('request_desc', 'request_dar.request_desc_id', '=', 'request_desc.id')
            // ->leftJoin('distribution_dar_depts', 'distribution_dar_depts.reqdar_id', '=', 'request_dar.id')
            ->select(
                'request_dar.*',
                'request_dar.id as reqdar_id',
                'request_dar.file_doc as file',
                'departments.description as department',
                'companys.company_desc as company',
                'positions.position_desc as position',
                'type_of_reqforms.request_type as reqtype',
                'request_desc.request_descript',
                DB::raw('(SELECT GROUP_CONCAT(dept_id) FROM distribution_dar_depts WHERE reqdar_id = request_dar.id) as distribution_dept_ids'),
                DB::raw('(SELECT GROUP_CONCAT(DISTINCT effective_date) FROM distribution_dar_depts WHERE reqdar_id = request_dar.id) as eff_dates')
            );
        return $data;
    }

    public function loockupDocument(Request $request)
    {
        // dd($request->filterType);
        if ($request->ajax()) {
            $query = $this->baseQuery()
                ->where('request_dar.approval_status3', '=', '1')
                ->where('request_dar.status', '=', '2');


            if ($request->has('filterType') && !empty($request->filterType)) {
                $query->where('request_dar.typereqform_id', $request->filterType);
            }
            // dd($query);
            // $query->groupBy('distribution_dar_depts.reqdar_id');
            // dd($query);
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('file', function ($row) {
                    return view('datatables._show-file', [
                        'data' => $row
                    ]);
                })
                ->make(true);
        }


    }
}
