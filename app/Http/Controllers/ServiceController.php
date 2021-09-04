<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $pages = Page::where('service_id', $id)->with('requirements:id,title,content,finished')->get(['id', 'pagename']);
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

    // 編集画面の表示
    public function edit($id) {
        $service = Service::where('id', $id)->with('tags:id,tagname')->first(['id', 'user_id' ,'title', 'description']);
        if (Auth::id() !== $service['user_id']) {
            return Inertia::render('Edit', ['errorMessage' => '編集権限がありません。正しいアカウントでログインしてください。']);
        }
        $techFields = TechField::where('service_id', $id)->with('teches:id,tech_field_id,techname,version')->get(['id', 'fieldname']);
        $requirements = Requirement::where('service_id', $id)->get(['id', 'title', 'content', 'finished']);
        $pages = Page::where('service_id', $id)->with('requirements:id,title,content,finished')->get(['id', 'pagename']);
        $uris = Uri::where('service_id', $id)->get(['id', 'uri', 'method', 'explain']);
        return Inertia::render('Edit',['service' => $service, 'techFields' => $techFields,'requirements' => $requirements, 'pages' => $pages, 'uris' => $uris]);
    }

    public function update(Request $request) {
        $data = $request->all();
        // バリデーションのルールを指定
        $rules = [
            'id' => 'required|integer',
            'title.content' => 'required|string',
            'title.decidable' => 'required|accepted',
            'description.content' => 'required|string',
            'description.decidable' => 'required|accepted',
            'tags.content.*' => 'required|string',
            'techFields.*.techField.id' => 'nullable|integer',
            'techFields.*.techField.content' => 'required|string',
            'techFields.*.techField.decidable' => 'required|accepted',
            'techFields.*.teches.*.id' => 'nullable|integer',
            'techFields.*.teches.*.tech.content' => 'required|string',
            'techFields.*.teches.*.tech.decidable' => 'required|accepted',
            'techFields.*.teches.*.version.content' => 'nullable|string',
            'techFields.*.teches.*.version.decidable' => 'required|boolean',
            'requirements.*.id' => 'nullable|integer',
            'requirements.*.requireTitle.content' => 'required|string',
            'requirements.*.requireTitle.decidable' => 'required|accepted',
            'requirements.*.requireExplain.content' => 'nullable|string',
            'requirements.*.requireExplain.decidable' => 'required|boolean',
            'uris.*.id' => 'nullable|integer',
            'uris.*.uri.content' => 'required|string',
            'uris.*.uri.decidable' => 'required|accepted',
            'uris.*.method.content' => 'required|string',
            'uris.*.method.decidable' => 'required|accepted',
            'uris.*.explain.content' => 'required|string',
            'uris.*.explain.decidable' => 'required|accepted',
            'pages.*.id' => 'nullable|integer',
            'pages.*.pagename.content' => 'required|string',
            'pages.*.pagename.decidable' => 'required|accepted',
            'pages.*.requirements' => 'array',
            'pages.*.requirements.*.id' => 'nullable|integer',
            'pages.*.requirements.*.content' => 'nullable|string',
        ];

        // バリデーションの設定と実行
        $validation = Validator::make($data, $rules);
        // バリデーションの実行
        $validation->validate();

        $validatedData = $validation->validated();

        // Serviceテーブルの変更
        Service::where('id', $validatedData['id'])->update([
            'title' => $validatedData['title']['content'],
            'description' => $validatedData['description']['content'],
        ]);
        // Tagテーブルの変更（存在するなら）
        if (in_array('tags',$validatedData)) {
            $newTags = $validatedData['tags']['content'];
            $oldTags = Service::find($validatedData['id'])->tags()->get();
            $service = Service::find($validatedData['id']);
            foreach ($oldTags as $tag) {
                // 新しいタグに含まれている場合はそのまま
                if (in_array($tag['tagname'],$newTags)) {
                    $index = array_search($tag['tagname'], $newTags);
                    array_splice($newTags, $index, 1);
                } else {
                    //　含まれていないタグは削除（リレーションのみ）
                    $service->tags()->detach($tag['id']);
                }
            }

            // 新しいタグを追加
            foreach ($newTags as $tagname) {
                $tag = Tag::firstOrCreate([
                    'tagname' => $tagname,
                ]);
                $service->tags()->attach($tag['id']);
            }

            //　どのサービスにも結びついていないタグを削除する
            $tags = Tag::with('services:id')->get();
            foreach ($tags as $tag) {
                if (count($tag['services']) == 0) {
                    Tag::where('id', $tag['id'])->delete();
                }
            }
        }

        // TechFieldテーブルの変更
        $newTechFields = $validatedData['techFields'];
        foreach ($newTechFields as $fieldAndTeches) {
            // idがあるなら更新（techField）
            if (count($fieldAndTeches['techField']) == 3) {
                $techField = TechField::where('id', $fieldAndTeches['techField']['id'])->update([
                    'fieldname' => $fieldAndTeches['techField']['content'],
                ]);

                foreach ($fieldAndTeches['teches'] as $techContent) {
                    // idがあるなら更新（teches）
                    if (count($techContent) == 3) {
                        Tech::where('id', $techContent['id'])->update([
                            'techname' => $techContent['tech']['content'],
                            'version' => $techContent['version']['content'],
                        ]);

                    } else {
                        Tech::create([
                            'tech_field_id' => $fieldAndTeches['techField']['id'],
                            'techname' => $techContent['tech']['content'],
                            'version' => $techContent['version']['content'],
                        ]);
                    }
                }
            } else {
                // 新規追加
                $techField = TechField::create([
                    'service_id' => $validatedData['id'],
                    'fieldname' => $fieldAndTeches['techField']['content'],
                ]);

                // techテーブルに新規追加
                foreach ($fieldAndTeches['teches'] as $techContent) {
                    $teches = Tech::create([
                        'tech_field_id' => $techField['id'],
                        'techname' => $techContent['tech']['content'],
                        'version' => $techContent['version']['content'],
                    ]);
                }
            }
        }
        // TechFieldの削除
        foreach ($data['deleteData']['techFields'] as $id) {
            TechField::where('id', $id)->delete();
        }
        // Techesの削除
        foreach ($data['deleteData']['teches'] as $id) {
            Tech::where('id', $id)->delete();
        }

        // requirementテーブルの変更
        foreach ($validatedData['requirements'] as $require) {
            if (count($require) == 3) {
                Requirement::where('id', $require['id'])->update([
                    'title' => $require['requireTitle']['content'],
                    'content' => $require['requireExplain']['content'],
                ]);
            } else {
                Requirement::create([
                    'service_id' => $validatedData['id'],
                    'title' => $require['requireTitle']['content'],
                    'content' => $require['requireExplain']['content'],
                    'finished' => false,
                ]);
            }
        }

        // requirementsテーブルの削除
        foreach ($data['deleteData']['requirements'] as $id) {
            Requirement::where('id', $id)->delete();
        }

        // pagesテーブルの変更
        foreach ($validatedData['pages'] as $page) {
            // idがあるなら変更
            if (count($page) == 3) {
                Page::where('id', $page['id'])->update([
                    'pagename' => $page['pagename']['content'],
                ]);

                $newPage = Page::find($page['id']);
                foreach ($page['requirements'] as $requirement) {
                    if (count($requirement) == 2) {
                        $newPage->requirements()->syncWithoutDetaching($requirement['id']);
                    } else {
                        $requirementID = Requirement::where('service_id', $validatedData['id'])->where('title', $requirement)->get('id');
                        $newPage->requirements()->syncWithoutDetaching($requirementID);
                    }
                }
            } else {
                $newPage = Page::create([
                    'service_id' => $validatedData['id'],
                    'pagename' => $page['pagename']['content'],
                ]);

                foreach ($page['requirements'] as $requirement) {
                    if (count($requirement) == 2) {
                        $newPage->requirements()->syncWithoutDetaching($requirement['id']);
                    } else {
                        $requirementID = Requirement::where('service_id', $validatedData['id'])->where('title', $requirement)->get('id');
                        $newPage->requirements()->syncWithoutDetaching($requirementID);
                    }
                }
            }
        }

        foreach ($data['deleteData']['pages'] as $id) {
            Page::where('id', $id)->delete();
        }

        foreach ($data['deleteData']['pageRequirements'] as $content) {
            $page = Page::find($content['page_id']);
            $page->requirements()->detach($content['id']);
        }

        // uriテーブルに追加
        foreach ($validatedData['uris'] as $uriDesign) {
            if (count($uriDesign) == 4) {
                Uri::where('id', $uriDesign['id'])->update([
                    'uri' => $uriDesign['uri']['content'],
                    'method' => $uriDesign['method']['content'],
                    'explain' => $uriDesign['explain']['content'],
                ]);
            } else {
                $uri = Uri::create([
                    'service_id' => $validatedData['id'],
                    'uri' => $uriDesign['uri']['content'],
                    'method' => $uriDesign['method']['content'],
                    'explain' => $uriDesign['explain']['content'],
                ]);
            }
        }

        foreach ($data['deleteData']['uris'] as $id) {
            Uri::where('id', $id)->delete();
        }

        return redirect()->route('Service', ['id' => $validatedData['id']]);
    }
 }
