<?php

// ItemGroupController.php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use Illuminate\Http\Request;

class ItemGroupController extends Controller
{
    // アイテムグループ一覧表示
    public function index()
    {
        $itemGroups = ItemGroup::all();
        return view('itemGroups.index', compact('itemGroups'));
    }

    // アイテムグループの削除
    public function destroy($id)
    {
        $itemGroup = ItemGroup::findOrFail($id);
        $itemGroup->delete();
        return redirect()->route('pokemon.builder')->with('success', 'Item group deleted successfully');
    }
}
