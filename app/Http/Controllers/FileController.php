<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Contracts\Cache\Store;
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
        $this->middleware('is_pending');
        $this->middleware('verified');
    }
    /**
     * Get All files for admin, or get public files, group files and personal shared files for regular users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $files = File::all();

        if ($request->ajax()) {
            
            if(Auth::user()->is_admin != 1){
                $files = File::where('shared_to', '0')
                    ->orWhere('shared_to', Auth::id())
                    ->orWhere('is_group', "1")
                    ->where('shared_to', Auth::user()->group->id)
                    ->get();
           
            } 
            
            if(Auth::user()->is_admin == 1){
                return DataTables::of($files)
                    ->addIndexColumn()
                    ->addColumn('action', function ($file) {

                        $btn = '<form method="post" action="';
                        $btn .= action([\App\Http\Controllers\FileController::class,'destroy'],  ['file' => $file->id]);
                        $btn .= '">';
                        $btn .= csrf_field();
                        $btn .= method_field('DELETE');
                        $btn .= '<input class="btn btn-danger" type="submit" name="submit" value="Delete" onclick="return confirm(\'Are you Sure you want to delete this file?\')">';
                        $btn .= "</form>";
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } else {
                return DataTables::of($files)
                    ->toJson();
            }
        }
        
        if($request->wantsJson()){
            return response()->json($files);
        }
        $users = User::all();
        return view('file.index', ['users' => $users]);
    }


    /**
     * Store uploaded file into storage and database table (files tabel)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $isGroup = $request->all()['is_group'] ?? null;

        //File validate file size.
        $validator = Validator::make($request->all(), [
            'file' => 'max:500000',
        ]);

        if ($request->hasFile('file')) {
            // Get file information
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('file')->getClientOriginalExtension();
            $nameToStore = $fileName . '_' . time() . '.' . $extention;

            // Storage to disk and get the file path
            $filePath = $request->file->storeAs('public/upload',$nameToStore);

            // convert file path to URL
            $fileURL = '/wetra' . Storage::url($filePath);


            $fileArray = $request->all();
            $fileArray["file_name"] = $fileName;
            $fileArray["file_extention"] = $extention;
            $fileArray["file_url"] = $fileURL;
            $fileArray["file_path"] = $filePath;
            $fileArray["uploaded_by"] = Auth::id();

            // Write to data table
            File::create($fileArray);
            if($request->wantsJson()){
                return response()->json(['success' => 'file uploaded successfully!']);
            }

            Alert::toast($fileNameWithExt . ' uploded', 'success');
            
        }

        if($request->wantsJson()){
            return 'There is no file';
        }

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, File $file)
    {
        Storage::delete($file->file_path);
        $file->delete();

        if($request->wantsJson()){
            return response()->json(['success' => 'file deleted successfully!']);
        }
        
        Alert::toast($file->file_name . ' deleted', 'success');
        return redirect()->back();
    }
}
