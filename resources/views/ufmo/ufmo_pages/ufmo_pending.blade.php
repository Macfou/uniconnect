<x-ufmo-layout>
    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
            <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                <li class="flex items-center text-blue-gray-900 text-sm font-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                    <a href="#" class="text-blue-900 opacity-50 hover:text-blue-500">UFMO</a>
                    <span class="text-gray-500 mx-2">/</span>
                </li>
                <li class="text-blue-900 text-base font-semibold">Pending Requests</li>
            </ol>
        </nav>
    </div>

    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Pending Requests</h3>

        <table class="w-full text-left table-auto border border-slate-200 rounded-lg">
            <thead class="bg-slate-50">
                <tr>
                    <th class="p-4 border-b">Request date</th>
                    <th class="p-4 border-b">Name</th>
                    <th class="p-4 border-b">For Approval</th>
                   
                    <th class="p-4 border-b">College</th>
                    <th class="p-4 border-b">Venue</th>
                    <th class="p-4 border-b">View</th>
                    <th class="p-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingEvents as $event)
                    <tr class="hover:bg-slate-100">
                        <td class="p-4 border-b">{{ $event->created_at }}</td>
                        <td class="p-4 border-b">{{ strtoupper($event->user->fname) }} {{ strtoupper($event->user->lname) }}</td>
                        <td class="p-4 border-b">
                            <a href="{{ route('ufmo.approval', ['id' => $event->id]) }}">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                    View Approval Status
                                </button>
                            </a>
                        </td>
                        
                        
                      
                        
                        <td class="p-4 border-b">{{ $event->title }}</td>
                        <td class="p-4 border-b">{{ $event->venue }}</td>
                        <td class="p-4 border-b">
                            <button class="view-btn bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-700" 
                                data-name="{{ strtoupper($event->user->fname) }} {{ strtoupper($event->user->lname) }}"
                                data-college="{{ $event->title }}"
                                data-venue="{{ $event->venue }}"
                                data-created="{{ $event->created_at->format('F d, Y')}}"
                                data-description="{{ $event->description }}"
                                data-date="{{ $event->event_date }}"
                                data-time="{{ $event->event_time }}"
                                data-tags="{{ $event->tags }}"
                                data-gsoApproval="{{ $event->gsoApproval}}"
                                data-deanApproval="{{ $event->deanApproval}}"
                                data-uscApproval="{{ $event->uscApproval}}"
                                data-permitTransfer="{{ $event->permitTransfer}}"
                                data-PermitInOut="{{ $event->PermitInOut}}"
                                >
                                View
                            </button>
                        </td>
                        <td class="p-4 border-b flex space-x-2">
                            <form action="{{ route('ufmo_approved', ['id' => $event->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="text-blue-500 hover:underline" type="submit">Approve</button>
                            </form>
                            <button class="reject-btn text-red-500 hover:underline" data-event-id="{{ $event->id }}">
                                Reject
                            </button>
                            
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  <!-- Modal -->
<div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 w-[900px] rounded-lg shadow-lg border border-gray-300 max-h-screen overflow-y-auto">
        <div id="modalContent">
            <div class="text-center">
                <h2 class="text-xl font-bold">University Of Makati</h2>
                <p class="text-sm text-gray-600">University Facility Management Office</p>
                <p class="text-sm text-gray-600">JP Rizal Extn., West Rembo, Makati City, Metro Manila, 1215</p>
            </div>

            <hr class="border-gray-400 my-4">

            <p class="text-right">Date: <strong id="modalCreated"></strong></p>

            <p class="mt-4">To: <strong>University Facility Management Office</strong></p>
            <p>Subject: <strong>Venue Reservation Request</strong></p>

            <p class="mt-4">Dear University Facility Management Office,</p>

            <p class="mt-2 indent-8">
                I am writing to formally request a reservation for a venue to hold our upcoming event. Below are the details of our request:
            </p>

            <p class="mt-2">Requested By: <strong><span id="modalName"></strong></span></p>
            <p>College:<strong> <span id="modalCollege"></strong></span></p>
            <p>Event Title:<strong> <span id="modalTags"></strong></span></p>
            <p>Venue:<strong> <span id="modalVenue"></strong></span></p>
            <p>Date:<strong> <span id="modalEventDate"></strong></span></p>
            <p>Time:<strong> <span id="modalTime"></strong</span></p>
            <p class="mt-2">Event Description:</p>
             <p id="modalDescription" class="italic"></p>

           
          

           
        </div>

        <div class="flex justify-between mt-6">
            <button id="printModal" class="bg-green-500 text-white px-6 py-2 rounded">Print</button>
            <button id="closeModal" class="bg-red-500 text-white px-6 py-2 rounded">Close</button>
        </div>
    </div>
