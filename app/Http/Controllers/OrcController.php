<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrController extends Controller
{
    public function extractText()
    {
        $imagePath = public_path('certificate_sample.png');

        // Explicitly set the Tesseract binary path
        $tesseractPath = 'C:\\Program Files\\Tesseract-OCR\\tesseract.exe';

        if (!file_exists($tesseractPath)) {
            return response()->json(['error' => 'Tesseract not found at specified path'], 500);
        }

        if (!file_exists($imagePath)) {
            return response()->json(['error' => 'Image file not found'], 404);
        }

        $text = (new TesseractOCR($imagePath))
            ->setBinPath($tesseractPath)
            ->run();

        return response()->json(['extracted_text' => $text]);
    }
}
