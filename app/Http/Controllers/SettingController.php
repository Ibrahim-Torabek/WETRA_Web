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
        $passwordErrorMessage = 'Current password you entered does NOT match!';
        $passwordSuccessMessage = 'Password changed successfully';
        $notvalidMessage = 'Your new password does not match with the confirm password!';

        
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
        
        $user = Auth::user()->update([
            "password" => bcrypt($requestArray['newPassword'])
        ]);

        if($request->wantsJson()){
            return response()->json(['success' => $passwordSuccessMessage]);
        }
        Alert::toast($passwordSuccessMessage, 'success');
        return redirect()->back();
    }


}
