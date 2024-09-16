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
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImageUpload($request->file('image'));
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
    {
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
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $this->deleteOldImage($article->image);
            $data['image'] = $this->handleImageUpload($request->file('image'));
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
        $this->deleteOldImage($article->image);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    /**
     * Handle image upload and return the file name.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @return string
     */
    protected function handleImageUpload($image)
    {
        $originalName = $image->getClientOriginalName();
        $image->storeAs('public/images', $originalName);
        return $originalName;
    }

    /**
     * Delete the old image from storage if it exists.
     *
     * @param  string|null  $imageName
     * @return void
     */
    protected function deleteOldImage($imageName)
    {
        if ($imageName) {
            Storage::delete('public/images/' . $imageName);
        }
    }
}
