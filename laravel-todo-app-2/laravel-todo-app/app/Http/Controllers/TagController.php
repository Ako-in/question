<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function store(Request $request)
    {
        $request ->validate([
            'name' =>'required',
        ]);
        $tag = new Tag();
        $tag->name=$request->input('name');
        $tag->user_id=Auth::id();
        $tag->save();

        return redirect()->route('goals.index');
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $tag->name=$request->input('name');
        $tag->user_id=Auth::id();
        $tag->save();

        return redirect()->route('goals.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('goals.index');
    }
}
