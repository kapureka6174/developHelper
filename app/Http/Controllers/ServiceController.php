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
        return Inertia::render('Services',['services' => Service::all(), 'tags' => Tag::all()]);
    }

    // paramで渡されてきたservice_idと一致するサービスのデータをViewに渡す。
    public function detail ($id) {
        $service = Service::where('id', $id)->first();
        $requirements = Requirement::where('service_id', $id)->get();
        $uris = Uri::where('service_id', $id)->get();
        // $techFields = TechField::join('teches','tech_fields.id', '=', 'teches.tech_field_id')->where('service_id', $id)->get();
        $techFields = TechField::where('service_id', $id)->get();
        foreach ($techFields as $field) {
            $field['teches'] = Tech::where('tech_field_id', $field['id'])->get();
        }
        $tags= Tag::where('service_id', $id)->get();
        return Inertia::render('Service',['service' => $service,'requirements' => $requirements, 'uris' => $uris, 'techFields' => $techFields, 'tags' => $tags]);
    }
}
