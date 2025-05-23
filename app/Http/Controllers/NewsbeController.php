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
use App\Newsbe;

class NewsbeController extends Controller
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
        if (Auth::user()->hasPermission('manage-portalitsa-news')) {
            if ($request->ajax()) {
                $data = Newsbe::query()->leftJoin('users', 'news.users_id', '=', 'users.id')
                    ->leftJoin('roles', 'news.role_id', '=', 'roles.id')
                    ->leftJoin('departments', 'news.dept_id', '=', 'departments.id')
                    ->select(
                        'news.id as id',
                        'users.name as name_user',
                        'roles.name as role_name',
                        'departments.description as dept_name',
                        'news.title',
                        'news.description',
                        'news.created_by',
                        'news.created_at'
                    );

                return DataTables::of($data)
                    ->addColumn('action', function ($news) {
                        return view('datatables._action-news', [
                            'model' => $news,
                            'edit_url' => route('newsbe.edit', $news->id),
                            'delete_url' => route('newsbe.destroy', $news->id),
                            'show_url' => route('newsbe.show', $news->id)
                        ]);
                    })
                    ->editColumn('title', function ($title) {
                        return '<span class="badge badge-secondary">' . $title->title . '</span>';
                    })
                    ->rawColumns(['action', 'title'])
                    ->make(true);
            }
            return view('news.index');
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
        if (Auth::user()->hasPermission('create-portalitsa-news')) {
            return view('news.create');
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
        if (Auth::user()->hasPermission('create-portalitsa-news')) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',// 5MB max
            ]);
            $originalFileName = $request->file('picture')->getClientOriginalName();
            $fileName = $originalFileName;

            // dd($fileName);

            // Define upload path within the storage directory
            $uploadPath = 'news';


            // Store file in storage/app/public directory with the defined path
            // dd($request->file('picture'));
            $filePath = $request->file('picture')->storeAs(
                'public/' . $uploadPath,
                $fileName
            );
            // get role
            $user = DB::connection('portal-itsa')->table('role_user')
                ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                ->select(
                    DB::raw('users.name as "name"'),
                    DB::raw('roles.display_name as "role_name"'),
                    'roles.id as role_id'
                )
                ->where('users.id', Auth::user()->id)
                ->first();

            $newsBe = new Newsbe();
            $newsBe->users_id = Auth::user()->id;
            $newsBe->dept_id = Auth::user()->department_id;
            $newsBe->role_id = $user->role_id;
            $newsBe->title = $request->title;
            $newsBe->description = $request->description;
            $newsBe->pic = $fileName;
            $newsBe->created_by = Auth::user()->name;
            $newsBe->created_at = date('Y-m-d H:i:s');
            $newsBe->save();

            return redirect()->route('newsbe.index')->with('success', __('new News successfully created'));

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
        if (Auth::user()->hasPermission('show-portalitsa-news')) {
            $data = DB::connection('portal-itsa')->table('news')->leftJoin('users', 'news.users_id', '=', 'users.id')
                ->leftJoin('roles', 'news.role_id', '=', 'roles.id')
                ->leftJoin('departments', 'news.dept_id', '=', 'departments.id')
                ->select(
                    'news.id',
                    'users.name as name_user',
                    'roles.name as role_name',
                    'departments.description as dept_name',
                    'news.title',
                    'news.description',
                    'news.pic',
                    'news.created_by',
                    'news.created_at'
                )->where('news.id', $id)->first();

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
        if (Auth::user()->hasPermission(['edit-portalitsa-news'])) {
            $data = Newsbe::find($id);
            return view('news.edit', compact('data'));
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
        if (!Auth::user()->hasPermission('edit-portalitsa-news')) {
            return view('error.403');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);

        $newsBe = Newsbe::findOrFail($id);

        $newsBe->title = $request->title;
        $newsBe->description = $request->description;

        if ($request->hasFile('picture')) {
            // Hapus file lama jika ada
            if ($newsBe->pic && Storage::exists('public/news/' . $newsBe->pic)) {
                Storage::delete('public/news/' . $newsBe->pic);
            }

            // Upload file baru
            $fileName = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('public/news', $fileName);
            $newsBe->pic = $fileName;
        }
        $newsBe->updated_by = Auth::user()->name;
        $newsBe->updated_at = date('Y-m-d H:i:s');
        $newsBe->save();

        return redirect()->route('newsbe.index')->with('success', __('News successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermission(['delete-portalitsa-news'])) {
            Newsbe::destroy($id);

            return response()->json([
                'msg' => true
            ]);
        } else {
            return view('error.403');
        }
    }
}
