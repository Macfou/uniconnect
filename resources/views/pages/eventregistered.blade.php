<x-layout>

    @include('partials._breadcrumb')

   

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">My Registered Events</h1>

        @if($registrations->count() > 0)
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white">
                    <thead class="bg-laravel text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">Event Title</th>
                            <th class="py-3 px-6 text-left">Event date</th>
                            <th class="py-3 px-6 text-left">Full Name</th>
                            
                            <th class="py-3 px-6 text-left">Email</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($registrations as $registration)
                            <tr class="border-b hover:bg-gray-100 transition">
                                <td class="py-4 px-6 font-semibold text-blue-600">
                                    {{ $registration->listing->tags ?? 'Event Title Not Found' }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ \Carbon\Carbon::parse($registration->listing->event_date)->format('F j, Y') }}

                                </td>
                                <td class="py-4 px-6">
                                    {{ $registration->full_name }}
                                </td>
                               
                                <td class="py-4 px-6">
                                    {{ $registration->email }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-500 text-lg mt-10">
                You have not registered for any events yet.
            </div>
        @endif
    </div>


</x-layout>
