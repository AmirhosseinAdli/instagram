<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\RegisterEmailCodeJob;
use App\Mail\RegisterCodeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (!\auth()->check())
            return view('auth.register');
        else
            return redirect()->back();
    }

    public function sendCode(RegisterRequest $request)
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

    public function register(CodeRequest $request)
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

        $user = User::create($informations);
        Auth::login($user);
        return view('auth.home');
    }

    public function showLogin()
    {
        if (!\auth()->check())
            return view('auth.login');
        return redirect()->back();
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->meu)
            ->orWhere('mobile',$request->meu)
            ->orWhere('username',$request->meu);
        if ($user->exists()){
            if (Hash::check($request->password,$user->first()->getAuthPassword()))
            {
                Auth::login($user->first());
                return view('auth.home');
            }
        }
        return redirect()->back();
    }

    public function logout()
    {
        \auth()->logout();
        return 'logout';
    }
}
