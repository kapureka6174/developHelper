<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{

    // 全サービスのデータを引っ張て来てViewに渡す。
    public function all () {
        return Inertia::render('Services',['services' => Service::all()]);
    }

    // paramで渡されてきたservice_idと一致するサービスのデータをViewに渡す。
    public function detail ($id) {
        return Inertia::render('Service');
    }
}
