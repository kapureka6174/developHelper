<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // コメントの追加
    public function addComment (Request $request) {
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
