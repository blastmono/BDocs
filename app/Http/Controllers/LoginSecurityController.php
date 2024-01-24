<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginSecurity;
use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use enshrined\svgSanitize\Sanitizer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LoginSecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show2faForm(Request $request)
    {
        //$user = FacadesAuth::user();
        $user = Auth::user();
        $google2fa_url ="";
        $secret_key="";
        $qrCode="";

        if($user->loginSecurity()->exists())
        {
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeUrl(
                'Docs',
                $user->rut,
                $user->loginSecurity->google2fa_secret,
            );
            $secret_key = $user->loginSecurity->google2fa_secret;
        }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url'=>$google2fa_url
        );
        if(!$google2fa_url == ""){
            $qrCode = QrCode::format('svg')->generate($google2fa_url);
        }
        
        $codigoQr = str_replace('<?xml version="1.0" encoding="UTF-8"?>','',$google2fa_url);
        return view('auth.2fa_settings',compact('data','codigoQr','qrCode'));
    }

    public function generate2faSecret(Request $request)
    {
        $user = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security = LoginSecurity::firstOrNew(array('user_id' => $user->id));
        $login_security->user_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('/2fa')->with('success',"Secret key is generated.");
    }

    public function enable2fa(Request $request){
        $user = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->loginSecurity->google2fa_secret, $secret);

        if($valid){
            $user->loginSecurity->google2fa_enable = 1;
            $user->loginSecurity->save();
            return redirect('2fa')->with('success',"2FA is enabled successfully.");
        }else{
            return redirect('2fa')->with('error',"Invalid verification Code, Please try again.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->loginSecurity->google2fa_enable = 0;
        $user->loginSecurity->save();
        return redirect('/2fa')->with('success',"2FA is now disabled.");
    }
}
