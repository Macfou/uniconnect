<?php

namespace App\Http\Controllers;



use Illuminate\Support\Str;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Google\Cloud\Core\Exception\ServiceException;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;

class CertificateController extends Controller
{
    public function uploadForm()
    {
        return view('pages.certificate');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        try {
            // Save uploaded image
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('certificates', 'public');

            // Run OCR
            $detectedText = $this->detectText(storage_path("app/public/{$imagePath}"));

            // Extract name (Assumption: First name and last name are in the detected text)
            $extractedNames = $this->extractNames($detectedText);

            return view('pages.certificate_review', [
                'image_path' => $imagePath,
                'detected_first_name' => $extractedNames['first_name'] ?? '',
                'detected_last_name' => $extractedNames['last_name'] ?? '',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error processing the image: ' . $e->getMessage());
        }
    }

    private function detectText($imagePath)
    {
        try {
            $imageAnnotator = new ImageAnnotatorClient();
            $imageData = file_get_contents($imagePath);
            $response = $imageAnnotator->documentTextDetection($imageData);
            $texts = $response->getFullTextAnnotation();
            $imageAnnotator->close();
            return $texts ? $texts->getText() : '';
        } catch (ServiceException $e) {
            return 'Error in Google Cloud Vision API: ' . $e->getMessage();
        }
    }

    private function extractNames($text)
    {
        // Split text into words
        $words = explode("\n", $text);
        
        // Assume first name is the first word and last name is the second word
        return [
            'first_name' => $words[0] ?? '',
            'last_name' => $words[1] ?? '',
        ];
    }
}
