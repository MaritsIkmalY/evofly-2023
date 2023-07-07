<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\ArticleRequest;
use App\Models\Article;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        //
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $this->fileService->getPath($request);
        }
        Article::create($data);
        return redirect()->route('article.index')->with('success', 'Berhasil membuat artikel');
    }

    public function show(Article $article)
    {
        //
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($article->image);
            $data['image'] = $this->fileService->getPath($request);
        }
        $article->update($data);
        return redirect()->route('article.index')->with('success', 'Berhasil memperbarui artikel');
    }

    public function destroy(Article $article): RedirectResponse
    {
        Storage::disk('public')->delete($article->image);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Berhasil menghapus artikel');
    }
}
