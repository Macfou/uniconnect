<x-layout>
    @include('partials._breadcrumb')
   <section>
    <!-- This is an example component -->
<div class="min-h-screen  flex items-center justify-center px-4">
    
    <div class="max-w-4xl pt-4  bg-white w-full rounded-lg shadow-xl">
        <div class="p-4 border-b">
            <h2 class="text-2xl font-bold ">
                {{ucfirst(auth()->user()->fname)}}'s Information
            </h2>
          
          <div class="flex flex-col md:flex-row items-start gap-6 mt-6">

    {{-- Profile Photo Upload --}}
    <form action="{{ route('upload.photo') }}" method="POST" enctype="multipart/form-data" class="relative group">
        @csrf
        @php
            $photo = auth()->user()->photo 
                ? asset('storage/' . auth()->user()->photo) 
                : asset('images/default_user.png');
        @endphp

        <label for="photoUpload" class="cursor-pointer">
            <img src="{{ $photo }}" alt="Profile Photo" 
                class="w-60 h-60 object-cover rounded-xl border shadow-md group-hover:opacity-70 transition">
            @if (!auth()->user()->photo)
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <div class="bg-black bg-opacity-50 rounded-xl p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
            @endif
        </label>

        <input type="file" id="photoUpload" name="photo" class="hidden" onchange="this.form.submit()">
    </form>

    {{-- Profile Info --}}
    <div class="w-full">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @auth
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                    <p class="text-gray-600 font-semibold">Full Name</p>
                    <p>{{ ucfirst(auth()->user()->lname) }} {{ ucfirst(auth()->user()->fname) }} {{ ucfirst(auth()->user()->miname) }}.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                    <p class="text-gray-600 font-semibold">Organization</p>
                    <p>{{ strtoupper(auth()->user()->org) }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                    <p class="text-gray-600 font-semibold">Email Address</p>
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                    <p class="text-gray-600 font-semibold">Section</p>
                    <p>{{ strtoupper(auth()->user()->section) }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                        <p class="text-gray-600 font-semibold">Section</p>
                        <p>{{ strtoupper(auth()->user()->section) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border-b pb-2">
                    
                        <button onclick="toggleForm()" class="bg-laravel text-white px-4 py-2 rounded-lg font-semibold hover:bg-grey-700 transition duration-200">
                            Change Password
                        </button>
                    </div>
                
            </div>
        
    </div>
</div>

           
        
        
                <!-- Change Password Form -->
               
<!-- Success & Error Modal (Initially Hidden) -->
<div id="modalMessage" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <div id="modalMessageContent" class="text-center"></div>
        <button onclick="closeModal()" class="mt-4 bg-red-600 text-white py-2 px-4 rounded-lg">
            Close
        </button>
    </div>
</div>



<!-- Hidden Change Password Form -->
<div id="passwordFormContainer" style="display: none;">
    <form id="changePasswordForm" class="bg-white p-6 rounded-lg shadow-lg mt-4">
        @csrf
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Change Password</h2>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Current Password:</label>
            <input type="password" name="current_password" id="current_password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">New Password:</label>
            <input type="password" name="new_password" id="new_password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Confirm New Password:</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="button" onclick="sendOtp()" id="updatePasswordButton" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
            Update Password
        </button>
    </form>
</div>

<!-- JavaScript -->
<script>
    function toggleForm() {
        const formContainer = document.getElementById('passwordFormContainer');
        formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
    }
</script>


<!-- OTP Input (Hidden by Default) -->
<div id="otpSection" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mt-4 hidden">
    <h3 class="text-xl font-semibold text-black mb-3 text-center">Enter OTP</h3>

    <div class="mb-4">
        <label class="block text-gray-700 font-medium">OTP Code:</label>
        <input type="text" id="otpInput" name="otp" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <button type="button" onclick="verifyOtp()" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition duration-200">
        Verify OTP
    </button>
</div>

<script>
function sendOtp() {
    let currentPassword = document.getElementById("current_password").value;
    let newPassword = document.getElementById("new_password").value;
    let confirmPassword = document.getElementById("new_password_confirmation").value;
    let formData = new FormData(document.getElementById("changePasswordForm"));

    // Validate: Ensure current password is entered
    if (currentPassword.trim() === "") {
        showModal("Please enter your current password.");
        return;
    }

    // Validate: Ensure new password is entered and meets criteria
    if (newPassword.trim() === "") {
        showModal("Please enter a new password.");
        return;
    }
    if (newPassword.length < 8) {
        showModal("New password must be at least 8 characters long.");
        return;
    }

    // Validate: Ensure new password and confirmation match
    if (newPassword !== confirmPassword) {
        showModal("New password and confirmation do not match.");
        return;
    }

    // Change button text
    document.getElementById("updatePasswordButton").innerText = "Please wait for OTP...";

    fetch("{{ route('sendOtp') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("otpSection").classList.remove("hidden"); // Show OTP input
        } else {
            showModal(data.error || "Failed to send OTP. Please try again.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        showModal("An error occurred while sending OTP.");
    });
}

function verifyOtp() {
    let otp = document.getElementById("otpInput").value;
    let newPassword = document.getElementById("new_password").value;
    let confirmPassword = document.getElementById("new_password_confirmation").value;

    if (newPassword !== confirmPassword) {
        showModal("New password and confirmation do not match.");
        return;
    }

    fetch("{{ route('verifyOtp') }}", {
        method: "POST",
        body: JSON.stringify({ otp: otp, new_password: newPassword }),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showModal("Password changed successfully!");
            setTimeout(() => location.reload(), 2000); // Reload after a short delay
        } else {
            showModal(data.error);
        }
    });
}

function showModal(message) {
    document.getElementById("modalMessageContent").innerText = message;
    document.getElementById("modalMessage").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("modalMessage").classList.add("hidden");
}
</script>


                    </div>
                    @endauth

                    
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
</x-layout>