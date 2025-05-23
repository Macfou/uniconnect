<x-layout>
<style>
    /* Scanning line animation */
    @keyframes scanningMove {
        0% {
            top: 0;
        }
        100% {
            top: 100%;
        }
    }

    /* Pulse effect for the square border */
    .relative .border-4 {
        animation: pulse-border 1.5s infinite;
    }

    @keyframes pulse-border {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
        100% {
            opacity: 1;
        }
    }
</style>
@include('partials._myevents')

<!-- Profile Card -->
<div class="pt-28 pb-20">
    <div class="max-w-[800px] mx-auto sticky p-4 rounded-lg bg-white shadow-lg">
        <!-- First div -->
        <div class="md:col-span-1 bg-white shadow-lg h-64 rounded-lg overflow-hidden">
            <img class="w-full h-full object-cover" 
                 src="{{ $listing->image ? asset('storage/' . $listing->image) : asset('/images/no-image.png') }}" 
                 alt="Event Image" />
        </div>

        <!-- Event details -->
        <div class="md:col-span-3 bg-white shadow-xl p-4 space-y-2 p-3 rounded-lg mt-6">
            <p>What: <strong>{{$listing->tags}}</strong></p>
            <p>Where: <strong>{{$listing->venue}}</strong></p>
            <p>When: <strong>{{$listing->event_time}}</strong></p>
            <p>For:  <x-listing-organizations :organizationsCsv="$listing->organization" /> </p> 
            <h1 class="font-bold text-lg text-gray-600"></h1>
            <h1 class="text-lg text-gray-600 text-justify pt-2">{{$listing->description}}</h1>
        </div>

        <!-- Flex container to align left and right divs -->
        <div class="flex mt-6 space-x-4">
            <!-- Right side (60% width with form) -->
            <div class="w-3/5">
                <form>
                    <input type="hidden" id="listing_id" value="{{ $listing->id }}">
                    <div class="mb-4 flex space-x-4">
                        <button type="button" id="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Scan student QR
                        </button> 
                        
                        <button type="button" id="openSearchModal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Search ID Number
                        </button>
                        
                        <a href="{{ route('attendance.show', $listing->id) }}" class="pt-2 pb-2 pl-4 pr-4 text-white text-center font-medium bg-laravel rounded-lg hover:underline">
                            Show Attendance
                        </a>
                    </div>

                    <a href="{{ route('end.event', $listing->id) }}" 
                        class="pt-2 pb-2 pl-4 pr-4 text-white text-center font-medium bg-laravel rounded-lg hover:underline">
                        End Event
                    </a>

                    <!--------------QR Scanner Modal-------------->
                    <div id="qrModalscanner" class="fixed z-10 inset-0 flex items-center justify-center p-4 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full">
                                <div class="px-4 py-2">
                                    <h3 class="text-xl font-bold mb-4">Scan QR Code</h3>
                                    <hr class="border-black px-4">
                                    
                                    <div class="relative w-full h-[300px]">
                                        <!-- Video element to display the camera stream -->
                                        <video id="cameraStream" class="w-full h-full object-cover" autoplay playsinline></video>
                                        
                                        <!-- Overlay with square to guide QR positioning -->
                                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                            <div class="border-4 border-green-500 rounded-md w-1/2 h-1/2 relative">
                                                <!-- Scanning line that moves up and down -->
                                                <div id="scanningLine" class="absolute top-0 left-0 w-full h-1 bg-red-500"></div> 
                                            </div>
                                        </div>
                                    </div>
                    
                                    <!-- Div to display the scanned QR code result -->
                                    <p id="qrResult" class="mt-4 text-lg font-bold text-green-600"></p>
                    
                                    <button id="submitAttendance" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 hidden">
                                        Submit Attendance
                                    </button>
                                    <!-- Warning message -->
                                    <p id="qrWarning" class="mt-4 text-lg font-bold text-red-600 hidden">Cannot scan the QR code. Please try again.</p>
                                </div>
                                <div class="px-4 py-2 flex justify-end">
                                    <button id="closeModalscanner" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-------------Search ID Modal---------------->
                    <div id="searchModal" class="fixed z-10 inset-0 flex items-center justify-center p-4 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen">
                            <div id="searchModalContent" class="bg-white rounded-lg shadow-lg max-w-lg w-full">
                                <div class="px-4 py-2">
                                    <h3 class="text-xl font-bold mb-4">Search Student by ID Number</h3>
                                    <hr class="border-black px-4 mb-4">
                                    
                                    <div class="mb-4">
                                        <label for="studentIdInput" class="block text-gray-700 text-sm font-bold mb-2">Student ID Number:</label>
                                        <input type="text" id="studentIdInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter ID number">
                                    </div>
                                    
                                    <button id="searchStudentBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                                        Search
                                    </button>
                                    
                                    <!-- Div to display the search result -->
                                    <div id="searchResult" class="mt-4 p-4 border rounded hidden"></div>
                                    
                                    <button id="submitSearchAttendance" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4 hidden">
                                        Submit Attendance
                                    </button>
                                </div>
                                <div class="px-4 py-2 flex justify-end">
                                    <button id="closeSearchModal" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
