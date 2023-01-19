<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class EpisodeController extends Controller
{
    // ----index
    public function index(Course $course)
    {
        return view('admin.episodes.index')->with([
            'course' => $course
        ]);
    }
    // ----/index


    // ----create
    public function create(Course $course)
    {
        return view('admin.episodes.create')->with([
            'course' => $course,
        ]);
    }

    // ----/create


    // ----store
    public function store(Request $request, Course $course)
    {
        $validata = $request->validate([
            'name' => ['required', 'string'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'number' => ['required', 'integer'],
            'is_free' => ['required', 'boolean'],
            'video' => ['required', 'string', 'regex:/.mp4$/']
        ]);

        if (!is_null($course->episodes()->where('number', $validata['number'])->first())) {
            throw ValidationException::withMessages(['number' => 'قبلا چنین قسمتی ثبت شده']);
        }

        $course->episodes()->create($validata);

        alert()->success('اپیزود با موفقیت ایجاد شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.episodes.index', $course->slug);
    }

    // ----/store


    // ----show
    public function show(Course $course, Episode $episode)
    {
        return view('admin.episodes.show')->with([
            'course' => $course,
            'episode' => $episode
        ]);
    }

    // ----/show


    // ----edit
    public function edit(Course $course, Episode $episode)
    {
        return view('admin.episodes.edit')->with([
            'course' => $course,
            'episode' => $episode
        ]);
    }

    // ----/edit


    // ----update
    public function update(Request $request, Course $course, Episode $episode)
    {
        $validata = $request->validate([
            'name' => ['required', 'string'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'number' => ['required', 'integer'],
            'is_free' => ['required', 'boolean'],
            'video' => ['required', 'string', 'regex:/.mp4$/']
        ]);
        // dd($course->sections()->find($validata['section_id']));
        if ($validata['number'] != $episode->number && !is_null($course->episodes()->where('number', $validata['number'])->first())) {
            throw ValidationException::withMessages(['number' => 'قبلا چنین قسمتی ثبت شده']);
        }

        $episode->update($validata);

        alert()->success('اپیزود با موفقیت ویرایش شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.episodes.index', $course->slug);
    }

    // ----/update


    // ----destroy
    public function destroy(Request $request,Course $course)
    {
        $request->validate([
            'episode_id'=>'required|integer|exists:episodes,id'
        ]);
        $episode=Episode::find($request->episode_id);

        $episode->delete();
       
        alert()->success('اپیزود با موفقیت حذف شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.episodes.index', $course->slug);
    }

    // ----/destroy
}
