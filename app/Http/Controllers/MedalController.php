<?php

// MedalController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medal;
use App\Models\MedalSet;
use Illuminate\Support\Facades\Auth;


class MedalController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // その他のバリデーションルール
        ]);
        //$medals = Medal::all(); // すべてのメダルを取得
        
        $medalSet = new MedalSet();
        $medalSet->name = $validated['name'];
        $medalSet->user_id = auth()->id();
        $medalSet->save();
    
        // メダルIDの配列を取得し、メダルセットに紐づける
        if ($request->has('medals')) {
            $medalSet->medals()->attach($request->medals);
        }

        return redirect()->route('medal.index')->with('success', 'Medal Set created successfully.');
    }
    
    public function index()
    {
        $medals = Medal::all(); // すべてのメダルを取得
        $medalSets = MedalSet::where('user_id', Auth::id())->get(); // ログインユーザーのメダルセットのみを取得
        return view('posts.medal', compact('medals','medalSets'));
    }
}