<x-layout>

  
    <head>
        <meta charset="UTF-8">
        <title>Review Certificate</title>
    </head>
    <body>
        <h1>Review and Edit Detected Name</h1>
    
        <img src="{{ asset('storage/' . $image_path) }}" alt="Uploaded Certificate" style="max-width: 500px;"><br><br>
    
        <form action="{{ route('certificate.save') }}" method="POST">
            @csrf
            <input type="hidden" name="image_path" value="{{ $image_path }}">
    
            <label for="edited_name">Edit Name:</label>
            <input type="text" name="edited_name" value="{{ $detected_name }}" required>
    
            <button type="submit">Save Edited Certificate</button>
        </form>
    
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
    </body>

    
</x-layout>
