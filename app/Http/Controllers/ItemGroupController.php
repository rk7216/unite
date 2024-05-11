<?php

// ItemGroupController.php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Auth ファサードを追加

class ItemGroupController extends Controller
{
    // アイテムグループ一覧表示
    public function index()
    {
        // ログインユーザーに紐づくアイテムグループのみを取得
        $itemGroups = ItemGroup::where('user_id', Auth::id())->get();
        return view('itemGroups.index', compact('itemGroups'));
    }

    // アイテムグループの削除
    public function destroy(Request $request, $id)
    {
        $itemGroup = ItemGroup::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); // セキュリティ強化
        $itemGroup->delete();
        
        $pokemonName = $request->input('pokemon_name', 'defaultPokemonName'); // デフォルト値を設定
        return redirect()->route('pokemon.builder', ['pokemon_name' => $pokemonName])
                         ->with('success', 'Item group deleted successfully');
    }
}
