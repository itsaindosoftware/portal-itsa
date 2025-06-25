<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\FileBag;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Validator;
use App\Digitalassets;
use App\Mail\SendingnotifDigAssets;
use App\Mail\SendingnotifRejected;
use Illuminate\Support\Facades\Mail;
use App\Assettfnotif;

class AssettfnotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasPermission('manage-digital-assets', 'manage-asset-tf-notification')) {
            return redirect()->route('apps.index')->with('error', 'You do not have access to this application yet. Please contact your IT Department.');
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($user->hasPermission('manage-digital-assets', 'manage-asset-tf-notification')) {
            if ($request->ajax()) {
                if ($user->hasRole('user-employee-digassets')) {
                    $data = Digitalassets::query()
                        ->leftJoin('users', 'registration_fixed_assets.user_id', '=', 'users.id')
                        ->leftJoin('departments', 'registration_fixed_assets.department_id', '=', 'departments.id')
                        ->leftJoin('companys', 'registration_fixed_assets.company_id', '=', 'companys.id')
                        ->leftJoin('master_asset_groups', 'registration_fixed_assets.asset_group_id', '=', 'master_asset_groups.id')
                        ->leftJoin('master_asset_locations', 'registration_fixed_assets.asset_location_id', '=', 'master_asset_locations.id')
                        ->leftJoin('master_asset_cost_centers', 'registration_fixed_assets.asset_cost_center_id', '=', 'master_asset_cost_centers.id');

                    $data = $data->select(
                        'registration_fixed_assets.id',
                        'registration_fixed_assets.date',
                        'registration_fixed_assets.rfa_number',
                        'registration_fixed_assets.issue_fixed_asset_no',
                        'registration_fixed_assets.production_code',
                        'registration_fixed_assets.product_name',
                        'registration_fixed_assets.grn_no',
                        'registration_fixed_assets.requestor_name',
                        'users.name as user_name',
                        'departments.description as department_name',
                        'companys.company_desc as company_name',
                        'master_asset_groups.asset_group_name',
                        'master_asset_locations.asset_location_name as name_location',
                        'master_asset_cost_centers.cost_center_name as cost_cname',
                        'registration_fixed_assets.remark',
                        'registration_fixed_assets.approval_status1',
                        'registration_fixed_assets.approval_status2',
                        'registration_fixed_assets.approval_status3',
                        'registration_fixed_assets.approval_date1',
                        'registration_fixed_assets.approval_date2',
                        'registration_fixed_assets.approval_date3',
                    );

                    if ($request->has('date_range') && !empty($request->date_range)) {
                        $dateRange = explode(' - ', $request->date_range);
                        if (count($dateRange) == 2) {
                            $data->whereBetween('registration_fixed_assets.date', [$dateRange[0], $dateRange[1]]);
                        }
                    }

                    $data = $data->where('registration_fixed_assets.approval_status3', '=', '1')
                        ->where('registration_fixed_assets.user_id', '=', $user->id)->get();
                }

                return DataTables::of($data)
                    ->addColumn('action', function ($data) use ($user) {
                        if ($user->hasRole('user-employee-digassets')) {
                            return view('datatables._action-user-digassets-sendnotif', [
                                'model' => $data,
                                'sendNotif' => route('transfernotif.send', base64_encode($data->id)),
                            ]);
                        } else {
                            return '';
                        }
                    })
                    ->editColumn('rfa_number', function ($data) {
                        $no = $data->rfa_number;
                        if ($no == '-') {
                            return '<i>(wait for accounting dept to fill in)</i>';
                        } else {
                            return $no;
                        }
                    })
                    ->editColumn('date', function ($data) {
                        $no = $data->date;
                        if ($no == NULL) {
                            return '<i>(wait for accounting dept to fill in)</i>';
                        } else {
                            return $no;
                        }
                    })
                    ->rawColumns(['action', 'rfa_number', 'date'])
                    ->make(true);
            }

            // Return view untuk request non-AJAX (halaman pertama kali dimuat)
            if ($user->hasRole('user-employee-digassets')) {
                $masterAssetGroups = DB::connection('portal-itsa')->table('master_asset_groups')->get();
                $masterAssetLocations = DB::connection('portal-itsa')->table('master_asset_locations')->get();
                $masterAssetCostCenters = DB::connection('portal-itsa')->table('master_asset_cost_centers')->get();
                $department = DB::connection('portal-itsa')->table('departments')->get();
                return view('digitalassets.send-notif-transfer.user-dashboard.index', [
                    'masterAssetsGroups' => $masterAssetGroups,
                    'masterAssetLocations' => $masterAssetLocations,
                    'masterAssetCostCenters' => $masterAssetCostCenters,
                    'departments' => $department
                ]);
            } else {
                return view('error.403');
            }

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
        // "_token" => "4bNVlPR8Zh4L3sd9EPVZAtBuMmB482mLMFO6Tbkp"
        if (Auth::user()->hasPermission('manage-asset-tf-notification', 'create-asset-tf-notif')) {
            try {
                // Validation rules
                $getData = $request->all();
                dd($getData);
                $rules = [
                    // Section 1: Transfer FROM
                    'quantity_from' => 'required|integer|min:1',
                    'pic_name_from' => 'required|string|max:100',
                    'date_of_transfer' => 'required|date',
                    // 'io_no_approval' => 'nullable|max:50',

                    // Section 2: Transfer TO
                    'receiving_dept' => 'required|exists:departments,id|different:transferring_dept',
                    'new_cost_center' => 'required|exists:master_asset_cost_centers,id',
                    'new_location' => 'required|exists:master_asset_locations,id',
                    'quantity_to' => 'required|integer|min:1|same:quantity_from',
                    'pic_name_to' => 'required|string|max:100',
                    'effective_date' => 'required|date|after_or_equal:date_of_transfer',
                    'transfer_ref_no' => 'nullable|string|max:50',

                    // Additional fields (uncomment if needed)
                    // 'remarks' => 'nullable|string|max:1000',
                    // 'company_id' => 'required|exists:companies,id',
                    // 'asset_group' => 'required|exists:master_asset_groups,id',
                    // 'supporting_documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
                ];

                // Custom validation messages
                $messages = [
                    'transferring_dept.required' => 'Please select the transferring department.',
                    'receiving_dept.different' => 'Receiving department must be different from transferring department.',
                    // 'io_no_from.regex' => 'IO number format should be IO followed by at least 6 digits.',
                    'asset_tag_number.regex' => 'Asset tag must be at least 6 characters (letters and numbers only).',
                    'quantity_to.same' => 'Quantity in both sections must match.',
                    'effective_date.after_or_equal' => 'Effective date cannot be earlier than transfer date.',
                    'date_of_transfer.before_or_equal' => 'Transfer date cannot be in the future.',
                ];
                // Validate request
                $validatedData = $request->validate($rules, $messages);

                $filePath = '-';
                if ($request->hasFile('supporting_documents')) {
                    $originalFileName = $request->file('supporting_documents')->getClientOriginalName();
                    $fileName = time() . '_' . $originalFileName;

                    $uploadPath = 'transfer-documents-assets/' . date('Y-m');

                    $filePath = $request->file('supporting_documents')->storeAs(
                        'public/' . $uploadPath,
                        $fileName
                    );
                }



                try {
                    DB::beginTransaction();

                    // Create transfer notification record
                    $transferNotification = $this->createTransferNotification($validatedData, $filePath, $getData);

                    DB::commit();

                    // Prepare response
                    $message = 'Transfer request submitted successfully!';

                    return response()->json([
                        'success' => true,
                        'message' => $message,
                        'data' => [
                            'id' => $transferNotification->id
                        ],
                        'redirect_url' => route('transfernotif.show', $transferNotification->id),
                        'view_url' => route('transfernotif.show', $transferNotification->id)
                    ], 200);

                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;

                    return response()->json([
                        'success' => false,
                        'message' => 'Database error occurred while processing your request. Please try again.'
                    ], 500);
                }

            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check the form for errors.',
                    'errors' => $e->errors()
                ], 422);

            } catch (\Exception $e) {
                DB::rollBack();

                \Log::error('Transfer notification submission error: ' . $e->getMessage(), [
                    'user_id' => Auth::user()->id,
                    'request_data' => $request->all(),
                    'trace' => $e->getTraceAsString()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing your request. Please try again.'
                ], 500);
            }
        }
    }
    private function createTransferNotification($data, $filePath, $getData)
    {
        return Assettfnotif::create([
            // Section 1: FROM
            'reg_fixed_asset_id' => $getData['id_fixed_asset'],
            'from_date_of_tf' => $getData['date_of_transfer'],
            'from_io_no' => $getData['io_no_approval'],

            // Section 2: TO
            'to_receiving_dept_id' => $getData['receiving_dept'],
            'to_cost_center_id' => $getData['new_cost_center'],
            'to_location_id' => $getData['new_location'],
            'to_qty' => $getData['quantity_to'],
            'pic_support' => $filePath,
            'to_effective_date' => $getData['effective_date'],
            'to_tf_fer_no_erp' => $getData['transfer_ref_no'],
            // System fields
            'created_by' => Auth::user()->name,
        ]);
    }
    // private function handleFileUploads($files, $transferId)
    // {
    //     foreach ($files as $file) {
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $path = $file->storeAs('transfer_documents', $filename, 'public');

    //         TransferNotificationDocument::create([
    //             'transfer_notification_id' => $transferId,
    //             'original_name' => $file->getClientOriginalName(),
    //             'file_name' => $filename,
    //             'file_path' => $path,
    //             'file_size' => $file->getSize(),
    //             'mime_type' => $file->getMimeType(),
    //         ]);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function send(Request $request, $id)
    {
        if (Auth::user()->hasPermission('manage-digital-assets', 'manage-asset-tf-notification')) {
            $id = base64_decode($id);
            $digitalAsset = Digitalassets::query()
                ->leftJoin('users', 'registration_fixed_assets.user_id', '=', 'users.id')
                ->leftJoin('departments', 'registration_fixed_assets.department_id', '=', 'departments.id')
                ->leftJoin('companys', 'registration_fixed_assets.company_id', '=', 'companys.id')
                ->leftJoin('master_asset_groups', 'registration_fixed_assets.asset_group_id', '=', 'master_asset_groups.id')
                ->leftJoin('master_asset_locations', 'registration_fixed_assets.asset_location_id', '=', 'master_asset_locations.id')
                ->leftJoin('master_asset_cost_centers', 'registration_fixed_assets.asset_cost_center_id', '=', 'master_asset_cost_centers.id');
            $digitalAsset = $digitalAsset->select(
                'registration_fixed_assets.*',
                'users.name as user_name',
                'departments.description as department_name',
                'companys.company_desc as company_name',
                'master_asset_groups.asset_group_name',
                'master_asset_locations.asset_location_name as name_location',
                'master_asset_cost_centers.cost_center_name as cost_cname',
                'master_asset_cost_centers.cost_center_code'
            )->where('registration_fixed_assets.id', $id)->first();

            return response()->json([
                'data' => $digitalAsset,
                'success' => true
            ], 200);
        }


    }
}
