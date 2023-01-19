<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Episode;

class UserDownloadController extends Controller
{
    // -----index
    public function index(Request $request,User $user)
    {
        if($request->has('search')){
            $course=Course::where('name','LIKE',"%{$request->search}%")->first();
            if($course){
                $episodes=$user->episodes->filter(function($value)use($course){
                    return $value->course_id == $course->id;
                });
            }else{
                $episodes=collect([]);
            }
            
        }else{
            $episodes=$user->episodes;
        }

        if($request->ajax()){
            return view('admin.users.downloads-paginate')->with([
                'episodes'=>$episodes
            ]);
        }
        return view('admin.users.downloads-index')->with([
            'episodes'=>$episodes,
        ]);
    }
    // -----/index
}
