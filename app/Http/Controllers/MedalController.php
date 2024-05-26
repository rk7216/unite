<?php

// MedalController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medal;
use App\Models\MedalGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MedalController extends Controller
{
    public function store(Request $request)
    {
        try {
            // ユーザーがログインしているか確認
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'You must be logged in to create a medal set.');
            }
    
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'medals' => 'required|string',
            ]);
            
            $user_id = Auth::id(); // ログインしているユーザーのIDを取得
            $medalIds = json_decode($request->input('medals'));
    
            // メダルグループを作成
            $medalGroup = new MedalGroup();
            $medalGroup->name = $request->input('name');
            $medalGroup->user_id = $user_id;
            $medalGroup->save();
        
            // メダルグループにメダルを紐づけ
            $medalGroup->medals()->attach($medalIds);
            
            // 選択されたメダルの名前を取得
            $selectedMedals = Medal::whereIn('id', $medalIds)->get(['medal_name']);
            
            // 選択されたメダルの名前をセッションに保存
            $request->session()->flash('selectedMedals', $selectedMedals->pluck('medal_name')->toArray());
            
            // ステータスの合計値を計算
            $totalStats = [
                'hp' => 0,
                'attack' => 0,
                'defense' => 0,
                'sp_attack' => 0,
                'sp_defense' => 0,
                'crit_rate' => 0,
                'cdr' => 0,
                'move_speed' => 0
            ];
            foreach ($medalGroup->medals as $medal) {
                $totalStats['hp'] += $medal->hp;
                $totalStats['attack'] += $medal->attack;
                $totalStats['defense'] += $medal->defense;
                $totalStats['sp_attack'] += $medal->sp_attack;
                $totalStats['sp_defense'] += $medal->sp_defense;
                $totalStats['crit_rate'] += $medal->crit_rate;
                $totalStats['cdr'] += $medal->cdr;
                $totalStats['move_speed'] += $medal->move_speed;
            }
            
            // 色のカウントを計算
            $colorCounts = $medalGroup->countMedalColors();
    
            // 色のカウントをフラッシュセッションに保存
            $request->session()->flash('colorCounts', $colorCounts);
    
            return redirect()->route('medal.index')->with('success', 'Medal Set created successfully.')->with('totalStats', $totalStats);
        } catch (\Exception $e) {
            // 例外が発生した場合はエラーを表示
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function index()
    {

        $medals = Medal::all();
        $medalGroups = MedalGroup::where('user_id', Auth::id())->get();
        
        // 非ゼロステータスを計算
        foreach ($medalGroups as $group) {
            $group->nonZeroStats = $group->calculateTotalStats();
            $group->colorCounts = $group->countMedalColors();

        }

        return view('posts.medal', compact('medals', 'medalGroups'));
    }
    
    public function destroy($id)
    {
        $medalGroup = MedalGroup::findOrFail($id);
    
        // セキュリティチェック: ログインユーザーが削除しようとしているメダルセットの所有者であるかを確認
        if ($medalGroup->user_id != Auth::id()) {
            return back()->with('error', 'You do not have permission to delete this medal set.');
        }
    
        $medalGroup->delete(); // メダルセットを削除
    
        return back()->with('success', 'Medal set deleted successfully.');
    }
    
    public function show($id)
    {
        $medalGroup = MedalGroup::with('medals')->findOrFail($id);
    
        // ユーザーの所有権を確認
        if ($medalGroup->user_id != Auth::id()) {
            return back()->with('error', 'You do not have permission to view this medal set.');
        }
    
        // ステータスの合計値を計算
        $totalStats = [
            'hp' => 0,
            'attack' => 0,
            'defense' => 0,
            'sp_attack' => 0,
            'sp_defense' => 0,
            'crit_rate' => 0,
            'cdr' => 0,
            'move_speed' => 0
        ];
    
        foreach ($medalGroup->medals as $medal) {
            foreach ($totalStats as $key => $value) {
                $totalStats[$key] += $medal->{$key} ?? 0;
            }
        }
    
        return view('medal.show', compact('medalGroup', 'totalStats'));
    }

}