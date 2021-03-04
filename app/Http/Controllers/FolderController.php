<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function new()
    {
        return view('folders/new');
    }

    // 引数にCreateFolder
    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        // requestからinputのnameでフォーム値取得できる
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む
        // railsとほぼほぼ似た感覚で保存処理ができる。（エラー処理、返り値、バリデーション処理などは後で調べる）
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
