<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\WebinarRequest;
use App\Models\Webinar;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class WebinarController extends Controller
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

    public function store(WebinarRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $this->fileService->getPath($request);
        }
        Webinar::create($data);
        return redirect()->route('webinar.index')->with('success', 'Berhasil membuat webinar');
    }

    public function show(Webinar $webinar)
    {
        //
    }

    public function update(WebinarRequest $request, Webinar $webinar): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($webinar->image);
            $data['image'] = $this->fileService->getPath($request);
        }
        $webinar->update($data);
        return redirect()->route('webinar.index')->with('success', 'Berhasil memperbarui webinar');
    }

    public function destroy(Webinar $webinar): RedirectResponse
    {
        Storage::disk('public')->delete($webinar->image);
        $webinar->delete();
        return redirect()->route('webinar.index')->with('success', 'Berhasil menghapus webinar');
    }
}
