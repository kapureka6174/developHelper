<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Requirement;
use App\Models\Uri;
use App\Models\TechField;
use App\Models\Tech;
use App\Models\Tag;
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
        $requirements = Requirement::where('service_id', $id)->get();
        $uris = Uri::where('service_id', $id)->get();
        $techFields = \DB::table('tech_fields')->where('service_id', $id)->leftJoin('teches','teches.tech_field_id', 'tech_fields.id')->get();
        $tags= Tag::where('service_id', $id)->get();
        return Inertia::render('Service',['requirement' => $requirements, 'uris' => $uris, 'TechFields' => $techFields, 'Tags' => $tags]);
    }
}
