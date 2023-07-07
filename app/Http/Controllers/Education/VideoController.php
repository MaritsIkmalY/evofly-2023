<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\VideoRequest;
use App\Models\Video;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
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

    public function store(VideoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $this->fileService->getPath($request);
        }
        Video::create($data);
        return redirect()->route('video.index')->with('success', 'Berhasil membuat video');
    }

    public function show(Video $video)
    {
        //
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($video->image);
            $data['image'] = $this->fileService->getPath($request);
        }
        $video->update($data);
        return redirect()->route('video.index')->with('success', 'Berhasil memperbarui video');
    }

    public function destroy(Video $video): RedirectResponse
    {
        Storage::disk('public')->delete($video->image);
        $video->delete();
        return redirect()->route('video.index')->with('success', 'Berhasil menghapus video');
    }
}
