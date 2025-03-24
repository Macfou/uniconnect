<!DOCTYPE html>
<html lang="en">
<head>
    <title>Review Certificate</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto p-6">
        <form action="{{ route('save.certificate') }}" method="POST">
            @csrf
            <label>Name Extracted:</label>
            <input type="text" name="name" value="{{ $text }}" class="border p-2 w-full">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</body>
</html>
