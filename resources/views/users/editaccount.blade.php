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
          
        </div>
        <div>
            @auth
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                   Full Name
                </p>
                <p>
                    {{ucfirst(auth()->user()->lname)}} {{ucfirst(auth()->user()->fname)}} {{ucfirst(auth()->user()->miname)}}.
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Organization
                </p>
                <p>
                    {{strtoupper(auth()->user()->org)}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Email Address
                </p>
                <p>
                    {{ucfirst(auth()->user()->email)}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Section
                </p>
                <p>
                    {{strtoupper(auth()->user()->section)}}
                </p>
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

<form id="changePasswordForm" class="bg-white p-6 rounded-lg shadow-lg">
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