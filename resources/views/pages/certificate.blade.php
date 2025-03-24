<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Certificate</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto p-6">
        <form action="{{ route('process.certificate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required class="border p-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
        </form>
    </div>
</body>
</html>
