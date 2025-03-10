<x-layout>

   

    

        
   

    <div class="pt-40">

        
        <h1>Upload Certificate</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form action="{{ route('certificate.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="certificate">Upload Certificate:</label>
            <input type="file" name="certificate" required>
            <button type="submit">Upload</button>
        </form>
        

    </div>    
</script>
</x-layout>