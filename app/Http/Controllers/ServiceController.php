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
        $services = Service::with('tags:id,tagname')->with('user:id,name')->withCount('comments')->withCount('likes')->get();
        return Inertia::render('Services',['services' => $services, 'tags' => Tag::all()]);
    }

    // サービスの詳細ページを表示する時にサービスが持つ情報をViewに渡す
    public function detail ($id) {
        $service = Service::where('id', $id)->with('tags:id,tagname')->withCount('likes')->first(['id', 'user_id' ,'title', 'description','github_url', 'site_url', 'finished']);
        $techFields = TechField::where('service_id', $id)->with('teches:id,tech_field_id,techname,version')->get(['id', 'fieldname']);
        $requirements = Requirement::where('service_id', $id)->get(['id', 'title', 'content']);
        $pages = Page::where('service_id', $id)->with('requirements:id,title,content')->get(['id', 'pagename']);
        $uris = Uri::where('service_id', $id)->get(['id', 'uri', 'method', 'explain']);
        $tasks = Task::where('service_id', $id)->get(['id', 'taskname', 'state']);
        $comments = Comment::where('service_id', $id)->with('user:id,name')->get();
        return Inertia::render('Service',['service' => $service, 'techFields' => $techFields,'requirements' => $requirements, 'pages' => $pages, 'uris' => $uris, 'tasks' => $tasks, 'comments' => $comments]);
    }

    public function new () {
        return Inertia::render('Create');
    }

    public function create (Request $request) {
        $data = $request->all();
        // バリデーションのルールを指定
        $rules = [
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
            'requirements.*.title.content' => 'required|string',
            'requirements.*.title.decidable' => 'required|accepted',
            'requirements.*.explain.content' => 'nullable|string',
            'requirements.*.explain.decidable' => 'required|boolean',
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
            'github_url.content' => 'nullable|string',
            'github_url.decidable' => 'required|boolean',
            'site_url.content' => 'nullable|string',
            'site_url.decidable' => 'required|boolean',
            'finished.state' => 'required|boolean',
        ];

        // バリデーションの設定と実行
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->with('fail', 'エラーが発生しました。');
        }

        $validatedData = $validation->validated();
        // Serviceテーブルに追加
        $service = Service::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title']['content'],
            'description' => $validatedData['description']['content'],
            'github_url' => $validatedData['github_url']['content'],
            'site_url' => $validatedData['site_url']['content'],
            'finished' => $validatedData['finished']['state'],
        ]);

        // Tagテーブルに追加
        if (in_array('tags',$validatedData)) {
            foreach ($validatedData['tags']['content'] as $tagname) {
                $tag = Tag::firstOrCreate([
                    'tagname' => $tagname,
                ]);
                $service->tags()->attach($tag['id']);
            }
        }

        // techFieldに追加
        if (in_array('techFields',$validatedData)) {
            foreach ($validatedData['techFields'] as $field) {
                $techField = TechField::create([
                    'service_id' => $service['id'],
                    'fieldname' => $field['techField']['content'],
                ]);

                // techテーブルに追加
                if (in_array('teches',$field)) {
                    foreach ($field['teches'] as $techContent) {
                        $teches = Tech::create([
                            'tech_field_id' => $techField['id'],
                            'techname' => $techContent['tech']['content'],
                            'version' => $techContent['version']['content'],
                        ]);
                    }
                }
            }
        }


        // requirementテーブルに追加
        if (in_array("requirements", $validatedData)) {
            foreach ($validatedData['requirements'] as $require) {
                $requirement = Requirement::create([
                    'service_id' => $service['id'],
                    'title' => $require['title']['content'],
                    'content' => $require['explain']['content'],
                ]);
            }
        }

        // pagesテーブルに追加
        if (in_array("pages", $validatedData)) {
            foreach ($validatedData['pages'] as $page) {
                $pages = Page::create([
                    'service_id' => $service['id'],
                    'pagename' => $page['pagename']['content'],
                ]);
                if (in_array("requirements", $page)) {
                    foreach ($page['requirements'] as $requirement) {
                        $requirementID = Requirement::where('title', $requirement)->get('id');
                        $pages->requirements()->attach($requirementID);
                    }
                }
            }
        }

        // uriテーブルに追加
        if (in_array("uris", $validatedData)) {
            foreach ($validatedData['uris'] as $uriDesign) {
                $uri = Uri::create([
                    'service_id' => $service['id'],
                    'uri' => $uriDesign['uri']['content'],
                    'method' => $uriDesign['method']['content'],
                    'explain' => $uriDesign['explain']['content'],
                ]);
            }
        }

        return redirect()->route('Service', ['id' => $service['id']])->with('success', "保存が完了しました");
    }

    // 編集画面の表示
    public function edit($id) {
        $service = Service::where('id', $id)->with('tags:id,tagname')->first(['id', 'user_id' ,'title', 'description','github_url', 'site_url', 'finished']);
        if (Auth::id() !== $service['user_id']) {
            return Inertia::render('PermissionError', ['errorMessage' => '編集権限がありません。正しいアカウントでログインしてください。']);
        }
        $techFields = TechField::where('service_id', $id)->with('teches:id,tech_field_id,techname,version')->get(['id', 'fieldname']);
        $requirements = Requirement::where('service_id', $id)->get(['id', 'title', 'content']);
        $pages = Page::where('service_id', $id)->with('requirements:id,title,content')->get(['id', 'pagename']);
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
            'requirements.*.title.content' => 'required|string',
            'requirements.*.title.decidable' => 'required|accepted',
            'requirements.*.explain.content' => 'nullable|string',
            'requirements.*.explain.decidable' => 'required|boolean',
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
            'github_url.content' => 'nullable|string',
            'github_url.decidable' => 'required|boolean',
            'site_url.content' => 'nullable|string',
            'site_url.decidable' => 'required|boolean',
            'finished.state' => 'required|boolean',
        ];

        // バリデーションの設定と実行
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->with('fail', 'エラーが発生しました。');
        }

        $validatedData = $validation->validated();

        // Serviceテーブルの変更
        Service::where('id', $validatedData['id'])->update([
            'title' => $validatedData['title']['content'],
            'description' => $validatedData['description']['content'],
            'github_url' => $validatedData['github_url']['content'],
            'site_url' => $validatedData['site_url']['content'],
            'finished' => $validatedData['finished']['state'],
        ]);
        // Tagテーブルの変更（存在するなら）
        if (array_key_exists("tags",$validatedData)) {
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

        } else {
            $service = Service::find($validatedData['id']);
            $oldTags = Service::find($validatedData['id'])->tags()->get();
            foreach ($oldTags as $tag) {
                $service->tags()->detach($tag['id']);
            }
        }

        //　どのサービスにも結びついていないタグを削除する
        $tags = Tag::with('services:id')->get();
        foreach ($tags as $tag) {
            if (count($tag['services']) == 0) {
                Tag::where('id', $tag['id'])->delete();
            }
        }

        // TechFieldテーブルの変更
        if (array_key_exists("techFields",$validatedData)) {
            $newTechFields = $validatedData['techFields'];
            foreach ($newTechFields as $fieldAndTeches) {
                // idがあるなら更新（techField）
                if (count($fieldAndTeches['techField']) == 3) {
                    $techField = TechField::where('id', $fieldAndTeches['techField']['id'])->update([
                        'fieldname' => $fieldAndTeches['techField']['content'],
                    ]);

                    if (array_key_exists("teches",$fieldAndTeches)) {
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
                    }
                } else {
                    // 新規追加
                    $techField = TechField::create([
                        'service_id' => $validatedData['id'],
                        'fieldname' => $fieldAndTeches['techField']['content'],
                    ]);

                    // techテーブルに新規追加
                    if (array_key_exists("teches",$fieldAndTeches)) {
                        foreach ($fieldAndTeches['teches'] as $techContent) {
                            $teches = Tech::create([
                                'tech_field_id' => $techField['id'],
                                'techname' => $techContent['tech']['content'],
                                'version' => $techContent['version']['content'],
                            ]);
                        }
                    }
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
        if (array_key_exists("requirements",$validatedData)) {
            foreach ($validatedData['requirements'] as $require) {
                if (count($require) == 3) {
                    Requirement::where('id', $require['id'])->update([
                        'title' => $require['title']['content'],
                        'content' => $require['explain']['content'],
                    ]);
                } else {
                    Requirement::create([
                        'service_id' => $validatedData['id'],
                        'title' => $require['title']['content'],
                        'content' => $require['explain']['content'],
                    ]);
                }
            }
        }

        // requirementsテーブルの削除
        foreach ($data['deleteData']['requirements'] as $id) {
            Requirement::where('id', $id)->delete();
        }

        // pagesテーブルの変更
        if (array_key_exists("pages", $validatedData)) {
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
        }

        foreach ($data['deleteData']['pages'] as $id) {
            Page::where('id', $id)->delete();
        }

        foreach ($data['deleteData']['pageRequirements'] as $content) {
            $page = Page::find($content['page_id']);
            $page->requirements()->detach($content['id']);
        }

        // uriテーブルに追加
        if (array_key_exists("uris", $validatedData)) {
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
        }


        foreach ($data['deleteData']['uris'] as $id) {
            Uri::where('id', $id)->delete();
        }

        return redirect()->route('Service', ['id' => $validatedData['id']])->with('success', '保存が完了しました');
    }

    public function delete($id) {
        Service::where('id', $id)->delete();
        return redirect()->route('Services')->with('success', '削除が完了しました');
    }
 }
