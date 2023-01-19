<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('content', 'LIKE', "%{$request->search}%");
            });
        })->latest()->paginate(8);
        if ($request->ajax()) {
            return view('admin.articles.articles-paginate', compact('articles'));
        } else {
            return view('admin.articles.index', compact('articles'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'title'=>['required','string','min:3'],
            'type'=>['required','in:article,news'],
            'description'=>['required','string'],
            'image'=>['required','string'],
            'is_active'=>['required','boolean'],
            'content'=>['required','string'],
        ]);
       
        $request->user()->Articles()->create($validate);

        alert()->success('مطلب با موفقیت ایجاد شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.articles.show')->with([
            'article'=>$article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit')->with([
            'article'=>$article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validate=$request->validate([
            'title'=>['required','string','min:3'],
            'type'=>['required','in:article,news'],
            'description'=>['required','string'],
            'image'=>['required','string'],
            'is_active'=>['required','boolean'],
            'content'=>['required','string'],
        ]);
       
        $article->update($validate);

        alert()->success('مطلب با موفقیت ویرایش شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $article=Article::where('slug',$request->article_slug)->first();

        $article->delete();
        alert()->success('مطلب با موفقیت حذف شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.articles.index');
    }
}
