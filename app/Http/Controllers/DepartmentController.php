<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if (Auth::user()->hasPermission('manage-department')) {
            if ($request->ajax()) {
               $data = Department::query();
               return DataTables::of($data)
               ->addColumn('action', function($data){
                   return view('datatables._action-department', [
                       'model'=> $data,
                       'edit_url'=> route('department.edit', $data->id),
                       'delete_url'=> route('department.destroy', $data->id)
                   ]);
               })
               ->editColumn('created_at', function($data){
                return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
               })
               ->make(true);
            }

            return view('department.index');

        } else {
           return view('error.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission('create-department')) {
            return view('department.create');
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
        if (Auth::user()->hasPermission('create-department')) {
            $validatedData = $request->validate([
                 'description' => 'required',
             ]);
            $data = new Department;
            $data->description = $request->description;
            $data->save();

            return redirect()->route('department.index')->with('success','Added new Department successfully');
         } else {
              return view('error.403');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        if (Auth::user()->hasPermission('edit-company')) {
            $data = Department::find($department->id);
            return view('department.edit', compact('data'));
        } else {
            return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        if (Auth::user()->hasPermission('edit-department')) {
            $data = Department::find($department->id);
            $data->description = $request->description;
            $data->save();

            return redirect()->route('department.index')->with('success','Update data Department successfully');
         } else {
             return view('error.403');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if (Auth::user()->hasPermission('delete-department')) {
            $data = Department::find($department->id);
            $data->delete();
            return response()->json(['msg'=>true]);
        } else {
            return view('error.403');
        }
    }
}
