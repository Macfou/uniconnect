<x-gso-layout>
    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
          <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
            <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
              <a href="#">
                <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">GSO</p>
              </a>
              <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
            </li>
            <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Cancelled Requests</h6>
            </li>
          </ol>
        </nav>
        
      </div>

      <div class="relative flex flex-col w-full h-full text-slate-700  bg-white mx-w-lg shadow-md rounded-xl">
        <div class="relative mx-4 mt-4 flex justify-between items-center">
            <!-- Left Side: University Facility Title -->
            <h3 class="text-lg font-bold text-slate-800">Cancelled Requests</h3>   
        </div>
        

        <!-- Facility Table -->
        <table class="w-full mt-4 text-left table-auto border border-slate-200 rounded-lg">
            <thead class="bg-slate-50">
                <tr>
                    <th class="p-4 border-b border-slate-200"> Name</th>
                    <th class="p-4 border-b border-slate-200">College</th>
                    <th class="p-4 border-b border-slate-200">Event</th>
                    <th class="p-4 border-b border-slate-200">Venue</th>
                    <th class="p-4 border-b border-slate-200">Action</th>
                </tr>
            </thead>
           
            <tbody>
                <tr class="hover:bg-slate-100">
                    <td class="p-4 border-b">Juan Delacruz</td>
                    <td class="p-4 border-b">Event title</td>
                    <td class="p-4 border-b">ndcsacfv</td>
                    <td class="p-4 border-b">ovalsdsv</td>
                    <td class="p-4 border-b">
                        <!-- Approve Form -->
                        <form action="">
                            @csrf
                            @method('PATCH')
                            <button class="text-blue-500 hover:underline" type="submit">Approve</button>
                        </form>
                        <!-- Reject Form -->
                        <form>
                            @csrf
                            @method('PATCH')
                            <button class="text-red-500 hover:underline" type="submit">Reject</button>
                        </form>
                    </td>
                </tr>
            </tbody>
     
        
        
        </table>
    </div>
</x-gso-layout>