<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Module;
use App\User;
use App\Requestdar;
use DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::user()->hasRole('admin')) {
            $role = Role::count();
            $permission = Permission::count();
            $module = Module::count();
            $user = User::count();

            // DAR request statistics
            $totalDar = Requestdar::count();
            $totalPending = Requestdar::whereIn('approval_status1', ['0'])
                ->orWhereIn('approval_status2', ['0'])
                ->orWhereIn('approval_status3', ['0'])
                ->count();

            $totalApproved = Requestdar::where('approval_status1', '1')
                ->where('approval_status2', '1')
                ->where('approval_status3', '1')
                ->count();
            $totalRejected = Requestdar::where(function ($query) {
                $query->where('approval_status1', '2')
                    ->orWhere('approval_status2', '2')
                    ->orWhere('approval_status3', '2');
            })->count();

            // Monthly trend data for the last 12 months
            $monthlyTrend = [];
            $monthLabels = [];

            // Get the current date
            $now = Carbon::now();

            // Loop through the last 12 months
            for ($i = 11; $i >= 0; $i--) {
                $month = $now->copy()->subMonths($i);
                $monthLabels[] = $month->format('M');

                $count = Requestdar::whereYear('created_date', $month->year)
                    ->whereMonth('created_date', $month->month)
                    ->count();

                $monthlyTrend[] = $count;
            }

            // Department distribution data
            $departmentDistribution = DB::connection('portal-itsa')
                ->table('request_dar')
                ->join('users', 'request_dar.nik_req', '=', 'users.nik')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->select('departments.description', DB::raw('count(*) as total'))
                ->groupBy('departments.description')
                ->orderBy('total', 'desc')
                ->get();

            // Department names and counts for chart
            $deptNames = $departmentDistribution->pluck('description')->toArray();
            $deptCounts = $departmentDistribution->pluck('total')->toArray();



            return view('admin-dashboard.home', [
                'user' => $user,
                'role' => $role,
                'permission' => $permission,
                'module' => $module,
                'totalDar' => $totalDar,
                'totalPending' => $totalPending,
                'totalApproved' => $totalApproved,
                'totalRejected' => $totalRejected,
                'monthLabels' => json_encode($monthLabels),
                'monthlyTrend' => json_encode($monthlyTrend),
                'departmentNames' => json_encode($deptNames),
                'departmentCounts' => json_encode($deptCounts),
            ]);

        } elseif (\Auth::user()->hasRole('user-employee')) {
            $getData = Requestdar::where('nik_req', \Auth::user()->nik)->count();

            // Get user information
            $usersInfo = DB::connection('portal-itsa')
                ->table('users')
                ->leftJoin('companys', 'users.company_id', '=', 'companys.id')
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                ->where('nik', \Auth::user()->nik)->first();

            // Get monthly requests
            $monthlyRequests = Requestdar::where('nik_req', \Auth::user()->nik)
                ->whereMonth('created_date', date('m'))
                ->whereYear('created_date', date('Y'))
                ->count();


            return view('users-dashboard.user-employe.home', [
                'data' => $getData,
                'users' => $usersInfo,
                'monthlyRequests' => $monthlyRequests
            ]);

        } elseif (\Auth::user()->hasRole('manager')) {
            $usersInfo = DB::connection('portal-itsa')
                ->table('users')
                ->leftJoin('companys', 'users.company_id', '=', 'companys.id')
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                ->where('nik', Auth::user()->nik)->first();
            $getData = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->count();
            $pendingCount = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->where('approval_status1', '0')->count();
            $approvedCount = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->where('approval_status1', '1')->count();
            $rejectedCount = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->where('approval_status1', '2')->count();
            return view('users-dashboard.user-manager.home', [
                'totalDar' => $getData,
                'pending' => $pendingCount,
                'approved' => $approvedCount,
                'rejected' => $rejectedCount,
                'users' => $usersInfo
            ]);
        } elseif (Auth::user()->hasRole('sysdev')) {
            $getData = Requestdar::get()->count();
            $pendingCount = Requestdar::where('approval_status2', '0')->count();
            $approvedCount = Requestdar::where('approval_status2', '1')->count();
            $rejectedCount = Requestdar::where('approval_status2', '2')->count();
            $monthlyTrend = [];
            $monthLabels = [];

            // Get the current date
            $now = Carbon::now();

            // Loop through the last 6 months
            for ($i = 5; $i >= 0; $i--) {
                $month = $now->copy()->subMonths($i);
                $monthLabels[] = $month->format('M Y');

                $count = Requestdar::whereYear('created_date', $month->year)
                    ->whereMonth('created_date', $month->month)
                    ->count();

                $monthlyTrend[] = $count;
            }

            // Get department distribution data
            $departmentDistribution = DB::connection('portal-itsa')
                ->table('request_dar')
                ->join('users', 'request_dar.nik_req', '=', 'users.nik')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->select('departments.description', DB::raw('count(*) as total'))
                ->groupBy('departments.description')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();

            $pendingRequestsList = DB::connection('portal-itsa')
                ->table('request_dar')
                ->join('users as requester', 'request_dar.nik_req', '=', 'requester.nik')
                ->join('departments', 'requester.department_id', '=', 'departments.id')
                ->select(
                    'request_dar.id',
                    'request_dar.number_dar as request_id',
                    'requester.name as requester_name',
                    'departments.description as department',
                    'request_dar.created_date as created_at',
                    'request_dar.approval_status2'
                )
                ->where('request_dar.approval_status2', '0')
                ->orderBy('request_dar.created_date', 'desc')
                ->limit(5)
                ->get();


            return view('users-dashboard.sysdev.home', [
                'totalDar' => $getData,
                'pending' => $pendingCount,
                'approved' => $approvedCount,
                'rejected' => $rejectedCount,
                'monthLabels' => json_encode($monthLabels),
                'monthlyTrend' => json_encode($monthlyTrend),
                'departmentDistribution' => $departmentDistribution,
                'pendingRequest' => $pendingRequestsList
            ]);
        } elseif (Auth::user()->hasRole('manager-it')) {
            $getData = Requestdar::get()->count();
            $pendingCount = Requestdar::where('approval_status3', '0')->count();
            $approvedCount = Requestdar::where('approval_status3', '1')->count();
            $rejectedCount = Requestdar::where('approval_status3', '2')->count();
            $monthlyTrend = [];
            $monthLabels = [];

            // Get the current date
            $now = Carbon::now();

            // Loop through the last 6 months
            for ($i = 5; $i >= 0; $i--) {
                $month = $now->copy()->subMonths($i);
                $monthLabels[] = $month->format('M Y');

                $count = Requestdar::whereYear('created_date', $month->year)
                    ->whereMonth('created_date', $month->month)
                    ->count();

                $monthlyTrend[] = $count;
            }

            // Get department distribution data
            $departmentDistribution = DB::connection('portal-itsa')
                ->table('request_dar')
                ->join('users', 'request_dar.nik_req', '=', 'users.nik')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->select('departments.description', DB::raw('count(*) as total'))
                ->groupBy('departments.description')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();

            $pendingRequestsList = DB::connection('portal-itsa')
                ->table('request_dar')
                ->join('users as requester', 'request_dar.nik_req', '=', 'requester.nik')
                ->join('departments', 'requester.department_id', '=', 'departments.id')
                ->select(
                    'request_dar.id',
                    'request_dar.number_dar as request_id',
                    'requester.name as requester_name',
                    'departments.description as department',
                    'request_dar.created_date as created_at',
                    'request_dar.approval_status3'
                )
                ->where('request_dar.approval_status3', '0')
                ->orderBy('request_dar.created_date', 'desc')
                ->limit(5)
                ->get();

            return view('users-dashboard.sysdevit-mgr.home', [
                'totalDar' => $getData,
                'pending' => $pendingCount,
                'approved' => $approvedCount,
                'rejected' => $rejectedCount,
                'monthLabels' => json_encode($monthLabels),
                'monthlyTrend' => json_encode($monthlyTrend),
                'departmentDistribution' => $departmentDistribution,
                'pendingRequest' => $pendingRequestsList
            ]);
            // digital assets session
        } elseif (Auth::user()->hasRole('user-employee-digassets')) {
            $totalAssets = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->count();

            // Active Assets
            $totalActiveAssets = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('status', 'active')
                ->count();

            // Inactive Assets
            $totalInactiveAssets = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('status', 'inactive')
                ->count();

            // Approval statistics
            $waitingApproval1 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status1', '0')
                ->count();
            $approvedAssets1 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status1', '1')
                ->count();
            $rejectedAssets1 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status1', '2')
                ->count();

            $waitingApproval2 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status2', '0')
                ->count();
            $approvedAssets2 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status2', '1')
                ->count();
            $rejectedAssets2 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status2', '2')
                ->count();

            $waitingApproval3 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status3', '0')
                ->count();
            $approvedAssets3 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status3', '1')
                ->count();
            $rejectedAssets3 = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('approval_status3', '2')
                ->count();

            // Asset Group Distribution
            $assetGroups = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->join('master_asset_groups', 'registration_fixed_assets.asset_group_id', '=', 'master_asset_groups.id')
                ->select('master_asset_groups.asset_group_name', DB::raw('count(*) as total'))
                ->groupBy('master_asset_groups.asset_group_name')
                ->orderBy('total', 'desc')
                ->get();

            // Recent Activity (last 5 assets)
            $recentAssets = DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('users-dashboard.digassets.user-employee-digassets.home', [
                'totalAssets' => $totalAssets,
                'totalActiveAssets' => $totalActiveAssets,
                'totalInactiveAssets' => $totalInactiveAssets,
                'assetGroups' => $assetGroups,
                'recentAssets' => $recentAssets,
                // Approval 1
                'waitingApproval1' => $waitingApproval1,
                'approvedAssets1' => $approvedAssets1,
                'rejectedAssets1' => $rejectedAssets1,
                // Approval 2
                'waitingApproval2' => $waitingApproval2,
                'approvedAssets2' => $approvedAssets2,
                'rejectedAssets2' => $rejectedAssets2,
                // Approval 3
                'waitingApproval3' => $waitingApproval3,
                'approvedAssets3' => $approvedAssets3,
                'rejectedAssets3' => $rejectedAssets3,
            ]);
        } else {
            return view('error.403');
        }


    }
    public function home_()
    {
        return view('layouts.dashboard');
    }
}
