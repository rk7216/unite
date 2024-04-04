<?php

// MedalController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medal;

class MedalController extends Controller
{
    public function index()
    {
        $medals = Medal::all(); // すべてのメダルを取得

        return view('posts.medal', compact('medals'));
    }
}