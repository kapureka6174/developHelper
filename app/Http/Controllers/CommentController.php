<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    // コメントの追加
    public function addComment (Request $request) {
        $data = $request->all();

        // バリデーションのルールを指定
        $rules = [
            'id' => 'required|integer',
            'comments.type' => ['required','string', Rule::in(["質問","アドバイス","感想"])],
            'comments.content' => 'required|string',
            'comments.decidable' => 'required|accepted',
        ];

        // バリデーションの設定
        $validatedData = Validator::make($data, $rules)->validate();

        $comment = Comment::create([
            'service_id' => $validatedData['id'],
            'user_id' => Auth::id(),
            'type' => $validatedData['comments']['type'],
            'content' => $validatedData['comments']['content'],
        ]);

        return redirect()->back()->with('success', '保存が完了しました');
    }
}
