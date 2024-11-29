<x-admin-layout>

    @if (session('success'))
    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    
        <div class="relative flex flex-col w-full h-full text-slate-700 bg-white mx-w-lg shadow-md rounded-xl">
            <div class="relative mx-4 mt-4 flex justify-between items-center">
                <!-- Left Side: University Facility Title -->
                <h3 class="text-lg font-bold text-slate-800">GSO</h3>
            
                <!-- Right Side: Add Facility Button -->
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    <a href="#addFacilityModal"
                       class="flex select-none items-center gap-2 rounded bg-laravel py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                       type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                             stroke-width="2" class="w-4 h-4">
                            <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                        </svg>
                        Add GSO Officer
                    </a>
                </div>
            </div>
            
    
            <!-- Facility Table -->
            <table class="w-full mt-4 text-left table-auto border border-slate-200 rounded-lg">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4 border-b border-slate-200">Name</th>
                        <th class="p-4 border-b border-slate-200">Email</th>
                        <th class="p-4 border-b border-slate-200">Date Added</th>
                        <th class="p-4 border-b border-slate-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gsoUsers as $gso)
                        <tr class="hover:bg-slate-100">
                            <td class="p-4 border-b">{{ $gso->fname }} {{ $gso->lname }}</td>
                            <td class="p-4 border-b">{{ $gso->email }}</td>
                            <td class="p-4 border-b">{{ $gso->created_at->format('Y-m-d') }}</td>
                            <td class="p-4 border-b">
                               
                               
                
                                <!-- Delete Button -->
                                <form action="{{ route('admin.admin_users.gsouser.destroy', $gso->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#deleteModal" class="text-red-600 hover:underline">Delete</a>
                                </form>

                                
                                <!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-lg font-medium mb-4">Are you sure you want to delete this <strong> {{ $gso->fname }} {{ $gso->lname }}</strong>?</h2>
        <p class="text-gray-600">This action cannot be undone.</p>
        <div class="flex justify-center space-x-4 mt-4">
            <!-- The action form for deleting the GSO -->
            <form id="deleteForm" action="{{ route('admin.admin_users.gsouser.destroy', $gso->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-800">Yes, Delete</button>
            </form>
            <!-- Cancel button to close the modal -->
            <a href="#" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700">Cancel</a>
        </div>
    </div>
</div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center">No GSO Officers found.</td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
    
        <!-- Add Facility Modal -->
        <div id="addFacilityModal" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2 class="text-lg font-bold mb-4">Add GSO</h2>
                <form action="{{ route('admin.admin_users.gsouser.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">First Name</label>
                        <input type="text" name="fname" value="{{ old('fname') }}" class="w-full border p-2 rounded-lg" required>
                        @error('fname')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Last Name</label>
                        <input type="text" name="lname" value="{{ old('lname') }}" class="w-full border p-2 rounded-lg" required>
                        @error('lname')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded-lg" required>
                        @error('email')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Password</label>
                        <input type="password" name="password" class="w-full border p-2 rounded-lg" required>
                        @error('password')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full border p-2 rounded-lg" required>
                    </div>
                    <div class="flex justify-end space-x-4 mt-4">
                        <a href="#" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700">Cancel</a>
                        <button type="submit" class="py-2 px-4 bg-laravel text-white rounded hover:bg-red-700">Add</button>
                    </div>
                </form>
                
            </div>
        </div>
    
       
    
       
        
    
        <!-- Modal CSS -->
        <style>
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }
    
            .modal:target {
                display: flex;
            }
    
            .modal-content {
                background: white;
                padding: 2rem;
                border-radius: 8px;
                width: 400px;
                position: relative;
            }
    
            .close {
                position: absolute;
                top: 0.5rem;
                right: 0.5rem;
                text-decoration: none;
                font-size: 1.5rem;
                color: #333;
            }
    
            .close:hover {
                color: red;
            }
        </style>
    
    
</x-admin-layout>