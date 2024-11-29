<x-layout>

    

    <button 
            onclick="history.back()" 
            class="flex items-center pt-24 px-4 py-2 text-white bg-laravel hover:bg-gray-700 rounded-lg shadow-md focus:outline-none">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </button>
    <div class="md:col-span-3 bg-white pt-20 px-4 shadow-xl p-6 space-y-2 rounded-lg mt-6">

        
        <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
            <table class="w-full min-w-[640px] table-auto">
                
                <thead>
                    <p class="pl-4 text-lg"><strong>{{$listing->tags}}</strong> Attende's</p>
                    <hr class="border-black px-4">
                    <tr>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                                Name
                            </p>
                        </th>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                                Organization
                            </p>
                        </th>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                                Feedback
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendees as $attendee)
                        <tr>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex items-center gap-4">
                                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">
                                        {{ $attendee->fname }} {{ $attendee->lname }}
                                    </p>
                                </div>
                            </td>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600 font-bold">
                                    {{ $attendee->org }}
                                </p>
                            </td>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">
                                   Feedback
                                </p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-3">
                                No attendees found for this event.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>

           
            
        </div>
    </div>
</x-layout>
