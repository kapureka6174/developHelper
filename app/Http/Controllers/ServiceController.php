<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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

    // サービスの詳細ページを表示する時にサービスが持つ情報をViewに渡す
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

    public function new () {
        return Inertia::render('Create');
    }

    public function create (Request $request) {
        $data = $request->all();

        // Serviceテーブルに追加
        $service = Service::create([
            'user_id' => Auth::id(),
            'title' => $data['title']['content'],
            'description' => $data['description']['content'],
        ]);

        // Tagテーブルに追加
        foreach ($data['tags']['content'] as $tagname) {
            $tag = Tag::create([
                'service_id' => $service['id'],
                'tagname' => $tagname,
            ]);
        }

        // techFieldに追加
        foreach ($data['techFields'] as $field) {
            $techField = TechField::create([
                'service_id' => $service['id'],
                'fieldname' => $field['techField']['content'],
            ]);

            // techテーブルに追加
            foreach ($field['teches'] as $techContent) {
                $teches = Tech::create([
                    'tech_field_id' => $techField['id'],
                    'techname' => $techContent['tech']['content'],
                    'version' => $techContent['version']['content'],
                ]);
            }
        }

        // requirementテーブルに追加
        foreach ($data['requirements'] as $require) {
            $requirement = Requirement::create([
                'service_id' => $service['id'],
                'title' => $require['requireTitle']['content'],
                'content' => $require['requireExplain']['content'],
                'finished' => false,
            ]);
        }

        // uriテーブルに追加
        foreach ($data['uris'] as $uriDesign) {
            $uri = Uri::create([
                'service_id' => $service['id'],
                'uri' => $uriDesign['uri']['content'],
                'method' => $uriDesign['method']['content'],
                'explain' => $uriDesign['explain']['content'],
            ]);
        }

        return redirect()->route('Services');
    }
}
