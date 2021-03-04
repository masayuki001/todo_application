<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public function tasks()
    {
        // Laravel は関連性（リレーション）をたどって、紐づくタスククラスのリストを取得
        // 引数は省略してる（$this->hasMany('App\Models\Task', 'folder_id', 'id');）
        //　第二引数が 「テーブル名単数形_id」 で第三引数が 「id」 であれば省略可
        return $this->hasMany('App\Models\Task');
    }
}
