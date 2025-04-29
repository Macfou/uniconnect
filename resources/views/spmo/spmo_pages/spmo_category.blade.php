<x-spmo_layout>
    <!-- Your Breadcrumb -->
    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
            <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                    <a href="#"><p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">SPMO</p></a>
                    <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
                </li>
                <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                    <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Inventory</h6>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen p-8">
        <div class="bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6">Inventory List</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Supply Form -->
            <form id="supplyForm" action="{{ route('spmo.spmo_pages.spmo_category.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="flex space-x-4">
                    <input type="text" name="name" placeholder="Supply Name" class="px-4 py-2 border rounded-md w-full" required>
                    <input type="number" name="quantity" placeholder="Quantity" class="px-4 py-2 border rounded-md w-24" min="0" required>
                    <button type="button" onclick="confirmAdd()" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add Supply</button>
                </div>
            </form>

            <!-- Confirm Add Modal -->
            <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center space-y-4">
                    <h2 class="text-lg font-semibold">Are you sure you want to add this supply?</h2>
                    <div class="flex justify-center space-x-4">
                        <button onclick="submitForm()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Yes</button>
                        <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">No</button>
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2 text-left">Quantity</th>
                        <th class="px-4 py-2 text-left">Supply Name</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{$category->quantity}}</td>
                            <td class="px-4 py-2">{{$category->name}}</td>
                            <td class="px-4 py-2 space-x-2">
                                <!-- Update Button -->
                                <button onclick="openUpdateModal({{ $category->id }}, '{{ $category->name }}', {{ $category->quantity }})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Update
                                </button>

                                <!-- Delete Button -->
                                <button onclick="openDeleteModal({{ $category->id }})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Update Modal -->
            <div id="updateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg space-y-4">
                    <h2 class="text-lg font-semibold">Update Supply</h2>
                    <form id="updateForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" id="updateName" name="name" class="border rounded px-4 py-2 w-full mb-2" required>
                        <input type="number" id="updateQuantity" name="quantity" class="border rounded px-4 py-2 w-full mb-4" min="0" required>
                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
                            <button type="button" onclick="closeUpdateModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg space-y-4 text-center">
                    <h2 class="text-lg font-semibold">Are you sure you want to delete this supply?</h2>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center space-x-4 mt-4">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Yes</button>
                            <button type="button" onclick="closeDeleteModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">No</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- JS for modals -->
    <script>
        function confirmAdd() {
            document.getElementById('confirmModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
        function submitForm() {
            document.getElementById('supplyForm').submit();
        }

        function openUpdateModal(id, name, quantity) {
            const updateForm = document.getElementById('updateForm');
            updateForm.action = '/spmo/category/update/' + id;
            document.getElementById('updateName').value = name;
            document.getElementById('updateQuantity').value = quantity;
            document.getElementById('updateModal').classList.remove('hidden');
        }
        function closeUpdateModal() {
            document.getElementById('updateModal').classList.add('hidden');
        }

        function openDeleteModal(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '/spmo/category/delete/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-spmo_layout>
