<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateDesignerController extends Controller
{
    public function create()
    {
        return view('pages.certificate_designer');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'background' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('background')->store('certificates', 'public');

        return view('pages.certificate_designer', ['backgroundPath' => $path]);
    }

    public function save(Request $request)
    {
        $data = $request->input('designData');

        Storage::disk('local')->put('certificate_design.json', json_encode($data));

        return response()->json(['message' => 'Design saved successfully']);
    }
}

