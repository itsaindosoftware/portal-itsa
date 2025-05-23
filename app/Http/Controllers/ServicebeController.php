<?php

namespace App\Http\Controllers;

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
use App\Servicebe;
class ServicebeController extends Controller
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
        if (Auth::user()->hasPermission('manage-portalitsa-service')) {
            if ($request->ajax()) {
                $service = Servicebe::query();

                return DataTables::of($service)
                    ->addColumn('action', function ($service) {
                        return view('datatables._action-service', [
                            'model' => $service,
                            'edit_url' => route('servicebe.edit', $service->id),
                            'delete_url' => route('servicebe.destroy', $service->id),
                            'show_url' => route('servicebe.show', $service->id)
                        ]);
                    })
                    ->editColumn('title', function ($title) {
                        return '<span class="badge badge-secondary">' . $title->title . '</span>';
                    })
                    ->rawColumns(['action', 'title'])
                    ->make(true);
            }
            return view('service.index');
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
        if (Auth::user()->hasPermission('create-portalitsa-service')) {
            return view('service.create');
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
        if (Auth::user()->hasPermission('create-portalitsa-service')) {
            $validatedData = $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);

            $user = new Servicebe();
            $user->title = $request->title;
            $user->description = $request->description;
            $user->created_by = Auth::user()->username;
            $user->created_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect()->route('servicebe.index')->with('success', __('new Service successfully created'));
        } else {
            return view('error.403');
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
        if (Auth::user()->hasPermission(['manage-portalitsa-service', 'show-portalitsa-service'])) {
            $data = Servicebe::where('id', $id)->get();
            return response()->json($data);
        } else {
            return view('error.403');
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
        if (Auth::user()->hasPermission(['edit-portalitsa-service'])) {
            $data = Servicebe::find($id);
            return view('service.edit', compact('data'));
        } else {
            return view('error.403');
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
        if (Auth::user()->hasPermission(['edit-portalitsa-service'])) {
            $data = Servicebe::find($id);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->updated_by = Auth::user()->username;
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();

            return redirect()->route('servicebe.index')->with('success', __('new Service successfully updated'));
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
        if (Auth::user()->hasPermission(['delete-portalitsa-service'])) {
            Servicebe::destroy($id);

            return response()->json([
                'msg' => true
            ]);
        } else {
            return view('error.403');
        }
    }
}
