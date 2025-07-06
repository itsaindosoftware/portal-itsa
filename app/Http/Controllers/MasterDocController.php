<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\FileBag;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Mail;
// use Storage;
use App\Masterdocs;
class MasterDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasPermission('manage-masterdocs')) {
          if ($request->ajax()) {
              $data = Masterdocs::query();
              return DataTables::of($data)
               ->addColumn('action', function($data){
                   return view('datatables._action-masterdocs', [
                       'model'=> $data,
                       'edit_url'=> route('masterdocs.edit', $data->id),
                       'show_url'=> route('masterdocs.show', $data->id),
                       'delete_url'=> route('masterdocs.destroy', $data->id),
                   ]);
               })
                ->editColumn('file', function($row) {
                    return view('datatables._show-file',[
                        'data'=> $row
                    ]);
                })
                ->editColumn('description', function($row) {
                    return strlen($row->description) > 50 ?
                            substr($row->description, 0, 50) . '...' :
                            $row->description;
                })
                ->editColumn('type_doc', function($row) {
                        $badgeClass = '';
                        switch(strtolower($row->type_doc)) {
                            case 'procedure':
                                $badgeClass = 'badge-success';
                                break;
                            case 'workinstruction':
                                $badgeClass = 'badge-primary';
                                break;
                            default:
                                $badgeClass = 'badge-secondary';
                        }
                        return '<span class="badge '.$badgeClass.'">'.$row->type_doc.'</span>';
                    })
               ->editColumn('created_at', function($data){
                   return \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
               })
               ->rawColumns(['action', 'file', 'type_doc'])
               ->make(true);


            }
            return view('request-dar.masterdocs.index');
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
        // dd($request->all());
        $user=Auth::user();
        if ($user->hasPermission('create-masterdocs')) {
            $data = new Masterdocs;
            $data->title = $request->get('title');
            $data->description = $request->get('description');
            $data->type_doc = $request->get('type_docs');
            $filePath = '-';
            if ($request->hasFile('file_doc')) {
                $originalFileName = $request->file('file_doc')->getClientOriginalName();
                $fileName = time() . '_' . $originalFileName;

                $uploadPath = 'reqdar/master-documents/' . date('Y-m');

                $filePath = $request->file('file_doc')->storeAs(
                    'public/' . $uploadPath,
                    $fileName
                );
            }
            $data->file = $filePath;
            $data->save();

            return response()->json([
                'success'=> true,
                'message'=> 'Data documents succesfully added'
            ], 200);
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
        $user=Auth::user();
        $id = base64_decode($id);
        if ($user->hasPermission('manage-masterdocs','show-masterdocs')) {
            $data = Masterdocs::find($id);
            return response()->json($data);
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
        $user=Auth::user();
        $id = base64_decode($id);
        if ($user->hasPermission('manage-masterdocs','edit-masterdocs')) {
            $data = Masterdocs::find($id);
            return response()->json($data);
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
        // dd($request->all());
        $user=Auth::user();
        if ($user->hasPermission('manage-masterdocs','edit-masterdocs')) {
              $data = Masterdocs::find($id);
              if (!$data) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data MasterDocs Not found'
                    ], 404);
                }
                $data->title = empty($request->title) ? $data->title : $request->title;
                $data->description = empty($request->description) ? $data->description : $request->description;
                $data->type_doc = empty($request->type_docs) ? $data->type_doc : $request->type_docs;
                if ($request->hasFile('file_doc')) {
                    $oldFilePath = $data->file;

                    $originalFileName = $request->file('file_doc')->getClientOriginalName();
                    $fileName = time() . '_' . $originalFileName;

                    $uploadPath = 'reqdar/master-documents/' . date('Y-m');

                    $filePath = $request->file('file_doc')->storeAs(
                        'public/' . $uploadPath,
                        $fileName
                    );
                    $data->file = $filePath;

                    // Delete old file if it exists
                    if (!empty($oldFilePath) && Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }


                $data->save();

                  return response()->json([
                    'status' => true
                ], 200);

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
        $user=Auth::user();
        if ($user->hasPermission('manage-masterdocs','destroy-masterdocs')) {
            $data=Masterdocs::find($id);
            $data->delete();


            return response()->json([
                'success'=>true
            ]);
        }
    }
    public function viewDocument($id)
    {
        $requestMasterdocs = Masterdocs::findOrFail($id);

        if (!$requestMasterdocs->file) {
            abort(404, 'File not found');
        }

        // Cek apakah file dimulai dengan 'public/'
        $filePath = $requestMasterdocs->file;
        // dd($filePath);
        if (strpos($filePath, 'public/') === 0) {
            $filePath = substr($filePath, 7); // Hapus 'public/' dari awal path
        }

        // Cek file di storage
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            $altPath = public_path($filePath);
            if (!file_exists($altPath)) {
                abort(404, 'File not found on disk');
            }
            $fullPath = $altPath;
        }

        return response()->file($fullPath);
    }
    public function downloadDocument($id)
    {
        $requestDocs = Masterdocs::findOrFail($id);

        if (!$requestDocs->file) {
            abort(404, 'File not found');
        }

        // Cek apakah file dimulai dengan 'public/'
        $filePath = $requestDocs->file;
        if (strpos($filePath, 'public/') === 0) {
            $filePath = substr($filePath, 7);
        }

        // Cek file di storage
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            $altPath = public_path($filePath);
            if (!file_exists($altPath)) {
                abort(404, 'File not found on disk');
            }
            $fullPath = $altPath;
        }

        // Ekstrak nama file asli dari path file
        $originalFileName = basename($filePath);

        // Jika nama file tidak tersedia, gunakan judul dokumen atau nama default
        if (empty($originalFileName) || $originalFileName == $id) {
            $originalFileName = !empty($requestDocs->title) ?
                Str::slug($requestDocs->title, '-') . '.pdf' :
                'document-' . $requestDocs->id . '.pdf';
        }

        return response()->download($fullPath, $originalFileName);
    }
}
