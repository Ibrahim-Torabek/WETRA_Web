<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
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
    public function index()
    {
        $settings = Auth::user()->settings;

        if(empty($settings)){
            Auth::user()->settings()->create();
            Log::debug('Setting is empty, and created new settings table');
            
        }
        
        return view('setting.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        
        $request = $request->all();
        Log::debug($request);
        switch($request['settingsType']){
            case 'notification':
                $setting->update($request);
                Alert::toast('Settings saved successfully', 'success');
                return redirect()->back();
                break;

            case 'password':
                if(!(Hash::check($request['password'], Auth::user()->password))){
                    //Log::debug("Password not mach");
                    return redirect()->back()->withErrors(['password' => 'Current password you entered is not match!']);
                }
                if(strcmp($request['newPassword'], $request['confirmPassword']) != 0){
                    
                    return redirect()->back()->withErrors(['notvalid' => 'Your new password does not match with the confirm password!']);
                }
                
                break;
        }
        Log::debug(Auth::user());
        $user = Auth::user()->update([
            "password" => bcrypt($request['newPassword'])
        ]);
        Alert::toast('Password changed successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
