<x-layout>
    @include('partials._myevents')
     <!-- Dropdown Section -->
    
     <div class="max-w-[750px] mx-auto position:sticky pt-20 pb-44">
         <div class="relative flex flex-col h-full text-slate-700 bg-white shadow-md rounded-xl">
            <div class="flex justify-between items-center mx-4 mt-4">
                <!-- Dropdown Button -->
                <div class="relative inline-block text-left group">
                    <div class="inline-flex items-center cursor-pointer">
                        <h3 class="text-lg font-semibold text-slate-800">Year Level</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1 text-slate-800" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
            
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block z-10">
                        <div class="py-1">
                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('firstYear')">1st Year</a>
                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('secondYear')">2nd Year</a>
                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('thirdYear')">3rd Year</a>
                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('fourthYear')">4th Year</a>
                        </div>
                    </div>
                </div>
            
                <!-- Add Officer Button -->
                <button id="addOfficerBtn" class="bg-laravel hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Officer
                </button>
            </div>

            <!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-4">
        
        <!-- Modal Form -->
        <form id="searchEmailForm">
            @csrf
           
            <div class="p-6 space-y-4" id="modalContent">
                <!-- Search Email Input -->
                <div id="searchSection">
                    <div class="bg-laravel px-6 py-3 rounded-t-2xl flex justify-center ">
                        <label for="searchEmail" class="block bg-laravel text-white font-medium mb-1">Search Email</label>
                    </div>
                    <input type="search" id="searchEmail" name="searchEmail"
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel" placeholder="Search email">
                    @error('searchEmail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button (for search) -->
                <div class="flex justify-center">
                    <button type="button" id="submitBtn"
                        class="px-6 py-2 bg-laravel text-white rounded-lg shadow-md hover:underline transition ease-in-out duration-300">
                        Search
                    </button>
                </div>
            </div>
        </form>

        <!-- Modal Footer -->
        <div class="bg-laravel px-6 py-3 rounded-b-2xl flex justify-center hover:underline">
            <button id="closeFooterBtn" class="text-white transition ease-in-out duration-300">Close</button>
        </div>
    </div>
</div>

            
 
             <!-- First Year -->
             <section id="firstYear" style="display: none;">
                 <p class="pl-4 font-bold">1st Year</p>
                 <div class="p-0 overflow-scroll">
                     <table class="w-full mt-4 text-left table-auto min-w-max">
                         <thead>
                             <tr>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Section</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Name</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Email</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            
                                 <tr>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200">
                                    
                                         <form method="POST" action="" class="inline">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Delete</button>
                                         </form>
                                     </td>
                                 </tr>
                            
                         </tbody>
                     </table>
                 </div>
             </section>
 
             <!-- Second Year -->
             <section id="secondYear">
                 <p class="pl-4 font-bold">2nd Year</p>
                 <div class="p-0 overflow-scroll">
                     <table class="w-full mt-4 text-left table-auto min-w-max">
                         <thead>
                             <tr>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Section</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Name</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Email</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             
                                 <tr>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200">
                                        
                                         <form method="POST" action="" class="inline">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Delete</button>
                                         </form>
                                     </td>
                                 </tr>
                            
                         </tbody>
                     </table>
                 </div>
             </section>
 
             <!-- Third Year -->
             <section id="thirdYear" style="display: none;">
                 <p class="pl-4 font-bold">3rd Year</p>
                 <div class="p-0 overflow-scroll">
                     <table class="w-full mt-4 text-left table-auto min-w-max">
                         <thead>
                             <tr>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Section</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Name</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Email</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            
                                 <tr>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200"></td>
                                     <td class="p-4 border-b border-slate-200">
                                         
                                         <form method="POST" action="" class="inline">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Delete</button>
                                         </form>
                                     </td>
                                 </tr>
                            
                         </tbody>
                     </table>
                 </div>
             </section>

                <!-- Fourth Year -->
                <section id="fourthYear" style="display: none;">
                    <p class="pl-4 font-bold">4th Year</p>
                    <div class="p-0 overflow-scroll">
                        <table class="w-full mt-4 text-left table-auto min-w-max">
                            <thead>
                                <tr>
                                    <th class="p-4 border-y border-slate-200 bg-slate-50">Section</th>
                                    <th class="p-4 border-y border-slate-200 bg-slate-50">Name</th>
                                    <th class="p-4 border-y border-slate-200 bg-slate-50">Email</th>
                                    <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    <tr>
                                        <td class="p-4 border-b border-slate-200"></td>
                                        <td class="p-4 border-b border-slate-200"></td>
                                        <td class="p-4 border-b border-slate-200"></td>
                                        <td class="p-4 border-b border-slate-200">
                                           
                                            <form method="POST" action="" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
         </div>
     </div>
 
     <script>
         function showSection(sectionId) {
             // Hide all sections
             document.getElementById('firstYear').style.display = 'none';
             document.getElementById('secondYear').style.display = 'none';
             document.getElementById('thirdYear').style.display = 'none';
             document.getElementById('fourthYear').style.display = 'none';
             
             // Show the selected section
             document.getElementById(sectionId).style.display = 'block';
         }

          // Get button and modal elements
    const addOfficerBtn = document.getElementById('addOfficerBtn');
    const modal = document.getElementById('modal');
    const closeFooterBtn = document.getElementById('closeFooterBtn');

    // Show modal when "Add Officer" button is clicked
    addOfficerBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Hide modal when "Close" button is clicked
    closeFooterBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    document.getElementById('submitBtn').addEventListener('click', function() {
    const searchEmail = document.getElementById('searchEmail').value;

    // Fetch the user details by email
    fetch(`/search-user?email=${searchEmail}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = '';

        if (data.success) {
            const userDetails = `
                <div class="space-y-4">
                    <p><strong>Name:</strong> ${data.user.fname} ${data.user.lname}</p>
                    <p><strong>Section:</strong> ${data.user.section}</p>
                    <p><strong>Email:</strong> ${data.user.email}</p>
                    <p><strong>Status:</strong> ${data.user.status}</p>
                    <p><strong>Year level:</strong> ${data.user.yearlevel}</p>
                </div>
                <button id="addToTableBtn" class="px-6 py-2 bg-laravel text-white rounded-lg shadow-md hover:underline transition ease-in-out duration-300">Add Officer</button>
            `;
            modalContent.innerHTML = userDetails;

            // Add officer to database when 'Add Officer' button is clicked
            document.getElementById('addToTableBtn').addEventListener('click', function() {
    // Log user details before adding to the database
    console.log('User Details:', {
        fname: data.user.fname,
        lname: data.user.lname,
        section: data.user.section,
        email: data.user.email,
        yearlevel: data.user.yearlevel // Log yearlevel too
    });

    // Convert yearlevel to integer
    const yearLevel = data.user.yearlevel ? parseInt(data.user.yearlevel) : null;

    // Log the value for debugging
    console.log('Year Level:', yearLevel);

    fetch('/add-officer', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            fname: data.user.fname,
            lname: data.user.lname,
            section: data.user.section,
            email: data.user.email,
            yearlevel: data.user.yearlevel
        })
    })
    .then(response => response.json())
    .then(result => {
        console.log('Server response:', result);
        if (result.success) {
            alert('Officer added successfully!');
            document.getElementById('modal').classList.add('hidden');
        } else {
            alert('Error adding officer: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Fetch request failed:', error);
        alert('Error sending request: ' + error);
    });
});



        } else {
            const errorMessage = `<div class="text-red-500 text-center p-4"><p>${data.message}</p></div>`;
            modalContent.innerHTML = errorMessage;
        }
    })
    .catch(error => console.error('Error:', error));
});

////////////////





     </script>
 </x-layout>

 @include('partials._footer')
 