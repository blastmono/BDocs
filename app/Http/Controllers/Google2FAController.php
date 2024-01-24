<?php

namespace App\Http\Controllers;

use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Crypt;
use ParagonIE\ConstantTime\Base32;
use Illuminate\Support\Facades\Auth;

class Google2FAController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('web');
    }

    public function enableTwoFactor(Request $request)
    {
        $secret = $this->generateSecret();

        $user = $request->user();

        $user->google2fa_secret = Crypt::encrypt($secret);
        $user->save();

        $imageDataUri = Google2FA::getQRCodeInline(
            $request->getHttpHost(),
            $user->email,
            $secret,
            200
        );

        return view('2fa/enableTwoFactor',['image'=> $imageDataUri,'secret'=>$secret]);

    }

    public function disableTwoFactor(Request $request)
    {
        $user = $request->user();

        //make secret column blank
        $user->google2fa_secret = null;
        $user->save();

        return view('2fa/disableTwoFactor');
    }

    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }
}
