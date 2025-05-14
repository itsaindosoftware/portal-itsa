<?php

namespace App\Http\Controllers;

use App\Position;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasPermission('manage-position')) {
            if ($request->ajax()) {
               $data = Position::query();
               return DataTables::of($data)
               ->addColumn('action', function($data){
                   return view('datatables._action-position', [
                       'model'=> $data,
                       'edit_url'=> route('position.edit', $data->id),
                       'delete_url'=> route('position.destroy', $data->id)
                   ]);
               })
               ->editColumn('created_at', function($data){
                return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
               })
               ->make(true);
            }

            return view('position.index');

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
        if (Auth::user()->hasPermission('create-position')) {
            return view('position.create');
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
        if (Auth::user()->hasPermission('create-position')) {
            $validatedData = $request->validate([
                 'position_desc' => 'required',
             ]);
            $data = new Position;
            $data->position_desc = $request->position_desc;
            $data->save();

            return redirect()->route('position.index')->with('success','Added new Position successfully');
         } else {
              return view('error.403');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        if (Auth::user()->hasPermission('edit-position')) {
            $data = Position::find($position->id);
            return view('position.edit', compact('data'));
        } else {
            return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        if (Auth::user()->hasPermission('edit-position')) {
            $data = Position::find($position->id);
            $data->position_desc = $request->position_desc;
            $data->save();

            return redirect()->route('position.index')->with('success','Update data Position successfully');
         } else {
             return view('error.403');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        if (Auth::user()->hasPermission('delete-position')) {
            $data = Position::find($company->id);
            $data->delete();
            return response()->json(['msg'=>true]);
        } else {
            return view('error.403');
        }
    }
}
