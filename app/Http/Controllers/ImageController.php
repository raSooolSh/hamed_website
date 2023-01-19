<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
       /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request){
        $data=$request->validate([
            'w'=>'integer|max:3600',
            'h'=>'integer|max:3600',
            'image'=>'required|string',
        ]);

        if(! File::exists(public_path($request->image))){
            return abort(404);
        }

        if(! key_exists('w',$data)){
            $data['w']=800;
        }
        if(! key_exists('h',$data)){
            $data['h']=600;
        }


        $imageName=mb_substr($data['image'],0,mb_strpos($data['image'],'.')) . '-' . $data['w'] . 'X' . $data['h'] . "." . mb_substr($data['image'],mb_strpos($data['image'],'.')+1);
        if(File::exists(public_path($imageName))){
            return response()->file(public_path($imageName));
        }else{
            $newImage=Image::make(file::get(public_path($request->image)));
            $newImage->resize($data['w'],$data['h']);
            $newImage->save(public_path($imageName));
            return response()->file(public_path($imageName));
        }
        
    }

}
