<x-admin-layout>
    <!-- component -->
    <div class="max-w-[720px] mx-auto">
    
        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
           
        </div>

        <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between ">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Student Colleges Officers Lists</h3>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        <button id="addMemberBtn"
                            class="flex select-none items-center gap-2 rounded bg-slate-800 py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                stroke-width="2" class="w-4 h-4">
                                <path
                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                </path>
                            </svg>
                            Add member
                        </button>
                        <!-- Modal Trigger -->
                        <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-4">
                                <!-- Modal Form -->
                                <form id="searchEmailForm">
                                    @csrf
                                    <div class="p-6 space-y-4" id="modalContent">
                                        <!-- Search Email Input -->
                                        <div id="searchSection">
                                            <div class="bg-laravel px-6 py-3 rounded-t-2xl flex justify-center ">
                                                <label for="searchEmail" class="block bg-laravel  text-white font-medium mb-1">Search Email</label>
                                            </div>
                                            <input type="search" id="searchEmail" name="searchEmail" 
                                                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel" placeholder="Search email">
                                            @error('searchEmail')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    
                                        <!-- Submit Button (for search) -->
                                        <div class="flex justify-center">
                                            <button type="button" id="submitBtn" class="px-6 py-2 bg-laravel text-white rounded-lg shadow-md hover:underline transition ease-in-out duration-300">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                
                                <!-- Modal Footer -->
                                <div class="bg-laravel px-6 py-3 rounded-b-2xl flex justify-center  hover:underline">
                                    <button id="closeFooterBtn" class="text-white transition ease-in-out duration-300">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="p-0 overflow-scroll">
                <table class="w-full mt-4 text-left table-auto min-w-max">
                    <thead>
                        
                        <tr>
                            <th class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">Name</th>
                            <th class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">Organization</th>
                            <th class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">Status</th>
                            <th class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">Date Added</th>
                            <th class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100"></th>
                        </tr>
                    </thead>
                    <tbody id="memberTableBody">
                        @foreach($admin_users as $user)
                        <tr>
                            <td class="p-4 border-b border-slate-200">{{ $user->fname }} {{ $user->lname }}</td>
                            <td class="p-4 border-b border-slate-200">{{ $user->organization }}</td>
                            <td class="p-4 border-b border-slate-200">{{ $user->status }}</td>
                            <td class="p-4 border-b border-slate-200">{{ $user->created_at->format('m/d/Y') }}</td>
                            <td class="p-4 border-b border-slate-200">
                                
                                <button class="openDeleteModal relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-slate-900 transition-all hover:bg-slate-900/10 active:bg-slate-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button" data-user-id="{{ $user->id }}">
                                    <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-4 h-4">
                                            <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM18.54 4.46L17.1 3.02C16.71 2.63 16.08 2.63 15.69 3.02L14.25 4.46L15.19 5.4L16.63 3.96C16.72 3.87 16.89 3.87 16.98 3.96L18.42 5.4L19.36 4.46L18.54 3.64L17.1 5.08L15.69 3.68C15.29 3.28 14.66 3.28 14.26 3.68L13.25 4.69L14.19 5.63L15.63 4.19C15.73 4.09 15.89 4.09 15.98 4.19L17.42 5.63L18.36 4.69L17.94 4.17L16.5 5.61C16.4 5.71 16.22 5.71 16.12 5.61L14.68 4.17L13.74 5.11L15.18 6.55L16.62 5.11C16.72 5.01 16.89 5.01 16.98 5.11L18.42 6.55L19.36 5.61L18.54 4.79Z"></path>
                                        </svg>
                                    </span>
                                </button>
                            
                                <!-- Delete Modal -->
                                <div id="deleteModal-{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300">
                                    <div class="bg-white rounded-2xl shadow-xl w-96 transform transition-transform duration-300 scale-95">
                                        <div class="flex justify-between items-center bg-gradient-to-r bg-laravel px-6 py-4 rounded-t-2xl">
                                            <h2 class="text-lg font-bold text-white">Are you sure you want to remove {{ strtoupper($user->fname) }}?</h2>
                                            <button class="closeDeleteModalBtn text-white text-2xl hover:text-gray-200 transition ease-in-out duration-300">&times;</button>
                                        </div>
                            
                                        <!-- Modal Body -->
                                        <div class="p-6">
                                            <p class="text-gray-600">This action cannot be undone.</p>
                            
                                            <!-- Delete Confirmation Form -->
                                            <form action="{{ route('admin.admin_users.admin_adduser.destroy', $user->id) }}" method="POST" class="mt-4">
                                                @csrf
                                                @method('DELETE') <!-- Use DELETE method for deletion -->
                                                
                                                <!-- Buttons for Confirm and Cancel -->
                                                <div class="flex justify-between space-x-4">
                                                    <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 transition ease-in-out duration-300">
                                                        Yes, Delete
                                                    </button>
                            
                                                    <button type="button" class="closeDeleteModalBtn px-6 py-2 bg-gray-300 text-gray-700 rounded-lg shadow-md hover:bg-gray-400 transition ease-in-out duration-300">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                           
                            
            
             {{--------------delete end---------------------}}
                            </td>
                        </tr>
                    @endforeach
                        <!-- Data will be added dynamically here -->
                    </tbody>
                </table>
            </div>
        
            <div class="flex items-center justify-between p-3">
                <p class="block text-sm text-slate-500">Page 1 of 10</p>
                <div class="flex gap-1">
                    <button class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">Previous</button>
                    <button class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">Next</button>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('addMemberBtn').addEventListener('click', function() {
    document.getElementById('modal').classList.remove('hidden'); // Show the modal
});

