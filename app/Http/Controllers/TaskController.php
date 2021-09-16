<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    // タスクの追加
    public function addTask (Request $request) {
        $data = $request->all();

        // 追加するタスク（isDeleteがfalse）のみを取得
        $inputData = array_filter($data['tasks'], function($task) {
            return $task['isDelete'] == false;
        });

        // バリデーションのルールを指定
        $rules = [
            'id' => 'nullable|integer',
            '*.id' => 'nullable|integer',
            '*.taskname' => 'required|string',
            '*.state' => ['required','string', Rule::in(["やるべきこと","開発中","完了"])],
            '*.decidable' => 'required|accepted',
        ];

        // バリデーションの設定と実行
        $validatedData = Validator::make($inputData, $rules, $messages = [
            '*.taskname.required' => 'タスクの名前が入力されていません。',
            '*.state.required' => 'タスクの状態が入力されていません。',
            '*.decidable.accepted' => 'タスクの名前が編集中です。',
        ])->validateWithBag('tasks');
        // バリデーションの実行

        // idを既に持っているものは変更
        $updateData = array_filter($validatedData, function($task) {
            return count($task) > 3;
        });
        // 変更
        foreach ($updateData as $task) {
            Task::where('id', $task['id'])->update(['taskname' => $task['taskname'], 'state' => $task['state']]);
        }

        // idを持っていないものは追加
        $createData = array_filter($validatedData, function($task) {
            return count($task) == 3;
        });
        // 追加
        foreach ($createData as $task) {
            Task::create(['service_id' => $data['id'], 'taskname' => $task['taskname'], 'state' => $task['state']]);
        }

        // 削除するタスク（isDeleteがtrue）のみを取得
        $inputData = array_filter($data['tasks'], function($task) {
            return $task['isDelete'] == true && array_key_exists('id', $task);
        });
        // 削除
        foreach ($inputData as $task) {
            Task::where('id', $task['id'])->delete();
        }

        return redirect()->back()->with('success', '保存が完了しました');
    }
}
