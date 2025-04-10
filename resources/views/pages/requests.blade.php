<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="p-6 border-b flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Request List</h2>
                    <p class="text-sm text-gray-500">View all submitted requests and dean approvals</p>
                </div>
            
                <div class="flex space-x-2">
                    <a href="{{ route('dean_rejected') }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-500 transition">
                        Rejected Requests
                    </a>
            
                    <a href="{{ route('dean_approve') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-500 transition">
                        Approved Requests
                    </a>
                </div>
            </div>
            
            

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100 text-left text-xs font-semibold uppercase text-gray-600">
                        <tr>
                            <th class="px-6 py-3">View</th>
                            <th class="px-6 py-3">Event Attachment Plan</th>
                            <th class="px-6 py-3">Request Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Dean Approval</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($requests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 border-b">
                                <button class="view-btn bg-blue-500 text-white px-4 py-2 rounded shadow-md hover:bg-blue-700" 
                                    data-name="{{ strtoupper($request->user->fname) }} {{ strtoupper($request->user->lname) }}"
                                    data-college="{{ $request->listing->title }}"
                                    data-venue="{{ $request->listing->venue }}"
                                    data-created="{{ $request->listing->created_at->format('F d, Y')}}"
                                    data-description="{{ $request->listing->description }}"
                                    data-date="{{ $request->listing->event_date }}"
                                    data-time="{{ $request->listing->event_time }}"
                                    data-tags="{{ $request->listing->tags }}"
                                    
                                    >
                                    View
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                @if ($request->listing && $request->listing->attachPlan)
                                    <a href="{{ asset('storage/' . $request->listing->attachPlan) }}" 
                                       target="_blank" 
                                       class="text-blue-600 hover:underline mr-4">
                                        View
                                    </a>
                                    <a href="{{ asset('storage/' . $request->listing->attachPlan) }}" 
                                       download 
                                       class="text-green-600 hover:underline">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">No File</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4">{{ $request->user->lname ?? 'N/A' }} {{ $request->user->fname ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $request->user->email ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $request->status ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('dean_approved', ['id' => $request->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-blue-500 hover:underline" type="submit">Approve</button>
                                </form>
                                <form action="{{ route('dean_reject', ['id' => $request->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button 
                                        type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-500 transition">
                                        Reject Request
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>

                <div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                    <div class="bg-white p-6 w-[900px] rounded-lg shadow-lg border border-gray-300 max-h-screen overflow-y-auto">
                        <div id="modalContent">
                            <div class="text-center">
                                <h2 class="text-xl font-bold">University Of Makati</h2>
                                
                                <p class="text-sm text-gray-600">JP Rizal Extn., West Rembo, Makati City, Metro Manila, 1215</p>
                            </div>
                
                            <hr class="border-gray-400 my-4">
                
                            <p class="text-right">Date: <strong id="modalCreated"></strong></p>
                
                            <p class="mt-4">To: <strong>University Facility Management Office</strong></p>
                            <p>Subject: <strong>Venue Reservation Request</strong></p>
                
                            <p class="mt-4">Dear :<strong> <span id="modalCollege"></strong> Dean </p>
                
                                <p class="mt-2 indent-8">
                                    I am writing to formally request permission to conduct an upcoming event organized by our organization. Below are the key details regarding the proposed activity:
                                </p>
                                
                
                            <p class="mt-2">Requested By: <strong><span id="modalName"></strong></span></p>
                           
                            <p>Event Title:<strong> <span id="modalTags"></strong></span></p>
                            <p>Venue:<strong> <span id="modalVenue"></strong></span></p>
                            <p>Date:<strong> <span id="modalEventDate"></strong></span></p>
                            <p>Time:<strong> <span id="modalTime"></strong</span></p>
                            <p class="mt-2">Event Description:</p>
                             <p id="modalDescription" class="italic"></p>
                
                            
                            
                           
                            <p> Approve by the Adviser:</p>
                            
                          
                
                           
                        </div>
                
                        <div class="flex justify-between mt-6">
                            <button id="printModal" class="bg-green-500 text-white px-6 py-2 rounded">Print</button>
                            <button id="closeModal" class="bg-red-500 text-white px-6 py-2 rounded">Close</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        function checkEmail(email) {
            fetch(`/requests/check-email/${email}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'exists') {
                        alert(`Dean Approval Found: ${data.dean.name}`);
                    } else {
                        alert('Dean Approval Not Found');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
        }
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
    @include('partials._footer')
</x-layout>
