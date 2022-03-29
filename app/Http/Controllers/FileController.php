<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use \Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use RealRashid\SweetAlert\Facades\Alert;

class FileController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:sanctum', ['except' => []]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $files = File::all();
            if(Auth::user()->is_admin != 1){
                $files = File::where('shared_to', '0')
                    ->orWhere('shared_to', Auth::id())
                    ->get();
                Log::debug($files);                
            } 

            return DataTables::of($files)
                ->addIndexColumn()
                ->addColumn('action', function ($file) {

                    $btn = '<form method="post" action="';
                    $btn .= action([\App\Http\Controllers\FileController::class,'destroy'],  ['file' => $file->id]);
                    $btn .= '">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<input class="btn btn-danger" type="submit" name="submit" value="Delete" onclick="return confirm(\'Are you Sure you want to delete this member?\')">';
                    $btn .= "</form>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $users = User::all();
        return view('file.index', ['users' => $users]);
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
        //dd($request->all());

        //TODO: File validate file size.
        $validator = Validator::make($request->all(), [
            'file' => 'max:500000',
        ]);

        if ($request->hasFile('file')) {
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('file')->getClientOriginalExtension();
            $nameToStore = $fileName . '_' . time() . '.' . $extention;

            $filePath = $request->file->storeAs('public/upload',$nameToStore);

            //TODO: Change the sub folder. My wetra url ha wetra subfolder. it couase the mass of file url.
            $fileURL = '/wetra' . Storage::url($filePath);
            //dd($fileURL);

            $fileArray = $request->all();
            $fileArray["file_name"] = $fileName;
            $fileArray["file_extention"] = $extention;
            $fileArray["file_url"] = $fileURL;
            $fileArray["uploaded_by"] = Auth::id();

            File::create($fileArray);

            Alert::toast($fileNameWithExt . ' uploded', 'success');
            
        }




        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()->back();
    }
}
