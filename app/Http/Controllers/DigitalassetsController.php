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

class DigitalassetsController extends Controller
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
            return redirect()->route('login');
        }

        if ($request->ajax()) {
            if (Auth::user()->hasPermission('manage-digital-assets')) {
                if (Auth::user()->hasRole('user-employee-digassets')) {
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
                    $data = $data->where('registration_fixed_assets.user_id', Auth::user()->id)->get();
                } elseif (Auth::user()->hasRole('user-acct-digassets')) {
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
                        'users.nik as user_nik',
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
                    // dd($request->all());

                    if ($request->has('date_range') && !empty($request->date_range)) {
                        $dateRange = explode(' - ', $request->date_range);
                        if (count($dateRange) == 2) {
                            $data->whereBetween('registration_fixed_assets.created_date', [$dateRange[0], $dateRange[1]]);
                        }
                    }

                    if ($request->has('nik_name') && !empty($request->nik_name)) {
                        $nikName = $request->nik_name;
                        $data->where(function ($query) use ($nikName) {
                            $query->where('users.user_name', 'like', '%' . $nikName . '%')
                                ->orWhere('users.name', 'like', '%' . $nikName . '%');
                        });
                    }


                    if ($request->has('company') && !empty($request->company)) {
                        $data->where('registration_fixed_assets.company_id', $request->company);
                    }
                    if ($request->has('department') && !empty($request->department)) {
                        $data->where('registration_fixed_assets.department_id', $request->department);
                    }

                    if ($request->has('status') && !empty($request->status)) {
                        if ($request->status == 'Pending') {
                            $data->where('registration_fixed_assets.approval_status2', '0');
                        } elseif ($request->status == 'Approved') {
                            $data->where('registration_fixed_assets.approval_status2', '1');
                        } else {
                            $data->where('registration_fixed_assets.approval_status2', '2');
                        }

                    }

                    if ($request->has('asset_group') && !empty($request->asset_group)) {
                        $data->where('registration_fixed_assets.asset_group_id', $request->asset_group);
                    }
                    if ($request->has('asset_location') && !empty($request->asset_location)) {
                        $data->where('registration_fixed_assets.asset_location_id', $request->asset_location);
                    }
                    if ($request->has('asset_cost_center') && !empty($request->asset_cost_center)) {
                        $data->where('registration_fixed_assets.asset_cost_center_id', $request->asset_cost_center);
                    }
                    $data = $data->get();
                } else {
                    return response()->json(['error' => 'Unauthorized'], 403);

                }
            }

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    if (Auth::user()->hasRole('user-employee-digassets')) {
                        return view('datatables._action-user-digassets', [
                            'model' => $data,
                            'edit_url' => route('digitalassets.edit', $data->id),
                            'show_url' => route('digitalassets.show', $data->id),
                            'approve_url1' => route('digitalassets.approvedby1', $data->id),
                        ]);
                    } elseif (Auth::user()->hasRole('user-acct-digassets')) {
                        return view('datatables._action-user-acct-digassets', [
                            'model' => $data,
                            // 'edit_url' => route('digitalassets.edit', $data->id),
                            'show_url' => route('digitalassets.show', $data->id),
                            'approve_url2' => route('digitalassets.approvedby2', $data->id),
                        ]);
                    } else {
                        return '';
                    }
                })
                ->editColumn('approval_status2', function ($data) {
                    return view('datatables._approval-status2-digassets', [
                        'model' => $data
                    ]);
                })
                ->editColumn('approval_status3', function ($data) {
                    return view('datatables._approval-status3-digassets', [
                        'model' => $data
                    ]);
                })
                ->make(true);
        }

        if (Auth::user()->hasRole('user-employee-digassets')) {
            return view('digitalassets.user-dashboard.index');
        } elseif (Auth::user()->hasRole('user-acct-digassets')) {
            $department = DB::connection('portal-itsa')->table('departments')
                ->get();
            $company = DB::connection('portal-itsa')->table('companys')
                ->get();


            $masterAssetGroups = DB::connection('portal-itsa')->table('master_asset_groups')->get();
            $masterAssetLocations = DB::connection('portal-itsa')->table('master_asset_locations')->get();
            $masterAssetCostCenters = DB::connection('portal-itsa')->table('master_asset_cost_centers')->get();


            return view('digitalassets.user-acct-digassets.index', compact(
                'department',
                'company',
                'masterAssetGroups',
                'masterAssetLocations',
                'masterAssetCostCenters'
            ));
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->hasPermission('create-digital-assets-reg')) {
            $assetGroups = DB::connection('portal-itsa')->table('master_asset_groups')->get();
            $assetLocations = DB::connection('portal-itsa')->table('master_asset_locations')->get();
            $assetCostCenters = DB::connection('portal-itsa')->table('master_asset_cost_centers')->get();
            $userId = Auth::user()->id;
            $userData = DB::connection('portal-itsa')->table('users')->leftJoin('departments', 'departments.id', '=', 'users.department_id')->where('users.id', $userId)->first();
            $companies = DB::connection('portal-itsa')->table('companys')->get();
            return view('digitalassets.user-dashboard.create', compact(
                'assetGroups',
                'assetLocations',
                'assetCostCenters',
                'userData',
                'companies'
            ));
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->hasPermission('create-digital-assets-reg')) {
            $request->validate([
                'date' => 'required|date',
                'rfa_number' => 'required|string|max:100',
                'received_date' => 'required|date',
                'requestor_name' => 'required|string|max:100',
                'issue_fixed_asset_no' => 'required|string|max:100',
                'io_no' => 'required|string|max:100',
                'company_id' => 'required|string|max:100',
                'product_code' => 'required|string|max:100',
                'product_name' => 'required|string|max:100',
                'grn_no' => 'required|string|max:100',
                'asset_group' => 'required|exists:master_asset_groups,id',
                'asset_location' => 'required|exists:master_asset_locations,id',
                'asset_cost_center' => 'required|exists:master_asset_cost_centers,id',
            ]);

            // Simpan data ke tabel registration_fixed_assets
            $insert = [
                'date' => $request->date,
                'rfa_number' => $request->rfa_number,
                'received_date' => $request->received_date,
                'requestor_name' => $request->requestor_name,
                'issue_fixed_asset_no' => $request->issue_fixed_asset_no,
                'io_no' => $request->io_no,
                'company_id' => $request->company_id,
                'production_code' => $request->product_code,
                'product_name' => $request->product_name,
                'grn_no' => $request->grn_no,
                'asset_group_id' => $request->asset_group,
                'asset_location_id' => $request->asset_location,
                'asset_cost_center_id' => $request->asset_cost_center,
                'created_by' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                // 'department_id' => $request->department_id,
                'created_at' => date('Y-m-d H:i:s'),
                'approval_status1' => '0',
                'approval_status2' => '0',
                'approval_status3' => '0',
            ];

            $id = DB::connection('portal-itsa')->table('registration_fixed_assets')->insertGetId($insert);

            // Jika request AJAX, balas JSON
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Digital Asset Succesfully registered!']);
            }

            // Jika bukan AJAX, redirect biasa
            return redirect()->route('digitalassets.index')->with('success', 'Digital Asset Succesfully registered!');
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasPermission('show-digital-assets')) {
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

            if (!$digitalAsset) {
                return redirect()->route('digitalassets.index')->with('error', 'Digital Asset not found!');
            }
            // dd($digitalAsset);

            return view('digitalassets.user-dashboard.show', compact('digitalAsset'));
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);

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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasPermission('edit-digital-assets')) {
            $asset = Digitalassets::find($id);
            if (!$asset) {
                return redirect()->route('digitalassets.index')->with('error', 'Digital Asset not found!');
            }

            $assetGroups = DB::connection('portal-itsa')->table('master_asset_groups')->get();
            $assetLocations = DB::connection('portal-itsa')->table('master_asset_locations')->get();
            $assetCostCenters = DB::connection('portal-itsa')->table('master_asset_cost_centers')->get();
            $companies = DB::connection('portal-itsa')->table('companys')->get();

            return view('digitalassets.user-dashboard.edit', compact(
                'asset',
                'assetGroups',
                'assetLocations',
                'assetCostCenters',
                'companies'
            ));
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasPermission('edit-digital-assets')) {
            $request->validate([
                'date' => 'required|date',
                'rfa_number' => 'required|string|max:100',
                'received_date' => 'required|date',
                'requestor_name' => 'required|string|max:100',
                'issue_fixed_asset_no' => 'required|string|max:100',
                'io_no' => 'required|string|max:100',
                'company_id' => 'required|string|max:100',
                'product_code' => 'required|string|max:100',
                'product_name' => 'required|string|max:100',
                'grn_no' => 'required|string|max:100',
                'asset_group' => 'required|exists:master_asset_groups,id',
                'asset_location' => 'required|exists:master_asset_locations,id',
                'asset_cost_center' => 'required|exists:master_asset_cost_centers,id',
            ]);

            $update = [
                'date' => $request->date,
                'rfa_number' => $request->rfa_number,
                'received_date' => $request->received_date,
                'requestor_name' => $request->requestor_name,
                'issue_fixed_asset_no' => $request->issue_fixed_asset_no,
                'io_no' => $request->io_no,
                'company_id' => $request->company_id,
                'production_code' => $request->product_code,
                'product_name' => $request->product_name,
                'grn_no' => $request->grn_no,
                'asset_group_id' => $request->asset_group,
                'asset_location_id' => $request->asset_location,
                'asset_cost_center_id' => $request->asset_cost_center,
                'updated_by' => Auth::user()->name,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            Digitalassets::where('id', $id)->update($update);

            // Jika request AJAX, balas JSON
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Digital Asset Succesfully updated!']);
            }

            // Jika bukan AJAX, redirect biasa
            return redirect()->route('digitalassets.index')->with('success', 'Digital Asset Succesfully updated!');
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

    public function approvedBy1(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasPermission('manage-digital-assets')) {
            $digitalAsset = Digitalassets::find($id);
            if (!$digitalAsset) {
                return redirect()->route('digitalassets.index')->with('error', 'Digital Asset not found!');
            }

            $digitalAsset->approval_status1 = '1';
            $digitalAsset->approval_by1 = Auth::user()->name;
            $digitalAsset->approval_date1 = Carbon::now();
            $digitalAsset->remark_approval_by1 = $request->remarks ?? '';
            $digitalAsset->save();

            return response()->json(['success' => true, 'message' => 'Digital Asset approved by 1!']);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
    public function approvedBy2(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasPermission('manage-digital-assets')) {
            $digitalAsset = Digitalassets::find($id);
            if (!$digitalAsset) {
                return redirect()->route('digitalassets.index')->with('error', 'Digital Asset not found!');
            }

            $digitalAsset->approval_status2 = '1';
            $digitalAsset->approval_by2 = Auth::user()->name;
            $digitalAsset->approval_date2 = Carbon::now();
            $digitalAsset->remark_approval_by2 = $request->remarks ?? '';
            $digitalAsset->save();

            return response()->json(['success' => true, 'message' => 'Digital Asset approved by 2!']);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
