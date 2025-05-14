<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if (Auth::user()->hasPermission('manage-company')) {
            if ($request->ajax()) {
               $data = Company::query();
               return DataTables::of($data)
               ->addColumn('action', function($data){
                   return view('datatables._action-company', [
                       'model'=> $data,
                       'edit_url'=> route('company.edit', $data->id),
                       'delete_url'=> route('company.destroy', $data->id)
                   ]);
               })
               ->editColumn('created_at', function($data){
                return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
               })
               ->make(true);
            }

            return view('company.index');

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
        if (Auth::user()->hasPermission('create-company')) {
            return view('company.create');
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
        if (Auth::user()->hasPermission('create-module')) {
            $validatedData = $request->validate([
                 'company_desc' => 'required',
             ]);
            $data = new Company;
            $data->company_desc = $request->company_desc;
            $data->save();

            return redirect()->route('company.index')->with('success','Added new Company successfully');
         } else {
              return view('error.403');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if (Auth::user()->hasPermission('edit-company')) {
            $data = Company::find($company->id);
            return view('company.edit', compact('data'));
        } else {
            return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if (Auth::user()->hasPermission('edit-company')) {
            $data = Company::find($company->id);
            $data->company_desc = $request->company_desc;
            $data->save();

            return redirect()->route('company.index')->with('success','Update data Company successfully');
         } else {
             return view('error.403');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (Auth::user()->hasPermission('delete-company')) {
            $data = Company::find($company->id);
            $data->delete();
            return response()->json(['msg'=>true]);
        } else {
            return view('error.403');
        }
    }
}
