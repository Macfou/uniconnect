<x-ufmo-layout>
    <section>

        <div class="capitalize">
               <nav aria-label="breadcrumb" class="w-max">
                 <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                   <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                     <a href="#">
                       <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">UFMO</p>
                     </a>
                     <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
                   </li>
                   <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                       <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Dashboard</h6>
                   </li>
                 </ol>
               </nav>
               
             </div>

       <div class="mt-12">
           <div class="mb-12 grid gap-y-10 gap-x-6 md:grid-cols-2 xl:grid-cols-4">
             <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
               <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                   <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"></path>
                   <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd"></path>
                   <path d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z"></path>
                 </svg>
               </div>
               <div class="p-4 text-right">
                 <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Pending Requests</p>
                 <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">{{ $pendingCount }}</h4>
             </div>
             
               
             </div>
             <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
               <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                   <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
                 </svg>
               </div>
               <div class="p-4 text-right">
                 <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Approved Requests</p>
                 <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">{{ $approvedCount }}</h4>
               </div>
               
             </div>
             <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
               <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                   <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                 </svg>
               </div>
               <div class="p-4 text-right">
                 <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Rejected Requests</p>
                 <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">{{ $rejectedCount }}</h4>
               </div>
               
             </div>
            
           </div>
           
           <div class="mb-4 grid grid-cols-1 gap-6 xl:grid-cols-3">
             <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
               <div class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">
                 <div>
                   <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900 mb-1"> </h6>
                   <p class="antialiased font-sans text-sm leading-normal flex items-center gap-1 font-normal text-blue-gray-600">
                     
                     <strong>Facility</strong> 
                   </p>
                 </div>
                 <button aria-expanded="false" aria-haspopup="menu" id=":r5:" class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                   <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="currenColor" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" aria-hidden="true" class="h-6 w-6">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"></path>
                     </svg>
                   </span>
                 </button>
               </div>
               <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                 <table class="w-full min-w-[640px] table-auto">
                   <thead>
                     <tr>
                       <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                         <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Facility</p>
                       </th>
                       <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                         <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Status</p>
                       </th>
                       <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                         <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Positive Rate</p>
                       </th>
                      
                     </tr>
                   </thead>
                   <tbody>
                    
                       @foreach ($facilities as $facility)
                    
                     <tr>
                       <td class="py-3 px-5 border-b border-blue-gray-50">
                         <div class="flex items-center gap-4">
                           <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $facility->facility_name }}</p>
                         </div>
                       </td>
                       <td class="py-3 px-5 border-b border-blue-gray-50">
                         <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">{{ $facility->status }}</p>
                       </td>
                       <td class="py-3 px-5 border-b border-blue-gray-50">
                         <div class="w-10/12">
                           <p class="antialiased font-sans mb-1 block text-xs font-medium text-blue-gray-600">25%</p>
                           <div class="flex flex-start bg-blue-gray-50 overflow-hidden w-full rounded-sm font-sans text-xs font-medium h-1">
                             <div class="flex justify-center items-center h-full bg-gradient-to-tr from-blue-600 to-blue-400 text-white" style="width: 25%;"></div>
                           </div>
                         </div>
                       </td>
                     </tr>
                      @endforeach
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
   </section>
</x-ufmo-layout>