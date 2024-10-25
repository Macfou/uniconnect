<x-layout>
    @include('partials._myevents')
     <!-- Dropdown Section -->
     <div class="max-w-[750px] mx-auto position:sticky pt-20 pb-44">
         <div class="relative flex flex-col h-full text-slate-700 bg-white shadow-md rounded-xl">
             <div class="relative mx-4 mt-4">
                 <!-- Dropdown Button -->
                 <div class="relative inline-block text-left group">
                     <div class="inline-flex items-center cursor-pointer">
                         <h3 class="text-lg font-semibold text-slate-800">Events</h3>
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1 text-slate-800" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                         </svg>
                     </div>
 
                     <!-- Dropdown Menu -->
                     <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block z-10">
                         <div class="py-1">
                             <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('incoming-event')">Incoming Events</a>
                             <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('todays-event')">Today's Event</a>
                             <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showSection('previous-event')">Previous Events</a>
                         </div>
                     </div>
                 </div>
             </div>
 
             <!-- Previous Event -->
             <section id="previous-event" style="display: none;">
                 <p class="pl-4 font-bold">Previous Events</p>
                 <div class="p-0 overflow-scroll">
                     <table class="w-full mt-4 text-left table-auto min-w-max">
                         <thead>
                             <tr>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Title</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Venue</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Date</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse($previousEvents as $event)
                                 <tr>
                                     <td class="p-4 border-b border-slate-200">{{ $event->tags }}</td>
                                     <td class="p-4 border-b border-slate-200">{{ $event->venue }}</td>
                                     <td class="p-4 border-b border-slate-200">{{ $event->event_date }}</td>
                                     <td class="p-4 border-b border-slate-200">
                                         <a href="/listings/{{ $event->id }}/edit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Edit</a>
                                         <form method="POST" action="/listings/{{ $event->id }}" class="inline">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Delete</button>
                                         </form>
                                     </td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="4" class="p-4 text-center">No previous events.</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                 </div>
             </section>
 
             <!-- Incoming Event -->
             <section id="incoming-event">
                 <p class="pl-4 font-bold">Incoming Events</p>
                 <div class="p-0 overflow-scroll">
                     <table class="w-full mt-4 text-left table-auto min-w-max">
                         <thead>
                             <tr>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Title</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Venue</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Date</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse($upcomingEvents as $event)
                                 <tr>
                                     <td class="p-4 border-b border-slate-200">{{ $event->tags }}</td>
                                     <td class="p-4 border-b border-slate-200">{{ $event->venue }}</td>
                                     <td class="p-4 border-b border-slate-200">{{ $event->event_date }}</td>
                                     <td class="p-4 border-b border-slate-200">
                                         <a href="/listings/{{ $event->id }}/edit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Edit</a>
                                         <form method="POST" action="/listings/{{ $event->id }}" class="inline">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="h-10 w-10 rounded-lg hover:bg-slate-900/10">Delete</button>
                                         </form>
                                     </td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="4" class="p-4 text-center">No incoming events.</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                 </div>
             </section>
 
             <!-- Today's Event -->
             <section id="todays-event" style="display: none;">
                 <p class="pl-4 font-bold">Today's Events</p>
                 <div class="p-0 overflow-scroll">
                     <table class="w-full mt-4 text-left table-auto min-w-max">
                         <thead>
                             <tr>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Title</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Venue</th>
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Time</th>
                                 
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse($todaysEvents as $event)
                                 <tr>
                                     <td class="p-4 border-b border-slate-200">{{ $event->tags }}</td>
                                     <td class="p-4 border-b border-slate-200">{{ $event->venue }}</td>
                                     <td class="p-4 border-b border-slate-200">{{ $event->event_time }}</td>
                                     <td class="">
                                        <form action="{{ route('startevent', $event->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="pt-1 pb-1 pl-4 pr-4 text-white text-center font-medium bg-laravel rounded-lg hover:underline">
                                                Start
                                            </button>
                                        </form>
                                    </td>
                                    
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="4" class="p-4 text-center">No events today.</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                 </div>
             </section>
         </div>
     </div>
 
     <script>
         function showSection(sectionId) {
             // Hide all sections
             document.getElementById('previous-event').style.display = 'none';
             document.getElementById('incoming-event').style.display = 'none';
             document.getElementById('todays-event').style.display = 'none';
             
             // Show the selected section
             document.getElementById(sectionId).style.display = 'block';
         }
     </script>
 </x-layout>

 @include('partials._footer')
 