</div>

<!-- reject Modal------>
<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-md shadow-lg w-1/3">
        <h2 class="text-lg font-semibold mb-4">Reject Event</h2>

        <form id="rejectForm" action="" method="POST">
            @csrf
            @method('PATCH')

            <input type="hidden" name="event_id" id="rejectEventId">

            <label for="rejection_reason" class="block font-semibold mb-1">Reason for Rejection:</label>
            <textarea name="rejection_reason" id="rejectionReason" rows="3"
                class="w-full p-2 border rounded-md" required></textarea>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" id="closeRejectModal" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Cancel
                </button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>


<script>
   document.addEventListener("DOMContentLoaded", function () {
    const rejectModal = document.getElementById("rejectModal");
    const rejectForm = document.getElementById("rejectForm");
    const rejectEventId = document.getElementById("rejectEventId");
    const rejectReasonInput = document.getElementById("rejectionReason");

    // Select all reject buttons
    document.querySelectorAll(".reject-btn").forEach(button => {
        button.addEventListener("click", function () {
            const eventId = this.dataset.eventId; // Get event ID from button
            rejectForm.action = `/ufmo/requests/rejected/${eventId}`; // Update form action
            rejectEventId.value = eventId; // Set event ID in hidden input

            // Show the modal
            rejectModal.classList.remove("hidden");
        });
    });

    // Close Modal
    document.getElementById("closeRejectModal").addEventListener("click", function () {
        rejectModal.classList.add("hidden");
    });
});

    </script>
    
    
    
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("eventModal");
        const closeModal = document.getElementById("closeModal");
        const printModal = document.getElementById("printModal");
        const viewButtons = document.querySelectorAll(".view-btn");
    
        // Modal Fields
        const modalFields = {
            name: document.getElementById("modalName"),
            college: document.getElementById("modalCollege"),
            venue: document.getElementById("modalVenue"),
            created: document.getElementById("modalCreated"),
            date: document.getElementById("modalEventDate"),
            tags: document.getElementById("modalTags"),
            description: document.getElementById("modalDescription"),
            time: document.getElementById("modalTime"),
            
        };
    
        // Function to open modal and set values
        function openModal(event) {
            const button = event.currentTarget;
    
            // Set modal fields
            modalFields.name.textContent = button.dataset.name || "";
            modalFields.college.textContent = (button.dataset.college || "").toUpperCase();
            modalFields.venue.textContent = button.dataset.venue || "";
            modalFields.created.textContent = button.dataset.created || "";
            modalFields.tags.textContent = button.dataset.tags || "";
            modalFields.description.textContent = button.dataset.description || "";
            modalFields.time.textContent = button.dataset.time || "";
    
            // Format Date as "March 29, 2024"
            const eventDate = new Date(button.dataset.date);
            modalFields.date.textContent = eventDate.toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric"
            });
    
            // Show modal
            modal.classList.remove("hidden");
        }
    
        // Attach event listeners to all view buttons
        viewButtons.forEach(button => button.addEventListener("click", openModal));
    
        // Close modal on button click
        closeModal.addEventListener("click", () => modal.classList.add("hidden"));
    
        // Print modal content
        printModal.addEventListener("click", function () {
            const printContent = document.getElementById("modalContent").innerHTML;
            const newWindow = window.open("", "", "width=800,height=800");
            newWindow.document.write(`<html><head><title>Print</title></head><body>${printContent}</body></html>`);
            newWindow.document.close();
            newWindow.print();
        });
    });
    </script>
    

</x-ufmo-layout>
