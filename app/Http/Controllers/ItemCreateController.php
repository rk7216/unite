<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemGroup;
use Illuminate\Support\Facades\Auth;

class ItemCreateController extends Controller
{
    public function create()
    {
        $items = Item::all();
        $userItemGroups = ItemGroup::with('items')->where('user_id', Auth::id())->get();
        return view('posts.create', compact('items', 'userItemGroups'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to perform this action.');
        }
        
        $userId = Auth::id();
        $itemIds = collect($request->only(['item_1', 'item_2', 'item_3']))->filter()->values();
        $itemGroupName = $request->input('item_group_name', "Default Item Group");
        
        $itemGroup = new ItemGroup();
        $itemGroup->name = $itemGroupName;
        $itemGroup->user_id = $userId;
        $itemGroup->save();
        
        $itemGroup->items()->sync($itemIds);

        return redirect()->route('items.create')->with('success', 'Item group created successfully.');
    }

    public function destroy($id)
    {
        $itemGroup = ItemGroup::findOrFail($id);

        if ($itemGroup->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $itemGroup->items()->detach();
        $itemGroup->delete();

        return redirect()->route('items.create')->with('success', 'Item group deleted successfully.');
    }
}
