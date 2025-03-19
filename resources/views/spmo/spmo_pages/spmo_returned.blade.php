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

    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white mx-w-lg shadow-md rounded-xl">
        <div class="relative mx-4 mt-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">Returned Equipment</h3>   
        </div>

        <table class="w-full mt-4 text-left table-auto border border-slate-200 rounded-lg">
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
</x-spmo_layout>
