<x-layout>
    @include('partials._breadcrumb')

    <div class="container pt-20 mx-auto p-6">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">My Certificates</h2>

        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-4">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700">
                            <th class="border px-4 py-2">Event</th>
                            <th class="border px-4 py-2">Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($certificates->count() > 0)
                            @foreach($certificates as $certificate)
                                <tr class="border-b">
                                    <td class="border px-4 py-2">
                                        <span class="font-medium">{{ $certificate->listing->tags }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <button onclick="openModal('{{ asset('storage/' . $certificate->certificate_path) }}')"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition duration-200">
                                            View Certificate
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="border px-4 py-2 text-center text-gray-500" colspan="2">No certificates available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scrollable Modal for Certificate Preview -->
    <div id="certificateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl h-[90vh] flex flex-col relative">
            <!-- Modal Header -->
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Certificate Preview</h2>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-800 text-xl">&times;</button>
            </div>

            <!-- Scrollable Content -->
            <div class="overflow-y-auto flex-1 p-4">
                <img id="certificateImage" src="" alt="Certificate" class="w-full rounded-lg shadow-md">
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t flex justify-center gap-4">
                <a id="downloadButton" href="#" download="certificate.jpg" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition duration-200">
                    Save Certificate
                </a>
                <button onclick="closeModal()" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm transition duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal(imageUrl) {
            document.getElementById("certificateImage").src = imageUrl;
            document.getElementById("downloadButton").href = imageUrl;
            document.getElementById("certificateModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("certificateModal").classList.add("hidden");
        }
    </script>
</x-layout>
