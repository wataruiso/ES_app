<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Log;

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
        $sns_user = Socialite::driver($provider)->stateless()->user();
        $sns_email = $sns_user->getEmail();
        $sns_name = $sns_user->getName();
        // $sns_avatar = $sns_user->getAvatar();
        // Log::debug($sns_avatar);

        if(!is_null($sns_email)) {
            $user = User::firstOrCreate(
                [ 'email' => $sns_email ],
                [ 'email' => $sns_email, 
                'name' => $sns_name, 
                'password' => Hash::make(Str::random()),
                // 'profile_photo_url' => $sns_avatar,
                ]
            );
            auth()->login($user);
            return redirect('/');
        }
        return '情報が取得できませんでした。';

    }
}
