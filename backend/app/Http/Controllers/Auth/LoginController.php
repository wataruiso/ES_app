<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function redirectToProvider (Request $request)
    {
        $provider = $request->provider;
        return Socialite::driver($provider)->redirect();

    }

    public function handleProviderCallback (Request $request)
    {
        $provider = $request->provider;
        $sns_user = Socialite::driver($provider)->user();
        $sns_email = $sns_user->getEmail();
        $sns_name = $sns_user->getName();

        if(!is_null($sns_email)) {
            $user = User::firstOrCreate(   // Userモデルに、レコードがあれば取得、なければ保存
                [ 'email' => $sns_email ],
                [ 'email' => $sns_email, 'name' => $sns_name, 'password' => Hash::make(Str::random())
            ]);
            auth()->login($user);
            session()->flash('oauth_login', $provider.'でログインしました。');
            return redirect('/');
        }
        return '情報が取得できませんでした。';

    }
}
