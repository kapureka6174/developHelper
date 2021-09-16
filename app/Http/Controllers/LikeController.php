<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($id) {
        Like::create(['service_id'=>$id,'user_id'=>Auth::id()]);
        return redirect()->back();
    }

    public function unlike($id) {
        Like::where('service_id',$id)->where('user_id',Auth::id())->delete();
        return redirect()->back();
    }
}
