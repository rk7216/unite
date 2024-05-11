<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedalGroup;

class MedalGroupController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();  // 認証されたユーザーIDを取得
        $medalGroups = MedalGroup::with('medals')->where('user_id', $user_id)->get();  // ユーザーに属するメダルグループとそのメダルを取得

        return view('posts.medal', compact('medalGroups'));  // ビューにメダルグループを渡す
    }
}
