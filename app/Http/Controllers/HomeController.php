<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Module;
use App\User;
use App\Requestdar;
use DB;
use Illuminate\Support\Facade\Auth;
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
            return view('admin-dashboard.home', [
                'user' => $user,
                'role' => $role,
                'permission' => $permission,
                'module' => $module
            ]);

        } elseif (\Auth::user()->hasRole('user-employee')) {
            $getData = Requestdar::where('nik_req', \Auth::user()->nik)->count();

            // Get user information
            $usersInfo = DB::connection('dar-system')
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
            return view('user-dashboard.user-manager.home');
        } else {
            return view('error.403');
        }


    }
    public function home_()
    {
        return view('layouts.dashboard');
    }
}
