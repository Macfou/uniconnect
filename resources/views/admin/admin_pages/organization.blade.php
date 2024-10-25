<x-admin-layout>
    <div class="max-w-[720px] mx-auto">
      
        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <a target='_blank' href='https://www.material-tailwind.com/docs/html/table' class='block w-full px-4 py-2 text-center text-slate-700 transition-all '>
                    More components on <b>Material Tailwind</b>.
                </a>
        </div>
    
        <div class="relative flex flex-col w-full h-full text-slate-700 bg-white mx-w-lg shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between ">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Academic  Organizations</h3>
                       
                    </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    
                    <button id="openModalBtn"
                    class="flex select-none items-center gap-2 rounded bg-laravel py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        stroke-width="2" class="w-4 h-4">
                        <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                        </path>
                    </svg>
                    Add Organization
                    </button>
                </div>
                </div>
            
            </div>
            <div class="p-0 overflow-scroll">
                <table class="w-full mt-4 text-left  table-auto min-w-max">
                <thead>
                    <tr>
                    <th
                        class="p-4 transition-colors no-sort-arrow cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center  justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Organization
                        </p>
                    </th>
                   
                    <th
                        class="p-4 transition-colors n0-sort-arrow cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center  justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Name
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Date Added
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        </p>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organizations ?? [] as $organization)
                        <tr>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex z-10 items-center gap-3">
                                    <img  src="{{ asset('storage/' . $organization->orgLogo) }}"
                                         alt="{{ strtoupper($organization->orgNameAbbv) }}" class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                    <div class="flex flex-col">
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ strtoupper($organization->orgNameAbbv) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="w-max">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ ucwords(strtolower($organization->orgName)) }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="text-sm text-slate-500">
                                    {{ $organization->created_at->format('d/m/Y') }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                               
                                <!-- Single button for each organization to open modal -->
                                <button class="openeditModal relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-slate-900 transition-all hover:bg-slate-900/10 active:bg-slate-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-org-id="{{ $organization->id }}">
                                    <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-4 h-4">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"></path>
                                        </svg>
                                    </span>
                                </button>
                           <!-- delete -->
                     <!-- Delete Button -->
                     <button class="openDeleteModal relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-slate-900 transition-all hover:bg-slate-900/10 active:bg-slate-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                     type="button" data-org-id="{{ $organization->id }}">
                 <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-4 h-4">
                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM18.54 4.46L17.1 3.02C16.71 2.63 16.08 2.63 15.69 3.02L14.25 4.46L15.19 5.4L16.63 3.96C16.72 3.87 16.89 3.87 16.98 3.96L18.42 5.4L19.36 4.46L18.54 3.64L17.1 5.08L15.69 3.68C15.29 3.28 14.66 3.28 14.26 3.68L13.25 4.69L14.19 5.63L15.63 4.19C15.73 4.09 15.89 4.09 15.98 4.19L17.42 5.63L18.36 4.69L17.94 4.17L16.5 5.61C16.4 5.71 16.22 5.71 16.12 5.61L14.68 4.17L13.74 5.11L15.18 6.55L16.62 5.11C16.72 5.01 16.89 5.01 16.98 5.11L18.42 6.55L19.36 5.61L18.54 4.79Z"></path>
                    </svg>
                 </span>
             </button>
             

{{---------------------delete modal-------------------------------}}
<!-- Delete Confirmation Modal -->
<!-- Delete Confirmation Modal -->
<div id="deleteModal-{{ $organization->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-96 transform transition-transform duration-300 scale-95">
        <div class="flex justify-between items-center bg-gradient-to-r bg-laravel px-6 py-4 rounded-t-2xl">
            <h2 class="text-lg font-bold text-white">Are you sure you want to delete  {{ strtoupper($organization->orgNameAbbv) }}?</h2>
            <button class="closeDeleteModalBtn text-white text-2xl hover:text-gray-200 transition ease-in-out duration-300">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <p class="text-gray-600">This action cannot be undone.</p>

            <!-- Delete Confirmation Form -->
            <form action="{{ route('admin.admin_pages.organization.destroy', $organization->id) }}" method="POST" class="mt-4">
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


                                
                            
                                <!-- Modal structure for each organization (hidden by default) -->
                                <div id="editModal-{{ $organization->id }}" class="fixed inset-0 bg-black z-50 bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300">
                                    <div class="bg-white rounded-2xl shadow-xl w-96 transform transition-transform duration-300 scale-95">
                                        <div class="flex justify-between items-center bg-gradient-to-r bg-laravel px-6 py-4 rounded-t-2xl">
                                            <h2 class="text-lg font-bold text-white">Edit Organization</h2>
                                            <button class="closeModalBtn text-white text-2xl hover:text-gray-200 transition ease-in-out duration-300">&times;</button>
                                        </div>
                            
                                        <form action="{{ route('admin.admin_pages.organization.update', $organization->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-6 space-y-4">
                                                <!-- Organization Name Abbreviation Input -->
                                                <div>
                                                    <label for="orgNameAbbv" class="block text-gray-600 font-medium mb-1">Organization Abbreviation</label>
                                                    <input type="text" id="orgNameAbbv" name="orgNameAbbv" value="{{ $organization->orgNameAbbv }}"
                                                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel" placeholder="e.g., CCIS">
                                                    @error('orgNameAbbv')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                            
                                                <!-- Organization Name -->
                                                <div>
                                                    <label for="orgName" class="block text-gray-600 font-medium mb-1">Organization Name</label>
                                                    <input type="text" id="orgName" name="orgName" value="{{ $organization->orgName }}"
                                                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel" placeholder="Enter Organization Name">
                                                    @error('orgName')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                            
                                                <!-- Logo Upload -->
                                                <div>
                                                    <label for="orgLogo" class="block text-gray-600 font-medium mb-1">Organization Logo</label>
                                                    <input type="file" id="orgLogo" name="orgLogo" value="{{ $organization->orgLogo }}"
                                                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel">
                                                    @error('orgLogo')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                            
                                                <div class="flex justify-center">
                                                    <button type="submit" class="px-6 py-2 bg-laravel text-white rounded-lg shadow-md hover:underline transition ease-in-out duration-300">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                            
                                        <!-- Modal Footer -->
                                        <div class="bg-gray-100 px-6 py-3 rounded-b-2xl flex justify-center hover:underline">
                                            <button class="closeModalBtn text-gray-500 hover:text-gray-700 transition ease-in-out duration-300">Close</button>
                                        </div>
                                    </div>
                                </div>
                          
                            
                            
                            
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-slate-500">
                                No organizations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                
                </table>
            </div>
            <div class="flex items-center justify-between p-3">
                <p class="block text-sm text-slate-500">
                Page 1 of 10
                </p>
                <div class="flex gap-1">
                <button
                    class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    Previous
                </button>
                <button
                    class="rounded border border-slate-300 py-2.5 px-3 text-center text-xs font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    Next
                </button>
                </div>
            </div>
            </div>
 
    </div>
        <!-- Modal Start for adding -->
        <div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300">
            <!-- Modal Content -->
            <div class="bg-white rounded-2xl shadow-xl w-96 transform transition-transform duration-300 scale-95">
                <!-- Modal Header -->
                <div class="flex justify-between items-center bg-gradient-to-r bg-laravel px-6 py-4 rounded-t-2xl">
                    <h2 class="text-lg font-bold text-white">Add Organization</h2>
                    <button id="closeModalBtn" class="text-white text-2xl hover:text-gray-200 transition ease-in-out duration-300">&times;</button>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Modal Body -->
                <form id="orgForm" action="{{ route('admin.admin_pages.organization.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-4">
                        <!-- Organization Name Input -->
                        <div>
                            <label for="orgNameAbbv" class="block text-gray-600 font-medium mb-1">Organization</label>
                            <input type="text" id="orgNameAbbv" name="orgNameAbbv" value="{{ old('orgNameAbbv') }}"
                                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel" placeholder="e.g., CCIS">
                            @error('orgNameAbbv')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Organization Name -->
                        <div>
                            <label for="orgName" class="block text-gray-600 font-medium mb-1">Organization Name</label>
                            <input type="text" id="orgName" name="orgName" value="{{ old('orgName') }}"
                                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel" placeholder="Enter Organization Name">
                            @error('orgName')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo Upload -->
                        <div>
                            <label for="orgLogo" class="block text-gray-600 font-medium mb-1">Organization Logo</label>
                            <input type="file" id="orgLogo" name="orgLogo" value="{{ old('orgLogo') }}"
                                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-laravel">
                            @error('orgLogo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center">
                            <button type="submit" id="submitBtn" class="px-6 py-2 bg-laravel text-white rounded-lg shadow-md hover:underline transition ease-in-out duration-300">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Modal Footer -->
                <div class="bg-gray-100 px-6 py-3 rounded-b-2xl flex justify-center hover:underline">
                    <button id="closeFooterBtn" class="text-gray-500 hover:text-gray-700 transition ease-in-out duration-300">Close</button>
                </div>
            </div>
        </div>
        <!-- Modal End and start for editing---------------------------------------- -->
       
       
    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const openModalBtn = document.getElementById('openModalBtn');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const closeFooterBtn = document.getElementById('closeFooterBtn');
                const submitBtn = document.getElementById('submitBtn');
                const popupModal = document.getElementById('popupModal');

                // Open the modal
                openModalBtn.addEventListener('click', () => {
                    popupModal.classList.remove('hidden');
                    setTimeout(() => {
                        popupModal.classList.remove('opacity-0');
                        popupModal.classList.add('opacity-100');
                        document.querySelector('.transform').classList.add('scale-100');
                    }, 100);
                });

                // Close the modal
                closeModalBtn.addEventListener('click', closeModal);
                closeFooterBtn.addEventListener('click', closeModal);

                // Handle Submit button
                submitBtn.addEventListener('click', () => {
                    const orgNameAbbv = document.getElementById('orgNameAbbv').value;
                    const orgName = document.getElementById('orgName').value;
                    const orgLogo = document.getElementById('orgLogo').files[0];

                    console.log('Organization Abbv:', orgNameAbbv);
                    console.log('Organization Name:', orgName);
                    console.log('Organization Logo:', orgLogo);

                    alert('Form submitted successfully!');
                    closeModal();
                });

                function closeModal() {
                    document.querySelector('.transform').classList.remove('scale-100');
                    popupModal.classList.add('opacity-0');
                    setTimeout(() => {
                        popupModal.classList.add('hidden');
                    }, 300);
                }
            });

            /////////////////////////---------javascript edit modal----------///////////////////////////////
                      

            document.addEventListener('DOMContentLoaded', function () {
    // Open the correct modal when a button is clicked
    document.querySelectorAll('.openeditModal').forEach(button => {
        button.addEventListener('click', function () {
            const organizationId = this.getAttribute('data-org-id');
            const modal = document.getElementById(`editModal-${organizationId}`);
            modal.classList.remove('hidden');
            modal.classList.add('block');
        });
    });

    // Close modal when close button is clicked
    document.querySelectorAll('.closeModalBtn').forEach(button => {
        button.addEventListener('click', function () {
            const modal = this.closest('.fixed');
            modal.classList.remove('block');
            modal.classList.add('hidden');
        });
    });
});

//////delete
// Open the delete confirmation modal
document.querySelectorAll('.openDeleteModal').forEach(function(button) {
    button.addEventListener('click', function() {
        var modal = document.getElementById('deleteModal-' + this.getAttribute('data-org-id'));
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