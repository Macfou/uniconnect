<x-layout>

    @include('partials._myevents')

    

        
   

    <div class="pt-20">

        
        <div class="flex justify-center items-center min-h-screen bg-gray-50">
            <div class="w-full max-w-4xl bg-white shadow-lg border-2 border-gray-300 p-10 rounded-lg relative" id="certificate-container" style="background-size: cover; background-position: center; background-repeat: no-repeat;">
                <!-- Logos -->
                <div class="absolute top-4 left-4 flex gap-2">
                    <!-- Left Logo 1 -->
                    <div>
                        <img src="path_to_your_logo_left1.png" alt="Left Logo 1" class="logo left-logo-1" style="width: 80px; height: auto;">
                        <input type="file" accept="image/*" class="mt-2 block text-sm"
                               onchange="document.querySelector('.left-logo-1').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <!-- Left Logo 2 -->
                   
                </div>
        
                <!-- Header -->
                <div class="text-center border-b-2 border-gray-200 pb-4">
                    <h1 class="text-4xl font-bold text-gray-800">Certificate of Attendance</h1>
                    <p class="text-gray-600 mt-2 text-lg">This certifies that</p>
                </div>
        
                <!-- Recipient Name -->
                <div class="text-center mt-6">
                    <h2 class="text-3xl font-semibold text-gray-800" id="recipient-name">Recipient's Name</h2>
                    <p class="text-gray-600 mt-2 text-base">has attended</p>
                </div>
        
                <!-- Event Name -->
                <div class="text-center mt-4">
                    <input type="text" id="event-title" placeholder="Event Title"
                           class="block mx-auto text-center text-2xl font-medium text-gray-800">
                    <p class="text-gray-600 mt-2">organized by</p>
                    <input type="text" id="org-creator" placeholder="Org-Creator"
                           class="block mx-auto text-center text-xl font-medium text-gray-700">
                </div>
        
                <!-- Date and Venue -->
                <div class="text-center mt-6">
                    <p class="text-gray-600">Held on</p>
                    <input type="date" id="event-date" class="block mx-auto text-center text-lg font-medium text-gray-800">
                    <p class="text-gray-600 mt-2">at</p>
                    <input type="text" id="venue" placeholder="Venue" class="block mx-auto text-center text-lg font-medium text-gray-800">
                </div>
        
                <!-- Signature Section -->
                <div class="flex justify-between items-center mt-12">
                    <div class="text-center">
                        <p class="text-gray-600">_________________________</p>
                        <input type="text" id="signatory-one" placeholder="Signatory One"
                               class="block text-center text-gray-800 font-medium mt-1">
                        <input type="text" id="position-one" placeholder="Position"
                               class="block text-center text-gray-600 text-sm">
                    </div>
                    <div class="text-center">
                        <p class="text-gray-600">_________________________</p>
                        <input type="text" id="signatory-two" placeholder="Signatory Two"
                               class="block text-center text-gray-800 font-medium mt-1">
                        <input type="text" id="position-two" placeholder="Position"
                               class="block text-center text-gray-600 text-sm">
                    </div>
                </div>
        
                <!-- Background Image -->
                <div class="mt-8 text-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            onclick="document.getElementById('background-input').click()">Upload Background Image
                    </button>
                    <input id="background-input" type="file" accept="image/*" class="hidden"
                           onchange="setBackground(this)">
                </div>
        
                <!-- View Button -->
                <div class="text-center mt-4">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                            onclick="openModal()">View Certificate</button>
                </div>
        
                <!-- Footer -->
                <div class="text-center border-t-2 border-gray-200 pt-4 mt-8">
                    <p class="text-gray-500 text-sm">University of Makati</p>
                </div>
            </div>
        </div>
        
        <!-- Modal for Certificate Preview -->
        <div id="certificate-modal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg w-3/4">
                <div class="relative">
                    <div class="absolute top-4 left-4 flex gap-2">
                        <!-- Logos -->
                        <img src="path_to_your_logo_left1.png" alt="Logo 1" class="w-16 h-auto">
                        <img src="path_to_your_logo_left2.png" alt="Logo 2" class="w-16 h-auto">
                    </div>
                    <!-- Certificate Content (Static Text with Filled Inputs) -->
                    <h1 class="text-4xl font-bold text-gray-800 text-center">Certificate of Attendance</h1>
                    <p class="text-gray-600 mt-2 text-lg text-center">This certifies that</p>
                    <h2 class="text-3xl font-semibold text-gray-800 text-center" id="modal-recipient-name">Recipient's Name</h2>
                    <p class="text-gray-600 mt-2 text-base text-center">has attended</p>
                    <h3 class="text-2xl font-medium text-gray-800 text-center" id="modal-event-title">Event Title</h3>
                    <p class="text-gray-600 text-center">organized by</p>
                    <h4 class="text-xl font-medium text-gray-700 text-center" id="modal-org-creator">Org-Creator</h4>
        
                    <div class="text-center mt-6">
                        <p class="text-gray-600">Held on</p>
                        <p class="text-lg font-medium text-gray-800" id="modal-event-date">Event Date</p>
                        <p class="text-gray-600 mt-2">at</p>
                        <p class="text-lg font-medium text-gray-800" id="modal-venue">Venue</p>
                    </div>
        
                    <!-- Signature Section -->
                    <div class="flex justify-between items-center mt-12">
                        <div class="text-center">
                            <p class="text-gray-600">_________________________</p>
                            <p class="text-gray-800 font-medium mt-1" id="modal-signatory-one">Signatory One</p>
                            <p class="text-gray-600 text-sm" id="modal-position-one">Position</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-600">_________________________</p>
                            <p class="text-gray-800 font-medium mt-1" id="modal-signatory-two">Signatory Two</p>
                            <p class="text-gray-600 text-sm" id="modal-position-two">Position</p>
                        </div>
                    </div>
        
                    <!-- Footer -->
                    <div class="text-center border-t-2 border-gray-200 pt-4 mt-8">
                        <p class="text-gray-500 text-sm">University of Makati</p>
                    </div>
                </div>
                <button onclick="closeModal()" class="absolute top-2 right-2 text-white bg-red-500 px-4 py-2 rounded-lg">Close</button>
            </div>
        </div>
        
</div>

<script>
    function setBackground(input) {
        const container = document.getElementById('certificate-container');
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                container.style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    }

    function openModal() {
        // Populate the modal with the certificate data
        document.getElementById('modal-recipient-name').textContent = document.getElementById('recipient-name').value || 'Recipient\'s Name';
        document.getElementById('modal-event-title').textContent = document.getElementById('event-title').value || 'Event Title';
        document.getElementById('modal-org-creator').textContent = document.getElementById('org-creator').value || 'Org-Creator';
        document.getElementById('modal-event-date').textContent = document.getElementById('event-date').value || 'Event Date';
        document.getElementById('modal-venue').textContent = document.getElementById('venue').value || 'Venue';
        document.getElementById('modal-signatory-one').textContent = document.getElementById('signatory-one').value || 'Signatory One';
        document.getElementById('modal-position-one').textContent = document.getElementById('position-one').value || 'Position';
        document.getElementById('modal-signatory-two').textContent = document.getElementById('signatory-two').value || 'Signatory Two';
        document.getElementById('modal-position-two').textContent = document.getElementById('position-two').value || 'Position';

        // Show modal
        document.getElementById('certificate-modal').classList.remove('hidden');
    }

    function closeModal() {
        // Hide modal
        document.getElementById('certificate-modal').classList.add('hidden');
    }
</script>
</x-layout>