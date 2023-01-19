<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::whereis_approved(0)->when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', "%{$request->search}%")
                    ->orWhere('comment', 'LIKE', "%{$request->search}%")
                    ->orWhereHas('user', function ($query) use ($request) {
                        $query->where('full_name', 'LIKE', "%{$request->search}%");
                    });
            });
        })->latest()->paginate(10);
        if ($request->ajax()) {
            return view('admin.comments.comments-paginate', compact('comments'));
        } else {
            return view('admin.comments.index', compact('comments'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $comments = Comment::when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', "%{$request->search}%")
                    ->orWhere('comment', 'LIKE', "%{$request->search}%")
                    ->orWhereHas('user', function ($query) use ($request) {
                        $query->where('full_name', 'LIKE', "%{$request->search}%");
                    });
            });
        })->latest()->paginate(10);
        if ($request->ajax()) {
            return view('admin.comments.comments-paginate', compact('comments'));
        } else {
            return view('admin.comments.index', compact('comments'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => ['required', 'integer', 'exists:comments,id'],
            'comment' => ['required', 'string'],
        ]);
        
        $parent=Comment::findorfail($request->parent_id);

        $request->user()->comments()->create([
            'parent_id'=>$request->parent_id,
            'commentable_type'=>$parent->commentable_type,
            'commentable_id'=>$parent->commentable_id,
            'comment'=>$request->comment,
            'is_approved'=>1,
        ]);

        return response()->json([],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show')->with([
            'comment' => $comment,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:comments,id'],
            'comment' => ['required', 'string'],
        ]);

        $comment = Comment::findorfail($request->id);

        $comment->update([
            'is_approved' => 1,
            'comment' => $request->comment
        ]);

        return response()->json([], 200);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function chose(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:comments,id'],
        ]);

        $comment = Comment::findorfail($request->id);

        $comment->update([
            'is_chose' => ! $comment->is_chose
        ]);

        return response()->json([
            'comment'=>$comment
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'comment_id' => ['required', 'integer', 'exists:comments,id']
        ]);

        $comment = Comment::findorfail($request->comment_id);

        $this->deleteChilds($comment->childs);

        $comment->delete();

        return response()->json([], 200);
    }

    // ----deleteCommentChilds
    public function deleteChilds($childs)
    {
        if ($childs->isNotEmpty()) {
            foreach ($childs as $child) {
                $this->deleteChilds($child->childs);
                $child->delete();
            }
        }
    }

    // ----/deleteCommentChilds
}