// QR Scanner Variables
const openModalButton = document.getElementById('openModal');
const closeModalButton = document.getElementById('closeModalscanner');
const qrModal = document.getElementById('qrModalscanner');
const videoElement = document.getElementById('cameraStream');
const qrResultElement = document.getElementById('qrResult');
const qrWarningElement = document.getElementById('qrWarning');
const scanningLine = document.getElementById('scanningLine');
const submitAttendanceButton = document.getElementById('submitAttendance');
let scanning = false;
let stream = null;
let timeoutId = null;
let studentId = null; // Store the scanned student ID

// Search Modal Variables
const openSearchModalButton = document.getElementById('openSearchModal');
const closeSearchModalButton = document.getElementById('closeSearchModal');
const searchModal = document.getElementById('searchModal');
const searchModalContent = document.getElementById('searchModalContent');
const searchStudentBtn = document.getElementById('searchStudentBtn');
const studentIdInput = document.getElementById('studentIdInput');
const searchResultElement = document.getElementById('searchResult');
const submitSearchAttendanceButton = document.getElementById('submitSearchAttendance');
let searchedStudentId = null;

// Open the QR Scanner Modal
openModalButton.addEventListener('click', function () {
    qrModal.classList.remove('hidden');
    scanningLineAnimation(); // Start scanning line animation

    // Access the user's camera
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
            .then(function (videoStream) {
                videoElement.srcObject = videoStream;
                stream = videoStream;
                scanning = true;
                scanQRCode(); // Start scanning
                timeoutId = setTimeout(() => {
                    if (scanning) qrWarningElement.classList.remove('hidden'); // Show warning if QR not found
                }, 10000); // 10 seconds
            })
            .catch(function (error) {
                console.error('Error accessing camera:', error);
                qrWarningElement.textContent = 'Error accessing camera. Please check permissions.';
                qrWarningElement.classList.remove('hidden');
            });
    } else {
        alert('Camera access is not supported by your browser.');
    }
});

// Close the QR Scanner Modal
closeModalButton.addEventListener('click', function () {
    qrModal.classList.add('hidden');
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    videoElement.srcObject = null;
    scanning = false;
    qrResultElement.textContent = '';
    qrWarningElement.classList.add('hidden');
    submitAttendanceButton.classList.add('hidden');
    clearTimeout(timeoutId);
});

// Function to scan the QR code
function scanQRCode() {
    if (!scanning || videoElement.videoWidth === 0 || videoElement.videoHeight === 0) {
        requestAnimationFrame(scanQRCode);
        return;
    }

    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    canvas.width = videoElement.videoWidth;
    canvas.height = videoElement.videoHeight;
    context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    const qrCode = jsQR(imageData.data, imageData.width, imageData.height);

    if (qrCode) {
        // Store the student ID from the scanned QR code
        studentId = qrCode.data;
        qrResultElement.innerHTML = `Student ID: ${studentId}<br>Searching for student...`;
        qrWarningElement.classList.add('hidden');  // Hide warning if successful

        // Fetch student data based on the scanned student ID
        fetch(`/search-student`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                idnumber: studentId  // Send scanned student ID (idnumber)
            })
        })
        .then(response => {
            // Check if the response is OK
            if (!response.ok) {
                throw new Error('Student not found');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Create HTML with proper image tag for the photo
                qrResultElement.innerHTML = `
                    <div class="text-center">
                        <p class="mb-2">Student ID: ${studentId}</p>
                        <p class="mb-2">Name: ${data.student.fname} ${data.student.lname}</p>
                        <p class="mb-2">College: ${data.student.org}</p>
                        <div class="mt-3">
                            <img src="/storage/${data.student.photo}" class="w-32 h-32 object-cover mx-auto rounded-full border-2 border-gray-300" alt="Student Photo">
                        </div>
                    </div>`;
            } else {
                qrResultElement.innerHTML = `Student ID: ${studentId}<br>Student not found.`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            qrResultElement.innerHTML = `Student ID: ${studentId}<br>Unregistered student`;
        });

        // Show the submit button once a QR code is scanned
        submitAttendanceButton.classList.remove('hidden');
        scanning = false;  // Stop scanning after detecting a QR code
        clearTimeout(timeoutId);
    } else {
        requestAnimationFrame(scanQRCode);  // Continue scanning if no QR code detected
    }
}

