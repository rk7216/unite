<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemGroup;
use App\Models\MedalGroup;
use App\Models\ItemGroupMedalGroup;

class ItemGroupMedalGroupController extends Controller
{
    public function store(Request $request)
    {
        $itemGroupId = $request->input('item_group_id');
        $medalGroupId = $request->input('medal_group_id');

        $itemGroupMedalGroup = new ItemGroupMedalGroup();
        $itemGroupMedalGroup->item_group_id = $itemGroupId;
        $itemGroupMedalGroup->medal_group_id = $medalGroupId;
        $itemGroupMedalGroup->save();

        return redirect()->back()->with('success', 'Medal group linked successfully.');
    }
}
