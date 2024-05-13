<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 現在ログイン中のユーザーが持つ目標をすべて取得し、変数$goalsに代入する
        $goals = Auth::user()->goals;
        $tags = Auth::user()->tags;
        // view()ヘルパーの第2引数にPHPのcompact()関数を指定し、変数$goalsをビューに渡す
        return view('goals.index',compact('goals','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //LaravelのRequestクラスを使ってフォームから送信された入力内容を取得
    {
        //バリデーションを設定し、フォームに値が入力されているかどうかチェックする
        $request->validate([
            'title'=>'required',
        ]);
        // Goalモデルをインスタンス化して新しいデータ（テーブルのレコード）を作成
        $goal = new Goal();
        // フォームから送信された入力内容（目標のタイトル）をtitleカラムに代入する
        $goal->title = $request->input('title');
        // 現在ログイン中のユーザーのIDをuser_idカラムに代入する
        $goal->user_id = Auth::id();
        // goalsテーブルにデータを保存する
        $goal->save();
        // topページへリダイレクト
        return redirect()->route('goals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    // public function show(Goal $goal)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    // public function edit(Goal $goal)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'title'=>'required',
        ]);
        $goal->title=$request->input('title');
        $goal->user_id=Auth::id();
        $goal->save();
        return redirect()->route('goals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('goals.index');
    }
}
