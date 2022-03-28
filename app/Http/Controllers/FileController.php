<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use \Yajra\DataTables\DataTables;
use \Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $files = File::all();

            return DataTables::of($files)
                ->addIndexColumn()
                ->addColumn('action', function ($file) {

                    $btn = '<form method="post" action="';
                    $btn .= action([\App\Http\Controllers\FileController::class,'destroy'],  ['file' => $file->id]);
                    $btn .= '">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<input class="btn btn-danger" type="submit" name="submit" value="Delete">';
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
