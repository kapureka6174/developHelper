<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function login () {
        // ゲストユーザー用のユーザーIDを定数として定義
        $GUEST_USER_ID = 13;

        // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
        if (Auth::loginUsingId($GUEST_USER_ID)) {
            return redirect('/');
        }

        return redirect('/');
    }
}
