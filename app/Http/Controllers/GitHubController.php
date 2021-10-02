<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Exception;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class GitHubController extends Controller
{
    public function gitRedirect()
    {
        $redirectUrl = Socialite::driver('github')->redirect()->getTargetUrl();
        return Inertia::location($redirectUrl);
    }


    public function gitCallback()
    {
        try {

            $user = Socialite::driver('github')->user();
            $searchUser = User::where('email', $user->email)->first();

            if($searchUser){
                if ($searchUser->github_id == null) {
                    User::where('email', $user->email)->update([
                        'github_id' => $user->id,
                    ]);
                }

                Auth::login($searchUser);

                return redirect('/');

            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                ]);

                Auth::login($gitUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
