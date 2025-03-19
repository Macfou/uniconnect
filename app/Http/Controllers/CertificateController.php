<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;

class CertificateController extends Controller
{
    public function uploadForm()
    {
        return view('pages.certificate');
    }

    public function upload(Request $request)
{
    // Validate the uploaded image
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Create an instance of ImageManager
    $manager = new ImageManager('gd');

    // Get the uploaded file
    $imageFile = $request->file('image');

    // Read and resize the image
    $image = $manager->make($imageFile->getRealPath())->resize(300, null, function ($constraint) {
        $constraint->aspectRatio();
    });

    // Ensure the upload directory exists
    $uploadPath = public_path('uploads');
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Define the save path
    $savePath = $uploadPath . '/resized_image.jpg';

    // Save the image
    $image->save($savePath);

    return response()->json(['message' => 'Image uploaded and resized successfully!', 'path' => url('uploads/resized_image.jpg')]);
}
 

    public function save(Request $request)
    {
        $request->validate([
            'image_path' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);
    
        // Get the original certificate image
        $imagePath = storage_path('app/public/' . $request->image_path);
        $firstName = $request->first_name;
        $lastName = $request->last_name;
    
        // Create an instance of ImageManager
        $manager = new ImageManager('gd');
    
        // Read the image
        $img = $manager->read($imagePath);
    
        // Ensure the font file exists before using it
        $fontPath = public_path('fonts/arial.ttf');
        if (!file_exists($fontPath)) {
            return back()->withErrors(['error' => 'Font file not found. Please add arial.ttf to public/fonts/']);
        }
    
        // Add first name at a specific position
        $img->text($firstName, 200, 200, function ($font) use ($fontPath) {
            $font->filename($fontPath);
            $font->size(48);
            $font->color('#000000');
        });
    
        // Add last name at another position
        $img->text($lastName, 200, 300, function ($font) use ($fontPath) {
            $font->filename($fontPath);
            $font->size(48);
            $font->color('#000000');
        });
    
        // Convert to base64 for preview
        $base64Image = (string) $img->encode('jpg', 90);
        $base64Image = 'data:image/jpeg;base64,' . base64_encode($base64Image);
    
        return view('pages.certificate_review', [
            'image_path' => $request->image_path,
            'detected_first_name' => $firstName,
            'detected_last_name' => $lastName,
            'edited_image' => $base64Image,
        ]);
    }
}
