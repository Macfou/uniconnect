<x-spmo_layout>
    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
            <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                <li class="flex items-center text-blue-gray-900 font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                    <a href="#">
                        <p class="block font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">SPMO</p>
                    </a>
                    <span class="text-gray-500 text-sm font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
                </li>
                <li class="flex items-center text-blue-900 font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                    <h6 class="block font-sans text-base font-semibold leading-relaxed text-gray-900">Returned Equipment</h6>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Add this to the top of your HTML file to include jsPDF -->


<div class="relative flex flex-col w-full h-full text-slate-700 bg-white mx-w-lg shadow-md rounded-xl">
    <div class="relative mx-4 mt-4 flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-800">Returned Equipment</h3>   
        
        <!-- Print Button with Printer Icon -->
        <button id="printButton" class="text-blue-500 hover:text-blue-700">
            <i class="fa fa-print mr-2"></i> Print PDF
        </button>
    </div>

    <table id="equipmentTable" class="w-full mt-4 text-left table-auto border border-slate-200 rounded-lg">
        <thead class="bg-slate-50">
            <tr>
                <th class="p-4 border-b border-slate-200">Name</th>
                <th class="p-4 border-b border-slate-200">College</th>
                <th class="p-4 border-b border-slate-200">Event</th>
                <th class="p-4 border-b border-slate-200">Venue</th>
                <th class="p-4 border-b border-slate-200">Equipment</th>
                <th class="p-4 border-b border-slate-200">Quantity</th>
                <th class="p-4 border-b border-slate-200">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowRequests as $borrowRequest)
            <tr class="hover:bg-slate-100">
                <td class="p-4 border-b">{{ strtoupper($borrowRequest->user->fname) }} {{ strtoupper($borrowRequest->user->lname) }}</td>
                <td class="p-4 border-b">{{ strtoupper($borrowRequest->user->org) }}</td>
                <td class="p-4 border-b">{{ $borrowRequest->listing->tags }}</td>
                <td class="p-4 border-b">{{ $borrowRequest->listing->venue }}</td>
                <td class="p-4 border-b">{{ $borrowRequest->equipment->name }}</td>
                <td class="p-4 border-b">{{ $borrowRequest->quantity }}</td>
                <td class="p-4 border-b text-green-500 font-bold">Returned</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="p-4 text-center">No returned equipment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="orientationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Select PDF Orientation</h3>
        
        <!-- Orientation Options -->
        <div class="flex justify-between mb-4">
            <button id="portraitButton" class="bg-blue-500 text-white py-2 px-4 rounded">Portrait</button>
            <button id="landscapeButton" class="bg-blue-500 text-white py-2 px-4 rounded">Landscape</button>
        </div>
        
        <!-- Close button -->
        <button id="closeModal" class="mt-4 bg-red-500 text-white py-2 px-4 rounded w-full">Close</button>
    </div>
</div>

<!-- Add JavaScript for handling the print and modal -->
<script>
    document.getElementById('printButton').addEventListener('click', function() {
        // Show the modal for orientation selection
        document.getElementById('orientationModal').classList.remove('hidden');
    });

    // Close modal
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('orientationModal').classList.add('hidden');
    });

    // Portrait button action
    document.getElementById('portraitButton').addEventListener('click', function() {
        generatePDF('portrait');
    });

    // Landscape button action
    document.getElementById('landscapeButton').addEventListener('click', function() {
        generatePDF('landscape');
    });

    // Function to generate the PDF based on selected orientation
    function generatePDF(orientation) {
        const element = document.getElementById('equipmentTable');
        
        // Define the options for the PDF
        const options = {
            margin:       1,
            filename:     'returned_equipment.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 4 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: orientation }
        };

        // Generate the PDF
        html2pdf().from(element).set(options).save();
        
        // Close the modal after generating the PDF
        document.getElementById('orientationModal').classList.add('hidden');
    }
</script>
        
      

</x-spmo_layout>
