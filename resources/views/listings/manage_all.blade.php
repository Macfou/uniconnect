<x-layout>
    @include('partials._myevents')
     <!-- Dropdown Section -->
     <div class="max-w-[750px] mx-auto position:sticky pt-20 pb-44">
         <div class="relative flex flex-col h-full text-slate-700 bg-white shadow-md rounded-xl">
             <div class="relative mx-4 mt-4">
                 <!-- Dropdown Button -->
                 <div class="relative inline-block text-left group">
                    
 
                     <!-- Dropdown Menu -->
                     <nav class="flex items-center space-x-2 text-sm text-gray-600 bg-white px-4 py-2 rounded-md shadow-md w-fit">
                        <button onclick="showSection('incoming-event')" class="hover:text-blue-600 transition">
                            Incoming Events
                        </button>
                        <span class="text-gray-400">/</span>
                        <button onclick="showSection('todays-event')" class="hover:text-blue-600 transition">
                            Today's Event
                        </button>
                        <span class="text-gray-400">/</span>
                        <button onclick="showSection('previous-event')" class="hover:text-blue-600 transition">
                            Previous Events
                        </button>
                    </nav>
                    
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
                                     <td class="p-4 border-b border-slate-200">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                                    </td>
                                    
                                     <td class="p-4 border-b border-slate-200">
                                         <a href="{{ route('pages.afterevent', ['id' => $event->id]) }}" class="pt-1 pb-1 pl-4 pr-4 text-white text-center font-medium bg-laravel rounded-lg hover:underline">View Details</a>
                                        
                                     
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
                                
                                 <th class="p-4 border-y border-slate-200 bg-slate-50">Checklists</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse($upcomingEvents as $event)
                                 <tr>
                                     <td class="p-4 border-b border-slate-200">{{ $event->tags }}</td>
                                 <td class="p-4 border-b border-slate-200">{{ $event->venue }}</td>
                                     <td class="p-4 border-b border-slate-200">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                                    </td>
                                    
                                     <td class="p-4 border-b border-slate-200">
                                        <a href="{{ route('checklists', ['id' => $event->id]) }}">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                Checklists
                                            </button>
                                        </a>
                                        
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
 