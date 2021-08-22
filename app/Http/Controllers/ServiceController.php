<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\Requirement;
use App\Models\Uri;
use App\Models\TechField;
use App\Models\Tech;
use App\Models\Tag;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{

    // 全サービスのデータを引っ張て来てViewに渡す。
    public function all () {
        $services = Service::with('tags:id,tagname')->get();
        return Inertia::render('Services',['services' => $services, 'tags' => Tag::all()]);
    }

    // サービスの詳細ページを表示する時にサービスが持つ情報をViewに渡す
    public function detail ($id) {
        $service = Service::where('id', $id)->with('tags:id,tagname')->first(['id', 'user_id' ,'title', 'description']);
        $techFields = TechField::where('service_id', $id)->with('teches:id,tech_field_id,techname,version')->get(['id', 'fieldname']);
        $requirements = Requirement::where('service_id', $id)->get(['id', 'title', 'content', 'finished']);
        // whereHasで該当サービスが持っているページのみを取得
        $pages = Page::whereHas('requirements', function($query) use($id) {
            $query->where('service_id', $id);
            // withで取得カラムを指定し、該当サービスのページが持つrequirementsを取得
        })->with(['requirements' => function($query) use ($id) {
            $query->select('requirements.id', 'title', 'content', 'finished')->where('service_id',$id);
        }])->get(['pages.id','pages.pagename']);
        $uris = Uri::where('service_id', $id)->get(['id', 'uri', 'method', 'explain']);
        $tasks = Task::where('service_id', $id)->get(['id', 'taskname', 'state', 'time']);
        $comments = Comment::where('service_id', $id)->with('user:id,name')->get();
        return Inertia::render('Service',['service' => $service, 'techFields' => $techFields,'requirements' => $requirements, 'pages' => $pages, 'uris' => $uris, 'tasks' => $tasks, 'comments' => $comments]);
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
            $tag = Tag::firstOrCreate([
                'tagname' => $tagname,
            ]);
            $service->tags()->attach($tag['id']);
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

        // pagesテーブルに追加
        foreach ($data['pages'] as $page) {
            $pages = Page::create([
                'pagename' => $page['pagename']['content'],
            ]);
            foreach ($page['requirements'] as $requirement) {
                $requirementID = Requirement::where('title', $requirement)->get('id');
                $pages->requirements()->attach($requirementID);
            }
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

        return redirect()->route('Service', ['id' => $service['id']]);
    }

    public function add (Request $request) {
        $data = $request->all();
        $comment = Comment::create([
            'service_id' => $data['id'],
            'user_id' => Auth::id(),
            'type' => $data['comments']['type'],
            'content' => $data['comments']['content'],
        ]);

        return redirect()->route('Service', ['id' => $data['id']]);
    }
 }