// Close modal when Close Button is clicked
document.getElementById('closeFooterBtn').addEventListener('click', function() {
    document.getElementById('modal').classList.add('hidden'); // Hide the modal
});

// Close modal when clicking outside of it
window.addEventListener('click', function(event) {
    const modal = document.getElementById('modal');
    if (event.target == modal) {
        modal.classList.add('hidden'); // Hide the modal if clicked outside
    }
});

          document.getElementById('submitBtn').addEventListener('click', function() {
    const email = document.getElementById('searchEmail').value;

    fetch('{{ route('searchEmail') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ searchEmail: email })
    })
    .then(response => response.json())
    .then(data => {
        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = '';

        if (data.success) {
            const userDetails = `
                <div class="space-y-4">
                    <p><strong>Name:</strong> ${data.user.fname} ${data.user.lname}</p>
                    <p><strong>Organization:</strong> ${data.user.organization}</p>
                    <p><strong>Email:</strong> ${data.user.email}</p>
                    <p><strong>Status:</strong> ${data.user.status}</p>
                </div>
                <button id="addToTableBtn" class="px-6 py-2 bg-laravel text-white rounded-lg shadow-md hover:underline transition ease-in-out duration-300">Add to Table</button>
            `;
            modalContent.innerHTML = userDetails;

            // Add to Table Button
            document.getElementById('addToTableBtn').addEventListener('click', function() {
                addRowToTable(data.user);

                // Hide the modal after adding the row
                document.getElementById('modal').classList.add('hidden');
            });
        } else {
            const errorMessage = `<div class="text-red-500 text-center p-4"><p>${data.message}</p></div>`;
            modalContent.innerHTML = errorMessage;
        }
    })
    .catch(error => console.error('Error:', error));
});

        
            // Call the fetchAdminUsers function when the page loads to populate the table with existing users
            document.addEventListener('DOMContentLoaded', fetchAdminUsers);

            // Function to display a new row in the table
function addRowToTable(userData) {
    const tableBody = document.getElementById('memberTableBody');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td class="p-4 border-b border-slate-200">${userData.fname} ${userData.lname}</td>
        <td class="p-4 border-b border-slate-200">${userData.organization}</td>
        <td class="p-4 border-b border-slate-200">${userData.status}</td>
        <td class="p-4 border-b border-slate-200">${new Date().toLocaleDateString()}</td>
        <td class="p-4 border-b border-slate-200">
            <button class="text-red-600" onclick="deleteRow(this)">Delete</button>
        </td>
    `;
    tableBody.appendChild(newRow);

    // Send the new user data to the server to save in the database
    saveUserToDatabase(userData);
}

// Function to save user data into the admin_users table
function saveUserToDatabase(userData) {
    fetch('{{ route('addAdminUser') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify(userData)
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Failed to save user to database:', data.message);
        }
    })
    .catch(error => console.error('Error saving user to database:', error));
}

// Open the delete confirmation modal
document.querySelectorAll('.openDeleteModal').forEach(function(button) {
    button.addEventListener('click', function() {
        var modal = document.getElementById('deleteModal-' + this.getAttribute('data-user-id'));
        modal.classList.remove('hidden');
        modal.classList.add('block');
    });
});

// Close the delete confirmation modal
document.querySelectorAll('.closeDeleteModalBtn').forEach(function(button) {
    button.addEventListener('click', function() {
        var modal = this.closest('.fixed');
        modal.classList.remove('block');
        modal.classList.add('hidden');
    });
});

        </script>
        
        
    </div>
</x-admin-layout>
