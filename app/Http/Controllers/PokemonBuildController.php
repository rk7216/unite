<?php

// PokemonBuildController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokeModel;
use App\Models\Item;
use App\Models\MedalSet;
use Illuminate\Support\Facades\Auth;


class PokemonBuildController extends Controller
{
    public function index($pokemon_name)
    {
        // ポケモンテーブルから指定されたポケモン名の詳細データを取得
        $pokemon = PokeModel::where('pokemon_name', $pokemon_name)->first(); // ポケモン情報を取得

        // アイテムの一覧を取得
        $items = Item::all();
        
        // ログインしたユーザーに紐づくメダルセットの一覧を取得
        $medalsets = MedalSet::where('user_id', Auth::id())->get();
        
        // ポケモンが存在しない場合はエラーを返すか、リダイレクトなどの適切な処理を行う
        if (!$pokemon) {
            abort(404); // 404エラーを返す
        }

        // ポケモンの各レベルのステータス情報を取得
        $pokemon_levels = PokeModel::where('pokemon_name', $pokemon_name)->get();

        // データをビューに渡す
        return view('posts.builder', compact('pokemon', 'pokemon_levels', 'items','medalsets'));
    }
    public function update(Request $request, $pokemon_id)
    {
        dd($request->all());

        // ログインしていない場合はログインページにリダイレクト
        if (!Auth::check()) {
        // リクエストがAJAXの場合は、JSONレスポンスを返すことも可能です
        if ($request->ajax()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // ここでは、ログインページにリダイレクトしていますが、
        // 必要に応じて別の処理を行っても構いません
        return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $pokemon = PokeModel::find($pokemon_id);
        if (!$pokemon) {
            return redirect()->back()->with('error', 'Pokemon not found.');
        }
        
        // アイテムの選択処理
        $itemIds = $request->input('items'); // アイテムIDの配列として送信されることを期待
        $pokemon->items()->sync($itemIds); // アイテムとポケモンの紐付け
    
        // ログインユーザーのみが自分のポケモンを更新できるようにする
        // ここでポケモンが特定のユーザーに紐づいているかを確認します
        if ($pokemon->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You do not have permission to update this pokemon.');
        }
        
        // ステータス加算処理を追加
        $items = Item::whereIn('id', $itemIds)->get(); // 選択されたアイテムのデータを取得
        $pokemon_levels = $pokemon->levels()->get(); // ポケモンの各レベルのデータを取得
    
        foreach ($pokemon_levels as $level) {
            foreach ($items as $item) {
                $level->hp += $item->hp;
                $level->attack += $item->attack;
                $level->defense += $item->defense;
                $level->sp_attack += $item->sp_attack;
                $level->sp_defense += $item->sp_defense;
                $level->crit_rate += $item->crit_rate;
                $level->cdr += $item->cdr;
                $level->attack_speed += $item->attack_speed;
                $level->move_speed += $item->move_speed;
            }
            $level->save(); // 加算後のステータスを保存
        }
        
        // メダルセットIDを取得
        $medalSetId = $request->input('medal_set');
        
        // メダルセットが選択されていれば紐づけ処理を行う（多対多リレーションの例）
        if (!is_null($medalSetId)) {
            $pokemon->medalSets()->sync([$medalSetId]); // 仮に多対多リレーションの場合
        }
        
        // アイテムの紐づけ処理を更新
        if (!empty($itemIds)) {
            $pokemon->items()->sync($itemIds);
        }
    
        return redirect()->route('pokemon.builder', $pokemon_name)->with('success', 'Pokemon updated successfully.');
    }
    
}