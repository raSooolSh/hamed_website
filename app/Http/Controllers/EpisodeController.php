<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{

    //-----download
    public function download(Request $request,Course $course,$episodeNumber)
    {
        
        $episode=$course->episodes()->where('number',$episodeNumber)->first();

        if(! is_null($episode)){
            $hash=hash('sha1',env('EPISODES_SECRET_KEY').$episode->id.$request->ip().$request->expire);
        }else{
            abort(404);
        }
       

        if(isset($hash) &&  $hash === $request->key && now()->timestamp < $request->expire){
            if(Auth::check()){
                if( $request->user()->episodes->find($episode->id)){
                    $downloadRequest=$request->user()->episodes->find($episode->id)->pivot->request;
                    $request->user()->episodes()->detach($episode->id);
                    $request->user()->episodes()->attach($episode->id,['request'=>$downloadRequest+1]);
                }else{
                    $request->user()->episodes()->attach($episode->id,['request'=>1]);
                }
            }
            
            return response()->file(Storage::disk('vip')->path($episode->video),[
                'Content-disposition'=>'attachment',
                'filename'=>'dfg.mp4'
            ]);
        }else{
            return 'Access denied';
        }
        
    }
    //-----/download

    // -----show
        public function show(Course $course,$episode)
        {
            $episode=$course->episodes()->whereNumber($episode)->first();
            if(! $episode){
                abort(404);
            }
            return view('front.episodes.show')->with([
                'course'=>$course,
                'episode'=>$episode,
                'comments'=>$episode->comments()->where('parent_id',0)->where('is_approved',1)->paginate(12)
            ]);
        }
    // -----/show
}
