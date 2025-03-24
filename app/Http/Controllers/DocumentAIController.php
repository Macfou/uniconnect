<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentAIService;

class DocumentAIController extends Controller
{
    protected $documentAIService;

    public function __construct(DocumentAIService $documentAIService)
    {
        $this->documentAIService = $documentAIService;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePath = $request->file('file')->store('uploads', 'local');

        $text = $this->documentAIService->processDocument(storage_path("app/$filePath"));

        return view('pages.certificate_review', compact('text'));
    }
}
