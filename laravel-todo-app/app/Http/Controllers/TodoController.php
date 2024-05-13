<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function store(Request $request,Goal $goal){
        $request->validate([
            'content'=>'required',
        ]);
        $todo = new Todo();
        $todo->content=$request->input('content');
        $todo->user_id=Auth::id();
        $todo->goal_id=$goal->id;
        $todo->done=false;
        $todo->save();
        return redirect()->route('goals.index');   
    }

    public function update(Request $request, Goal $goal,Todo $todo)
    {
        $request->validate([
            'content'=>'required',
        ]);
        $todo->content=$request->input('content');
        $todo->user_id=Auth::id();
        $todo->goal_id=$goal->id;
        $todo ->done=$request->boolean('done',$todo->done);
        $todo->save();
        return redirect()->route('goals.index');
    }

    public function destroy(Goal $goal,Todo $todo)
    {
        $todo->delete();
        return redirect()->route('goals.index');
    }
}
