<?php

namespace App\Http\Controllers;


use App\Models\Certificate;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;


use Intervention\Image\ImageServiceProvider;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class CertificateController extends Controller
{
    public function uploadForm()
    {
        return view('pages.certificate');
    }

    public function upload(Request $request)
{
    $request->validate([
        'certificate' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    // Store uploaded file in storage/app/public/certificates
    $file = $request->file('certificate');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('certificates', $fileName, 'public');

    // Google Vision credentials
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('app/google/just-metric-442513-c5-078ddc6f8500.json'));

    // Correct path to file
    $imageContent = file_get_contents(storage_path('app/public/' . $path));

    // Detect text using Google Vision
    $client = new ImageAnnotatorClient();
    $response = $client->textDetection($imageContent);
    $texts = $response->getTextAnnotations(); // This is a RepeatedField object
    $client->close();

    $detectedFirstName = '';
    $detectedLastName = '';

    // Loop through the detected texts (RepeatedField is iterable)
    foreach ($texts as $text) {
        $textDescription = $text->getDescription();

        // Search for "First Name" and "Last Name" and capture the text next to them
        if (strpos($textDescription, 'First Name') !== false) {
            // Extract the next word (the actual name) from the next text block
            $detectedFirstName = $this->getNextText($texts, $text);
        }

        if (strpos($textDescription, 'Last Name') !== false) {
            // Extract the next word (the actual name) from the next text block
            $detectedLastName = $this->getNextText($texts, $text);
        }
    }

    return view('pages.certificate_review', [
        'image_path' => $path, // relative to public storage
        'detected_first_name' => $detectedFirstName,
        'detected_last_name' => $detectedLastName,
    ]);
}

   
public function save(Request $request)
{
    $manager = new ImageManager('gd'); // Corrected here
    
    $request->validate([
        'image_path' => 'required|string',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
    ]);
    
    // Get the original certificate image
    $imagePath = storage_path('app/public/' . $request->image_path);
    
    // Edited first and last names
    $firstName = $request->first_name;
    $lastName = $request->last_name;

    // Read the image and prepare to overlay text
    $img = $manager->make($imagePath);
    
    // Add the first name at the defined position
    $img->text($firstName, 200, 200, function ($font) {
        $font->file(public_path('fonts/arial.ttf')); // Specify font
        $font->size(48);
        $font->color('#000000');
    });
    
    // Add the last name at another defined position
    $img->text($lastName, 200, 300, function ($font) {
        $font->file(public_path('fonts/arial.ttf')); // Specify font
        $font->size(48);
        $font->color('#000000');
    });

    // Convert the edited image to base64 for real-time preview
    $base64Image = (string) $img->encode('data-url');

    return view('pages.certificate_review', [
        'image_path' => $request->image_path, // Pass the original image path
        'detected_first_name' => $firstName,
        'detected_last_name' => $lastName,
        'edited_image' => $base64Image, // Pass the base64 encoded image for preview
    ]);
}

}
