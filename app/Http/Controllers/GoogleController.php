<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Exception;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        $redirectUrl = Socialite::driver('google')->redirect()->getTargetUrl();
        return Inertia::location($redirectUrl);
    }


    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();;
            $searchUser = User::where('email', $user->email)->first();
            if($searchUser){
                if ($searchUser->github_id == null) {
                    User::where('email', $user->email)->update([
                        'google_id' => $user->id,
                    ]);
                }

                Auth::login($searchUser);

                return redirect('/');

            } else {
                $googleUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                ]);

                Auth::login($googleUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
