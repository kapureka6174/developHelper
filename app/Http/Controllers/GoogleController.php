<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Exception;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();;
            dd($user);
            $searchUser = User::where('social_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect('/');

            }else{
                $googleUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'auth_type'=> 'google',
                ]);

                Auth::login($googleUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
