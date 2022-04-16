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
        $this->middleware('is_pending', ['except' => []]);
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return "settings";
        $settings = Auth::user()->settings;

        if(empty($settings)){
            Auth::user()->settings()->create();            
        }

        if($request->wantsJson()){
            return response()->json($settings);
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
        
        $requestArray = $request->all();
        $successMessage = 'Notification changed successfully';
        $passwordErrorMessage = 'Current password you entered is not match!';
        $passwordSuccessMessage = 'Password changed successfully';
        $notvalidMessage = 'Your new password does not match with the confirm password!';

        Log::debug($requestArray);
        switch($request['settingsType']){
            case 'notification':
                $setting->update($requestArray);
                if($request->wantsJson()){
                    return response()->json(['success' => $successMessage]);
                }
                Alert::toast($successMessage, 'success');
                return redirect()->back();
                break;

            case 'password':
                if(!(Hash::check($requestArray['password'], Auth::user()->password))){
                    //Log::debug("Password not mach");
                    if($request->wantsJson()){
                        return response()->json(['failed' => $passwordErrorMessage]);
                    }
                    return redirect()->back()->withErrors(['password' => $passwordErrorMessage]);
                }
                if(strcmp($requestArray['newPassword'], $requestArray['confirmPassword']) != 0){
                    if($request->wantsJson()){
                        return response()->json(['failed' => $notvalidMessage ]);
                    }
                    return redirect()->back()->withErrors(['notvalid' => $notvalidMessage]);
                }
                
                break;
        }
        Log::debug(Auth::user());
        $user = Auth::user()->update([
            "password" => bcrypt($requestArray['newPassword'])
        ]);

        if($request->wantsJson()){
            return response()->json(['success' => $passwordSuccessMessage]);
        }
        Alert::toast($passwordSuccessMessage, 'success');
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
