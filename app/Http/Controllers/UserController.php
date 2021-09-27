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
        $users = User::with(['services' => function($query){
            $query->withCount('likes');
            $query->withCount('comments');
        }])->get();
        foreach ($users as $user) {
            $user['likes_count'] = 0;
            $user['comments_count'] = 0;
            foreach ($user->services as $service) {
                $user["likes_count"] += $service['likes_count'];
                $user["comments_count"] += $service['comments_count'];
            }
        }
        return Inertia::render('Users',['users' => $users]);
    }

    // paramで渡されてきたuser_idと一致するサービスのデータをViewに渡す。
    public function detail ($id) {
        $services = Service::where('user_id',$id)->with('user:id,name')->withCount('likes')->withCount('comments')->get();
        $user = User::where('id', $id)->with(['services' => function($query){
            $query->withCount('likes');
            $query->withCount('comments');
        }])->first();
        $user['likes_count'] = 0;
        $user['comments_count'] = 0;
        foreach ($user->services as $service) {
            $user["likes_count"] += $service['likes_count'];
            $user["comments_count"] += $service['comments_count'];
        }
        $likes = $user->likes;
        $fav_serviceIDs = [];
        foreach ($likes as $like) {
            array_push($fav_serviceIDs,$like['service_id']);
        }
        $fav_services = Service::with('user:id,name')->withCount('comments')->withCount('likes')->find($fav_serviceIDs);
        return Inertia::render('User',['services' => $services, 'developer' => $user, 'fav_services' => $fav_services]);
    }
 }
