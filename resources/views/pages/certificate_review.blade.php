<x-layout>

    <div class="pt-40">
        <h1>Edit Certificate</h1>

        <!-- Form for editing the names -->
        <form action="{{ route('certificate.save') }}" method="POST" id="edit-form">
            @csrf
            <input type="hidden" name="image_path" value="{{ $image_path }}">
            
            <label for="first_name">First Name:</label>
            <input 
                type="text" 
                id="first_name" 
                name="first_name" 
                value="{{ $detected_first_name }}" 
                required
                oninput="updatePreview()"
            >

            <label for="last_name">Last Name:</label>
            <input 
                type="text" 
                id="last_name" 
                name="last_name" 
                value="{{ $detected_last_name }}" 
                required
                oninput="updatePreview()"
            >

            <!-- Button to trigger the preview update -->
            <button type="button" id="showCertificateBtn" onclick="submitForm()">Show Edited Certificate</button>
        </form>

        <!-- Preview section -->
        @if(isset($edited_image))
            <h2>Edited Certificate Preview</h2>
            <div style="position: relative; display: inline-block;">
                <img 
                    id="certificate_image" 
                    src="{{ asset('storage/' . $image_path) }}" 
                    alt="Certificate"
                    style="width: 100%; max-width: 600px;" 
                >
                <div 
                    id="first_name_overlay" 
                    style="position: absolute; top: 200px; left: 200px; color: black; font-size: 48px; font-family: Arial, sans-serif;">
                    {{ $detected_first_name }}
                </div>
                <div 
                    id="last_name_overlay" 
                    style="position: absolute; top: 300px; left: 200px; color: black; font-size: 48px; font-family: Arial, sans-serif;">
                    {{ $detected_last_name }}
                </div>
            </div>
        @endif

    </div>

    <script>
        function submitForm() {
            // Simulate a form submit to trigger the controller logic and update the preview
            var form = document.getElementById('edit-form');
            form.submit();
        }

        function updatePreview() {
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            document.getElementById('first_name_overlay').innerText = firstName;
            document.getElementById('last_name_overlay').innerText = lastName;
        }
    </script>

</x-layout>
