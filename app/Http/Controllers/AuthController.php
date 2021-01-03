<?php

namespace App\Http\Controllers;

use App\Jobs\RegisterEmailCodeJob;
use App\Mail\RegisterCodeEmail;
use App\Models\User;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (!\auth()->check())
            return view('auth.register');
        else
            return redirect()->back();
    }

    public function sendCode(Request $request)
    {
        $code = rand(100000,999999);
        Log::info("$request->moe: $code");
        Cache::put($request->moe,$code,120);
        if (str_contains($request->moe,'@')){
//            RegisterEmailCodeJob::dispatchNow($request);
            return view('auth.enterCode',compact('request'));
        }
        return view('auth.enterCode',compact('request'));
    }

    public function register(Request $request)
    {
        $cacheCode = Cache::get($request->moe);
        if ($cacheCode = null || $cacheCode != $request->code)
            return redirect()->back();
        $informations = [
            'full_name' => $request->full_name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];
        if (str_contains($request->moe,'@'))
            $informations['email'] = $request->moe;
        else
            $informations['mobile'] = $request->moe;

        User::create($informations);

    }

    public function login()
    {

    }

    public function logout()
    {

    }
}
