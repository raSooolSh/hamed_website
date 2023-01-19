<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    // ----store
    public function store(Request $request){
        $validata=$request->validate([
            'parent_id'=>['required','integer'],
            'comment'=>['required','string'],
            'commentable_type'=>['required','string'],
            'commentable_id'=>['required','integer']
        ]);
        // dd($request->commentable_type);
        if(! $request->commentable_type::find($request->commentable_id)){
            return ValidationException::withMessages(['commentable_type'=>'چنین موردی وجود ندارد']);
        }

        $comment=$request->user()->Comments()->create(array_merge($validata,[
            'is_approved'=>$request->user()->hasAccessToAdminPanel() && ($request->user()->type == "admin" || $request->user()->can('comments-manage'))
        ]));

        return response()->json($comment,201);

    }
    // ----/store
}
