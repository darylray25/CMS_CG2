<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

     /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsarticle()
{
    $articles = Article::all();
    // dd($articles);
    return view('articles.newsarticle', compact('articles'));
}

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov,mkv|max:51200', // 50MB max size
        ]);

        // Handle media upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleMediaUpload($request->file('image'));
        }

        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {  $articles = Article::all();
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov,mkv|max:51200', // 50MB max size
        ]);

        // Handle media upload
        if ($request->hasFile('image')) {
            $this->deleteOldMedia($article->image);
            $data['image'] = $this->handleMediaUpload($request->file('image'));
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->deleteOldMedia($article->image);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    /**
     * Handle media upload and return the file name.
     *
     * @param  \Illuminate\Http\UploadedFile  $media
     * @return string
     */
    protected function handleMediaUpload($media)
    {
        $originalName = $media->getClientOriginalName();
        $path = 'public/media';
        
        // Ensure the file name is unique
        $filename = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $media->getClientOriginalExtension();
        $uniqueName = $originalName;

        $i = 1;
        while (Storage::exists($path . '/' . $uniqueName)) {
            $uniqueName = $filename . '_' . $i . '.' . $extension;
            $i++;
        }

        $media->storeAs($path, $uniqueName);
        return $uniqueName;
    }

    /**
     * Delete the old media from storage if it exists.
     *
     * @param  string|null  $mediaName
     * @return void
     */
    protected function deleteOldMedia($mediaName)
    {
        if ($mediaName) {
            Storage::delete('public/media/' . $mediaName);
        }
    }
}
