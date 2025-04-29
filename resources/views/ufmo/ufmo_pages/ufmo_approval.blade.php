<x-ufmo-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold">Approval Status for Event: {{ $listing->tags }}</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider text-xs border-b">
                    <tr>
                        <th class="px-6 py-3">Checklists for event</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Request</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{-- Adviser --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">Adviser</td>
                        <td class="px-6 py-4 font-semibold {{ $adviserApproval ? ($adviserApproval->status == 'Pending' ? 'bg-yellow-200' : ($adviserApproval->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $adviserApproval ? ($adviserApproval->status == 'Pending' ? 'Pending' : ($adviserApproval->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_adviser_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    {{-- Dean --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">Dean</td>
                        <td class="px-6 py-4 font-semibold {{ $deanApproval ? ($deanApproval->status == 'Pending' ? 'bg-yellow-200' : ($deanApproval->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $deanApproval ? ($deanApproval->status == 'Pending' ? 'Pending' : ($deanApproval->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_dean_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    {{-- USC --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">CSOA</td>
                        <td class="px-6 py-4 font-semibold {{ $uscRequest ? ($uscRequest->status == 'Pending' ? 'bg-yellow-200' : ($uscRequest->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $uscRequest ? ($uscRequest->status == 'Pending' ? 'Pending' : ($uscRequest->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_usc_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    {{-- GSO Borrow --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">GSO Borrow</td>
                        <td class="px-6 py-4 font-semibold {{ $permitBorrow ? ($permitBorrow->status == 'Pending' ? 'bg-yellow-200' : ($permitBorrow->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $permitBorrow ? ($permitBorrow->status == 'Pending' ? 'Pending' : ($permitBorrow->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_gso_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    {{-- SPMO Borrow --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">Spmo Borrow</td>
                        <td class="px-6 py-4 font-semibold {{ $spmoBorrowRequest ? ($spmoBorrowRequest->status == 'Pending' ? 'bg-yellow-200' : ($spmoBorrowRequest->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $spmoBorrowRequest ? ($spmoBorrowRequest->status == 'Pending' ? 'Pending' : ($spmoBorrowRequest->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_spmo_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    {{-- Bring In --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">Bring In</td>
                        <td class="px-6 py-4 font-semibold {{ $bringInRequest ? ($bringInRequest->status == 'Pending' ? 'bg-yellow-200' : ($bringInRequest->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $bringInRequest ? ($bringInRequest->status == 'Pending' ? 'Pending' : ($bringInRequest->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_bringin_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    {{-- Transfer --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">Transfer</td>
                        <td class="px-6 py-4 font-semibold {{ $transferRequest ? ($transferRequest->status == 'Pending' ? 'bg-yellow-200' : ($transferRequest->status == 'Rejected' ? 'bg-red-200' : 'bg-green-200')) : 'bg-gray-200' }}">
                            {{ $transferRequest ? ($transferRequest->status == 'Pending' ? 'Pending' : ($transferRequest->status == 'Rejected' ? 'Rejected' : 'Approved')) : 'No requests' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('view_transfer_ufmo', ['id' =>  $listing->id]) }}" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                View Requests
                             </a>
                        </td>
                    </tr>

                    
                    
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <a href="{{ route('ufmo.ufmo_pages.ufmo_pending') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">Back</a>
        </div>
    </div>
</x-ufmo-layout>