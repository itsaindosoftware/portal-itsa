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
    // public function index()
    // {

    //     // $userPermissions = DB::connection('portal-itsa')
    //     //     ->table('users')
    //     //     ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
    //     //     ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
    //     //     ->leftJoin('permission_role', 'roles.id', '=', 'permission_role.role_id')
    //     //     ->leftJoin('permissions', 'permission_role.permission_id', '=', 'permissions.id')
    //     //     ->where('users.id', Auth::user()->id)
    //     //     ->pluck('permissions.name')
    //     //     ->toArray();

    //     // if (!Auth::user()->hasPermission('manage-dar-system')) {

    //     // }
    //     if (\Auth::user()->hasRole('admin')) {
    //         $role = Role::count();
    //         $permission = Permission::count();
    //         $module = Module::count();
    //         $user = User::count();

    //         // DAR request statistics
    //         $totalDar = Requestdar::count();
    //         $totalPending = Requestdar::whereIn('approval_status1', ['0'])
    //             ->orWhereIn('approval_status2', ['0'])
    //             ->orWhereIn('approval_status3', ['0'])
    //             ->count();

    //         $totalApproved = Requestdar::where('approval_status1', '1')
    //             ->where('approval_status2', '1')
    //             ->where('approval_status3', '1')
    //             ->count();
    //         $totalRejected = Requestdar::where(function ($query) {
    //             $query->where('approval_status1', '2')
    //                 ->orWhere('approval_status2', '2')
    //                 ->orWhere('approval_status3', '2');
    //         })->count();

    //         // Monthly trend data for the last 12 months
    //         $monthlyTrend = [];
    //         $monthLabels = [];

    //         // Get the current date
    //         $now = Carbon::now();

    //         // Loop through the last 12 months
    //         for ($i = 11; $i >= 0; $i--) {
    //             $month = $now->copy()->subMonths($i);
    //             $monthLabels[] = $month->format('M');

    //             $count = Requestdar::whereYear('created_date', $month->year)
    //                 ->whereMonth('created_date', $month->month)
    //                 ->count();

    //             $monthlyTrend[] = $count;
    //         }

    //         // Department distribution data
    //         $departmentDistribution = DB::connection('portal-itsa')
    //             ->table('request_dar')
    //             ->join('users', 'request_dar.nik_req', '=', 'users.nik')
    //             ->join('departments', 'users.department_id', '=', 'departments.id')
    //             ->select('departments.description', DB::raw('count(*) as total'))
    //             ->groupBy('departments.description')
    //             ->orderBy('total', 'desc')
    //             ->get();

    //         // Department names and counts for chart
    //         $deptNames = $departmentDistribution->pluck('description')->toArray();
    //         $deptCounts = $departmentDistribution->pluck('total')->toArray();



    //         return view('admin-dashboard.home', [
    //             'user' => $user,
    //             'role' => $role,
    //             'permission' => $permission,
    //             'module' => $module,
    //             'totalDar' => $totalDar,
    //             'totalPending' => $totalPending,
    //             'totalApproved' => $totalApproved,
    //             'totalRejected' => $totalRejected,
    //             'monthLabels' => json_encode($monthLabels),
    //             'monthlyTrend' => json_encode($monthlyTrend),
    //             'departmentNames' => json_encode($deptNames),
    //             'departmentCounts' => json_encode($deptCounts),
    //         ]);

    //     } elseif (\Auth::user()->hasRole('user-employee')) {
    //         $getData = Requestdar::where('nik_req', \Auth::user()->nik)->count();

    //         // Get user information
    //         $usersInfo = DB::connection('portal-itsa')
    //             ->table('users')
    //             ->leftJoin('companys', 'users.company_id', '=', 'companys.id')
    //             ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
    //             ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
    //             ->where('nik', \Auth::user()->nik)->first();

    //         // Get monthly requests
    //         $monthlyRequests = Requestdar::where('nik_req', \Auth::user()->nik)
    //             ->whereMonth('created_date', date('m'))
    //             ->whereYear('created_date', date('Y'))
    //             ->count();


    //         return view('users-dashboard.user-employe.home', [
    //             'data' => $getData,
    //             'users' => $usersInfo,
    //             'monthlyRequests' => $monthlyRequests
    //         ]);

    //     } elseif (\Auth::user()->hasRole('manager')) {
    //         $usersInfo = DB::connection('portal-itsa')
    //             ->table('users')
    //             ->leftJoin('companys', 'users.company_id', '=', 'companys.id')
    //             ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
    //             ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
    //             ->where('nik', Auth::user()->nik)->first();
    //         $getData = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->count();
    //         $pendingCount = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->where('approval_status1', '0')->count();
    //         $approvedCount = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->where('approval_status1', '1')->count();
    //         $rejectedCount = Requestdar::where('nik_atasan', Auth::user()->nik)->where('dept_id', Auth::user()->department_id)->where('approval_status1', '2')->count();
    //         return view('users-dashboard.user-manager.home', [
    //             'totalDar' => $getData,
    //             'pending' => $pendingCount,
    //             'approved' => $approvedCount,
    //             'rejected' => $rejectedCount,
    //             'users' => $usersInfo
    //         ]);
    //     } elseif (Auth::user()->hasRole('sysdev')) {
    //         $getData = Requestdar::get()->count();
    //         $pendingCount = Requestdar::where('approval_status2', '0')->count();
    //         $approvedCount = Requestdar::where('approval_status2', '1')->count();
    //         $rejectedCount = Requestdar::where('approval_status2', '2')->count();
    //         $monthlyTrend = [];
    //         $monthLabels = [];

    //         // Get the current date
    //         $now = Carbon::now();

    //         // Loop through the last 6 months
    //         for ($i = 5; $i >= 0; $i--) {
    //             $month = $now->copy()->subMonths($i);
    //             $monthLabels[] = $month->format('M Y');

    //             $count = Requestdar::whereYear('created_date', $month->year)
    //                 ->whereMonth('created_date', $month->month)
    //                 ->count();

    //             $monthlyTrend[] = $count;
    //         }

    //         // Get department distribution data
    //         $departmentDistribution = DB::connection('portal-itsa')
    //             ->table('request_dar')
    //             ->join('users', 'request_dar.nik_req', '=', 'users.nik')
    //             ->join('departments', 'users.department_id', '=', 'departments.id')
    //             ->select('departments.description', DB::raw('count(*) as total'))
    //             ->groupBy('departments.description')
    //             ->orderBy('total', 'desc')
    //             ->limit(10)
    //             ->get();

    //         $pendingRequestsList = DB::connection('portal-itsa')
    //             ->table('request_dar')
    //             ->join('users as requester', 'request_dar.nik_req', '=', 'requester.nik')
    //             ->join('departments', 'requester.department_id', '=', 'departments.id')
    //             ->select(
    //                 'request_dar.id',
    //                 'request_dar.number_dar as request_id',
    //                 'requester.name as requester_name',
    //                 'departments.description as department',
    //                 'request_dar.created_date as created_at',
    //                 'request_dar.approval_status2'
    //             )
    //             ->where('request_dar.approval_status2', '0')
    //             ->orderBy('request_dar.created_date', 'desc')
    //             ->limit(5)
    //             ->get();


    //         return view('users-dashboard.sysdev.home', [
    //             'totalDar' => $getData,
    //             'pending' => $pendingCount,
    //             'approved' => $approvedCount,
    //             'rejected' => $rejectedCount,
    //             'monthLabels' => json_encode($monthLabels),
    //             'monthlyTrend' => json_encode($monthlyTrend),
    //             'departmentDistribution' => $departmentDistribution,
    //             'pendingRequest' => $pendingRequestsList
    //         ]);
    //     } elseif (Auth::user()->hasRole('manager-it')) {
    //         $getData = Requestdar::get()->count();
    //         $pendingCount = Requestdar::where('approval_status3', '0')->count();
    //         $approvedCount = Requestdar::where('approval_status3', '1')->count();
    //         $rejectedCount = Requestdar::where('approval_status3', '2')->count();
    //         $monthlyTrend = [];
    //         $monthLabels = [];

    //         // Get the current date
    //         $now = Carbon::now();

    //         // Loop through the last 6 months
    //         for ($i = 5; $i >= 0; $i--) {
    //             $month = $now->copy()->subMonths($i);
    //             $monthLabels[] = $month->format('M Y');

    //             $count = Requestdar::whereYear('created_date', $month->year)
    //                 ->whereMonth('created_date', $month->month)
    //                 ->count();

    //             $monthlyTrend[] = $count;
    //         }

    //         // Get department distribution data
    //         $departmentDistribution = DB::connection('portal-itsa')
    //             ->table('request_dar')
    //             ->join('users', 'request_dar.nik_req', '=', 'users.nik')
    //             ->join('departments', 'users.department_id', '=', 'departments.id')
    //             ->select('departments.description', DB::raw('count(*) as total'))
    //             ->groupBy('departments.description')
    //             ->orderBy('total', 'desc')
    //             ->limit(10)
    //             ->get();

    //         $pendingRequestsList = DB::connection('portal-itsa')
    //             ->table('request_dar')
    //             ->join('users as requester', 'request_dar.nik_req', '=', 'requester.nik')
    //             ->join('departments', 'requester.department_id', '=', 'departments.id')
    //             ->select(
    //                 'request_dar.id',
    //                 'request_dar.number_dar as request_id',
    //                 'requester.name as requester_name',
    //                 'departments.description as department',
    //                 'request_dar.created_date as created_at',
    //                 'request_dar.approval_status3'
    //             )
    //             ->where('request_dar.approval_status3', '0')
    //             ->orderBy('request_dar.created_date', 'desc')
    //             ->limit(5)
    //             ->get();

    //         return view('users-dashboard.sysdevit-mgr.home', [
    //             'totalDar' => $getData,
    //             'pending' => $pendingCount,
    //             'approved' => $approvedCount,
    //             'rejected' => $rejectedCount,
    //             'monthLabels' => json_encode($monthLabels),
    //             'monthlyTrend' => json_encode($monthlyTrend),
    //             'departmentDistribution' => $departmentDistribution,
    //             'pendingRequest' => $pendingRequestsList
    //         ]);
    //         // digital assets session
    //     } elseif (Auth::user()->hasRole('user-employee-digassets')) {
    //         $totalAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->count();

    //         // Active Assets
    //         $totalActiveAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('status', 'active')
    //             ->count();

    //         // Inactive Assets
    //         $totalInactiveAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('status', 'inactive')
    //             ->count();

    //         // Approval statistics
    //         $waitingApproval1 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status1', '0')
    //             ->count();
    //         $approvedAssets1 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status1', '1')
    //             ->count();
    //         $rejectedAssets1 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status1', '2')
    //             ->count();

    //         $waitingApproval2 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status2', '0')
    //             ->count();
    //         $approvedAssets2 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status2', '1')
    //             ->count();
    //         $rejectedAssets2 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status2', '2')
    //             ->count();

    //         $waitingApproval3 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status3', '0')
    //             ->count();
    //         $approvedAssets3 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status3', '1')
    //             ->count();
    //         $rejectedAssets3 = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status3', '2')
    //             ->count();

    //         // Asset Group Distribution
    //         $assetGroups = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->join('master_asset_groups', 'registration_fixed_assets.asset_group_id', '=', 'master_asset_groups.id')
    //             ->select('master_asset_groups.asset_group_name', DB::raw('count(*) as total'))
    //             ->groupBy('master_asset_groups.asset_group_name')
    //             ->orderBy('total', 'desc')
    //             ->get();

    //         // Recent Activity (last 5 assets)
    //         $recentAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->orderBy('created_at', 'desc')
    //             ->limit(5)
    //             ->get();

    //         return view('users-dashboard.digassets.user-employee-digassets.home', [
    //             'totalAssets' => $totalAssets,
    //             'totalActiveAssets' => $totalActiveAssets,
    //             'totalInactiveAssets' => $totalInactiveAssets,
    //             'assetGroups' => $assetGroups,
    //             'recentAssets' => $recentAssets,
    //             // Approval 1
    //             'waitingApproval1' => $waitingApproval1,
    //             'approvedAssets1' => $approvedAssets1,
    //             'rejectedAssets1' => $rejectedAssets1,
    //             // Approval 2
    //             'waitingApproval2' => $waitingApproval2,
    //             'approvedAssets2' => $approvedAssets2,
    //             'rejectedAssets2' => $rejectedAssets2,
    //             // Approval 3
    //             'waitingApproval3' => $waitingApproval3,
    //             'approvedAssets3' => $approvedAssets3,
    //             'rejectedAssets3' => $rejectedAssets3,
    //         ]);
    //     } elseif (Auth::user()->hasRole('user-acct-digassets')) {
    //         $totalAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->count();

    //         $totalWaitingAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status2', '0')
    //             ->count();

    //         $totalApprovedAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status2', '1')
    //             ->count();

    //         $totalRejectedAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status2', '2')
    //             ->count();


    //         return view('users-dashboard.digassets.user-acct-digassets.home', [
    //             'totalAssets' => $totalAssets,
    //             'totalApprovedAssets' => $totalApprovedAssets,
    //             'totalWaitingAssets' => $totalWaitingAssets,
    //             'totalRejectedAssets' => $totalRejectedAssets,
    //         ]);
    //     } elseif (Auth::user()->hasRole('user-mgr-dept-head')) {

    //         $totalAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->count();

    //         $totalWaitingAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status3', '0')
    //             ->count();

    //         $totalApprovedAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status3', '1')
    //             ->count();

    //         $totalRejectedAssets = DB::connection('portal-itsa')
    //             ->table('registration_fixed_assets')
    //             ->where('approval_status3', '2')
    //             ->count();
    //         return view('users-dashboard.digassets.user-mgr-dept-head.home', [
    //             'totalAssets' => $totalAssets,
    //             'totalWaitingAssets' => $totalWaitingAssets,
    //             'totalApprovedAssets' => $totalApprovedAssets,
    //             'totalRejectedAssets' => $totalRejectedAssets,
    //         ]);
    //     } else {
    //         return view('error.403');
    //     }


    // }
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('user-employee')) {
            return $this->employeeDashboard();
        } elseif ($user->hasRole('manager')) {
            return $this->managerDashboard();
        } elseif ($user->hasRole('sysdev')) {
            return $this->sysdevDashboard();
        } elseif ($user->hasRole('manager-it')) {
            return $this->managerItDashboard();
        } elseif ($user->hasRole('user-employee-digassets')) {
            return $this->employeeDigitalAssetsDashboard();
        } elseif ($user->hasRole('user-acct-digassets')) {
            return $this->accountingDigitalAssetsDashboard();
        } elseif ($user->hasRole('user-mgr-dept-head')) {
            return $this->departmentHeadDigitalAssetsDashboard();
        } elseif ($user->hasRole('manager-directur')) {
            return $this->managerDirDashboard();
        } elseif ($user->hasRole('user-receive-sendnotif-dept')) {
            return $this->userReceiveSendNotifDeptDashboard();
        } elseif ($user->hasRole('user-mgr-receive-send-notif-dept')) {
            return $this->userMgrReceiveSendNotifDeptDashboard();
        } elseif ($user->hasRole('user-gm-accfinn-sendnotif')) {
            return $this->userGMSendNotifDeptDashboard();
        }

        return view('error.403');
    }

    private function adminDashboard()
    {
        $systemStats = $this->getSystemStatistics();
        $darStats = $this->getDarStatistics();
        $monthlyTrend = $this->getMonthlyTrend(12);
        $departmentData = $this->getDepartmentDistribution();

        return view('admin-dashboard.home', array_merge(
            $systemStats,
            $darStats,
            $monthlyTrend,
            $departmentData
        ));
    }

    private function employeeDashboard()
    {
        $userNik = Auth::user()->nik;
        $requestCount = Requestdar::where('nik_req', $userNik)->count();
        $userInfo = $this->getUserInfo($userNik);
        // $monthlyRequests = $this->getMonthlyUserRequests($userNik);
        $totalRequests = $this->getTotalRequests();
        $lastUpdateRequest = $this->getLastUpdateRequest();
        $totalDocs = $this->getMasterDocsCount();

        return view('users-dashboard.user-employe.home', [
            'data' => $requestCount,
            'users' => $userInfo,
            'totalRequests' => $totalRequests,
            'lastUpdateRequest' => $lastUpdateRequest,
            'totalDocs' => $totalDocs
            // 'monthlyRequests' => $monthlyRequests
        ]);
    }

    private function managerDashboard()
    {
        $user = Auth::user();
        $userInfo = $this->getUserInfo($user->nik);
        $managerStats = $this->getManagerStatistics($user->department_id);
        // dd($managerStats);
        return view('users-dashboard.user-manager.home', array_merge(
            $managerStats,
            ['users' => $userInfo]
        ));
    }

    private function sysdevDashboard()
    {
        $darStats = $this->getSysdevStatistics();
        $monthlyTrend = $this->getMonthlyTrend(6, 'M Y');
        $departmentData = $this->getDepartmentDistribution(10);
        $pendingRequests = $this->getPendingRequestsList('approval_status2');

        return view('users-dashboard.sysdev.home', array_merge(
            $darStats,
            $monthlyTrend,
            ['departmentDistribution' => $departmentData['distribution']],
            ['pendingRequest' => $pendingRequests]
        ));
    }

    private function managerItDashboard()
    {
        $darStats = $this->getManagerItStatistics();
        $monthlyTrend = $this->getMonthlyTrend(6, 'M Y');
        $departmentData = $this->getDepartmentDistribution(10);
        $pendingRequests = $this->getPendingRequestsList('approval_status3');

        return view('users-dashboard.sysdevit-mgr.home', array_merge(
            $darStats,
            $monthlyTrend,
            ['departmentDistribution' => $departmentData['distribution']],
            ['pendingRequest' => $pendingRequests]
        ));
    }

    private function employeeDigitalAssetsDashboard()
    {
        $assetStats = $this->getDigitalAssetStatistics();
        $approvalStats = $this->getDigitalAssetApprovalStatistics();
        $assetGroups = $this->getAssetGroupDistribution();
        $recentAssets = $this->getRecentAssets();

        return view('users-dashboard.digassets.user-employee-digassets.home', array_merge(
            $assetStats,
            $approvalStats,
            ['assetGroups' => $assetGroups],
            ['recentAssets' => $recentAssets]
        ));
    }

    private function accountingDigitalAssetsDashboard()
    {
        $assetStats = $this->getAccountingDigitalAssetStatistics();

        return view('users-dashboard.digassets.user-acct-digassets.home', $assetStats);
    }

    private function departmentHeadDigitalAssetsDashboard()
    {
        $assetStats = $this->getDepartmentHeadDigitalAssetStatistics();

        return view('users-dashboard.digassets.user-mgr-dept-head.home', $assetStats);
    }
    private function managerDirDashboard()
    {
        $assetStats = $this->getManagerDirDigitalAssetsStatistics();

        return view('users-dashboard.digassets.user-mgrdir.home', $assetStats);
    }
    private function userReceiveSendNotifDeptDashboard()
    {
        $assetStats = $this->getUserReceivedSendNotifDeptStatistics();

        return view('users-dashboard.digassets.user-receive-dept-sendnotif.home', $assetStats);
    }
    private function userMgrReceiveSendNotifDeptDashboard()
    {
        $assetStats = $this->getUserMgrReceivedSendNotifDeptStatistics();

        return view('users-dashboard.digassets.user-mgr-receive-dept-sendnotif.home', $assetStats);
    }
    private function userGMSendNotifDeptDashboard()
    {
        $assetStats = $this->getGMSendNotifStatistics();

        return view('users-dashboard.digassets.user-gm-accfin-sendnotif.home', $assetStats);
    }

    // Helper methods for statistics
    private function getSystemStatistics()
    {
        return [
            'user' => User::count(),
            'role' => Role::count(),
            'permission' => Permission::count(),
            'module' => Module::count(),
        ];
    }

    private function getDarStatistics()
    {
        $totalDar = Requestdar::count();

        $totalPending = Requestdar::where(function ($query) {
            $query->whereIn('approval_status1', ['0'])
                ->orWhereIn('approval_status2', ['0'])
                ->orWhereIn('approval_status3', ['0']);
        })->count();

        $totalApproved = Requestdar::where('approval_status1', '1')
            ->where('approval_status2', '1')
            ->where('approval_status3', '1')
            ->count();

        $totalRejected = Requestdar::where(function ($query) {
            $query->where('approval_status1', '2')
                ->orWhere('approval_status2', '2')
                ->orWhere('approval_status3', '2');
        })->count();

        return [
            'totalDar' => $totalDar,
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
        ];
    }

    private function getMonthlyTrend($months = 12, $format = 'M')
    {
        $monthlyTrend = [];
        $monthLabels = [];
        $now = Carbon::now();

        for ($i = $months - 1; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $monthLabels[] = $month->format($format);

            $count = Requestdar::whereYear('created_date', $month->year)
                ->whereMonth('created_date', $month->month)
                ->count();

            $monthlyTrend[] = $count;
        }

        return [
            'monthLabels' => json_encode($monthLabels),
            'monthlyTrend' => json_encode($monthlyTrend),
        ];
    }

    private function getDepartmentDistribution($limit = null)
    {
        $query = DB::connection('portal-itsa')
            ->table('request_dar')
            ->join('users', 'request_dar.nik_req', '=', 'users.nik')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->select('departments.description', DB::raw('count(*) as total'))
            ->groupBy('departments.description')
            ->orderBy('total', 'desc');

        if ($limit) {
            $query->limit($limit);
        }

        $distribution = $query->get();

        return [
            'distribution' => $distribution,
            'departmentNames' => json_encode($distribution->pluck('description')->toArray()),
            'departmentCounts' => json_encode($distribution->pluck('total')->toArray()),
        ];
    }

    private function getUserInfo($nik)
    {
        return DB::connection('portal-itsa')
            ->table('users')
            ->leftJoin('companys', 'users.company_id', '=', 'companys.id')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->where('nik', $nik)
            ->first();
    }

    // private function getMonthlyUserRequests($nik)
    // {
    //     return Requestdar::where('nik_req', $nik)
    //         ->whereMonth('created_date', date('m'))
    //         ->whereYear('created_date', date('Y'))
    //         ->count();
    // }
    private function getTotalRequests()
    {
        return Requestdar::count();
    }

    /**
     * Get last updated request
     */
    private function getLastUpdateRequest()
    {
        return Requestdar::where('user_id', Auth::user()->id)->orderBy('updated_bydate_1', 'desc')->first();
    }

    private function getMasterDocsCount()
    {
        return DB::connection('portal-itsa')
            ->table('master_documents')
            ->count();
    }

    private function getManagerStatistics($departmentId)
    {
        // dd($departmentId);
        $baseQuery = Requestdar::where('dept_id', $departmentId);
        $pending = (clone $baseQuery)->where('approval_status1', '0')->count();
        $approved = (clone $baseQuery)->where('approval_status1', '1')->count();
        $rejected = (clone $baseQuery)->where('approval_status1', '2')->count();
        // dd($approved);
        return [
            'totalDar' => $baseQuery->count(),
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
        ];
    }

    private function getSysdevStatistics()
    {
        return [
            'totalDar' => Requestdar::count(),
            'pending' => Requestdar::where('approval_status2', '0')->count(),
            'approved' => Requestdar::where('approval_status2', '1')->count(),
            'rejected' => Requestdar::where('approval_status2', '2')->count(),
        ];
    }

    private function getManagerItStatistics()
    {
        return [
            'totalDar' => Requestdar::count(),
            'pending' => Requestdar::where('approval_status3', '0')->count(),
            'approved' => Requestdar::where('approval_status3', '1')->count(),
            'rejected' => Requestdar::where('approval_status3', '2')->count(),
        ];
    }

    private function getPendingRequestsList($statusColumn)
    {
        return DB::connection('portal-itsa')
            ->table('request_dar')
            ->join('users as requester', 'request_dar.nik_req', '=', 'requester.nik')
            ->join('departments', 'requester.department_id', '=', 'departments.id')
            ->select(
                'request_dar.id',
                'request_dar.number_dar as request_id',
                'requester.name as requester_name',
                'departments.description as department',
                'request_dar.created_date as created_at',
                "request_dar.{$statusColumn}"
            )
            ->where("request_dar.{$statusColumn}", '0')
            ->orderBy('request_dar.created_date', 'desc')
            ->limit(5)
            ->get();
    }

    // Digital Assets Helper Methods
    private function getDigitalAssetStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalAssets' => DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->count(),
            'totalActiveAssets' => DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('status', 'active')
                ->count(),
            'totalInactiveAssets' => DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->where('status', 'inactive')
                ->count(),
            'users' => $userInfo
        ];
    }

    private function getDigitalAssetApprovalStatistics()
    {
        $table = 'registration_fixed_assets';

        return [
            // Approval Level 1
            'waitingApproval1' => $this->getAssetCountByStatus($table, 'approval_status1', '0'),
            'approvedAssets1' => $this->getAssetCountByStatus($table, 'approval_status1', '1'),
            'rejectedAssets1' => $this->getAssetCountByStatus($table, 'approval_status1', '2'),

            // Approval Level 2
            'waitingApproval2' => $this->getAssetCountByStatus($table, 'approval_status2', '0'),
            'approvedAssets2' => $this->getAssetCountByStatus($table, 'approval_status2', '1'),
            'rejectedAssets2' => $this->getAssetCountByStatus($table, 'approval_status2', '2'),

            // Approval Level 3
            'waitingApproval3' => $this->getAssetCountByStatus($table, 'approval_status3', '0'),
            'approvedAssets3' => $this->getAssetCountByStatus($table, 'approval_status3', '1'),
            'rejectedAssets3' => $this->getAssetCountByStatus($table, 'approval_status3', '2'),
        ];
    }

    private function getAssetCountByStatus($table, $column, $status)
    {
        return DB::connection('portal-itsa')
            ->table($table)
            ->where($column, $status)
            ->count();
    }

    private function getAssetGroupDistribution()
    {
        return DB::connection('portal-itsa')
            ->table('registration_fixed_assets')
            ->join('master_asset_groups', 'registration_fixed_assets.asset_group_id', '=', 'master_asset_groups.id')
            ->select('master_asset_groups.asset_group_name', DB::raw('count(*) as total'))
            ->groupBy('master_asset_groups.asset_group_name')
            ->orderBy('total', 'desc')
            ->get();
    }

    private function getRecentAssets()
    {
        return DB::connection('portal-itsa')
            ->table('registration_fixed_assets')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    private function getAccountingDigitalAssetStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalAssets' => DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->count(),
            'totalWaitingAssets' => $this->getAssetCountByStatus('registration_fixed_assets', 'approval_status2', '0'),
            'totalApprovedAssets' => $this->getAssetCountByStatus('registration_fixed_assets', 'approval_status2', '1'),
            'totalRejectedAssets' => $this->getAssetCountByStatus('registration_fixed_assets', 'approval_status2', '2'),
            'users' => $userInfo
        ];
    }

    private function getDepartmentHeadDigitalAssetStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalAssets' => DB::connection('portal-itsa')
                ->table('registration_fixed_assets')
                ->count(),
            'totalWaitingAssets' => $this->getAssetCountByStatus('registration_fixed_assets', 'approval_status3', '0'),
            'totalApprovedAssets' => $this->getAssetCountByStatus('registration_fixed_assets', 'approval_status3', '1'),
            'totalRejectedAssets' => $this->getAssetCountByStatus('registration_fixed_assets', 'approval_status3', '2'),
            'users' => $userInfo
        ];
    }

    private function getManagerDirDigitalAssetsStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalData' => DB::connection('portal-itsa')
                ->table('asset_tf_notif')
                ->count(),
            'totalWaiting' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status2', '0'),
            'totalApproval' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status2', '1'),
            'totalReject' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status2', '3'),
            'users' => $userInfo
        ];
    }
    private function getUserReceivedSendNotifDeptStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalData' => DB::connection('portal-itsa')
                ->table('asset_tf_notif')
                ->count(),
            'totalWaiting' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status3', '0'),
            'totalApproval' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status3', '1'),
            'totalReject' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status3', '3'),
            'users' => $userInfo
        ];
    }
    private function getUserMgrReceivedSendNotifDeptStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalData' => DB::connection('portal-itsa')
                ->table('asset_tf_notif')
                ->count(),
            'totalWaiting' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status4', '0'),
            'totalApproval' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status4', '1'),
            'totalReject' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status4', '3'),
            'users' => $userInfo
        ];
    }
    private function getGMSendNotifStatistics()
    {
        $userNik = Auth::user()->nik;
        $userInfo = $this->getUserInfo($userNik);
        return [
            'totalData' => DB::connection('portal-itsa')
                ->table('asset_tf_notif')
                ->count(),
            'totalWaiting' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status5', '0'),
            'totalApproval' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status5', '1'),
            'totalReject' => $this->getAssetCountByStatus('asset_tf_notif', 'approval_status5', '3'),
            'users' => $userInfo
        ];
    }

    // private function getCountListDataSendNotif($table,)

    public function home_()
    {
        return view('layouts.dashboard');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
}