// Scanning line animation
function scanningLineAnimation() {
    scanningLine.style.animation = 'scanningMove 2s infinite linear';
}

function resetScanner() {
    qrResultElement.textContent = '';
    submitAttendanceButton.classList.add('hidden');
    scanning = true;
    scanQRCode();
}

// Submit attendance button action (QR Scanner)
submitAttendanceButton.addEventListener('click', function () {
    const eventId = document.getElementById('listing_id').value;

    if (studentId) {
        fetch('/submit-attendance', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                student_id: studentId,
                event_id: eventId // Include event ID
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Attendance submitted successfully!');
                qrModal.classList.add('hidden'); // Close the modal after successful submission
                
                // Stop camera stream
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
                videoElement.srcObject = null;
                scanning = false;
                qrResultElement.textContent = '';
                submitAttendanceButton.classList.add('hidden');
            } else {
                alert('Failed to submit attendance: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting attendance.');
        });
    } else {
        alert('No student scanned.');
    }
});

// ----- Search ID Modal Functions -----

// Open the Search Modal
openSearchModalButton.addEventListener('click', function () {
    searchModal.classList.remove('hidden');
    // Clear previous search results
    searchResultElement.classList.add('hidden');
    searchResultElement.innerHTML = '';
    studentIdInput.value = '';
    submitSearchAttendanceButton.classList.add('hidden');
    searchedStudentId = null;
});

// Close the Search Modal - only when close button is clicked
closeSearchModalButton.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    searchModal.classList.add('hidden');
    searchedStudentId = null;
    // Clear the search results when closing
    searchResultElement.classList.add('hidden');
    searchResultElement.innerHTML = '';
    studentIdInput.value = '';
    submitSearchAttendanceButton.classList.add('hidden');
});

// Prevent modal from closing when clicking inside the modal content
searchModalContent.addEventListener('click', function(e) {
    e.stopPropagation();
});

// Prevent modal from closing when clicking on the modal backdrop
searchModal.addEventListener('click', function(e) {
    // Only close if the click is directly on the modal backdrop, not on its children
    if (e.target === searchModal) {
        // Don't close the modal automatically
        e.stopPropagation();
    }
});

// Search for student by ID
searchStudentBtn.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    const idNumber = studentIdInput.value.trim();
    
    if (!idNumber) {
        alert('Please enter a student ID number');
        return;
    }
    
    // Store the entered student ID
    searchedStudentId = idNumber;
    
    // Show loading state
    searchResultElement.classList.remove('hidden');
    searchResultElement.innerHTML = '<p class="text-center">Searching...</p>';
    
    // Fetch student data based on the entered ID
    fetch(`/search-student`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            idnumber: idNumber
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Student not found');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update the modal to show the student's details with photo
            searchResultElement.innerHTML = `
                <div class="text-center">
                    <p class="mb-2"><strong>Student ID:</strong> ${idNumber}</p>
                    <p class="mb-2"><strong>Name:</strong> ${data.student.fname} ${data.student.lname}</p>
                    <p class="mb-2"><strong>College:</strong> ${data.student.org}</p>
                    <div class="mt-3">
                        <img src="/storage/${data.student.photo}" class="w-32 h-32 object-cover mx-auto rounded-full border-2 border-gray-300" alt="Student Photo">
                    </div>
                </div>`;
            
            // Show the submit button once a student is found
            submitSearchAttendanceButton.classList.remove('hidden');
        } else {
            searchResultElement.innerHTML = `<p class="text-center text-red-500">Student with ID ${idNumber} not found.</p>`;
            submitSearchAttendanceButton.classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        searchResultElement.innerHTML = `<p class="text-center text-red-500">Unregistered student or error searching for ID: ${idNumber}</p>`;
        submitSearchAttendanceButton.classList.add('hidden');
    });
});

// Submit attendance from search modal
submitSearchAttendanceButton.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    const eventId = document.getElementById('listing_id').value;
    
    if (searchedStudentId) {
        fetch('/submit-attendance', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                student_id: searchedStudentId,
                event_id: eventId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Attendance submitted successfully!');
                
                // Close the modal after successful submission
                searchModal.classList.add('hidden');
                
                // Reset search-related variables
                searchedStudentId = null;
                studentIdInput.value = '';
                searchResultElement.classList.add('hidden');
                searchResultElement.innerHTML = '';
                submitSearchAttendanceButton.classList.add('hidden');
            } else {
                alert('Failed to submit attendance: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting attendance.');
        });
    } else {
        alert('No student ID entered.');
    }
});

// Allow Enter key to trigger search
studentIdInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        searchStudentBtn.click();
    }
});

});
</script>
</x-layout>
@include('partials._footer')