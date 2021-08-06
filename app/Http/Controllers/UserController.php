<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Service;

class UserController extends Controller
{
    // 全開発者のデータを引っ張て来てViewに渡す。
    public function all () {
        return Inertia::render('Users',['users' => User::all()]);
    }

    // paramで渡されてきたuser_idと一致するサービスのデータをViewに渡す。
    public function detail ($id) {
        $services = Service::where('user_id',$id)->get();
        return Inertia::render('User',['services' => $services]);
    }
 }
