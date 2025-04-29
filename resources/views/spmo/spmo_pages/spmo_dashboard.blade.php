<x-spmo_layout>
    <section>

         <div class="capitalize">
                <nav aria-label="breadcrumb" class="w-max">
                  <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                    <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                      <a href="#">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">SPMO</p>
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
            <!-- SpmoBorrowRequest -->
<div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
  <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 text-yellow-500" viewBox="0 0 24 24">
      <path d="M12 1.75a.75.75 0 01.75.75v9.19l4.22 2.44a.75.75 0 01-.75 1.3l-4.47-2.59a.75.75 0 01-.38-.65V2.5A.75.75 0 0112 1.75z"/>
      <path fill-rule="evenodd" d="M12 22a10 10 0 100-20 10 10 0 000 20zm0-1.5A8.5 8.5 0 1120.5 12 8.51 8.51 0 0112 20.5z" clip-rule="evenodd"/>
    </svg>
  </div>
  <div class="p-4 text-right">
    <p class="text-sm font-normal text-blue-gray-600">Pending Borrow Requests</p>
    <h4 class="text-2xl font-semibold text-blue-gray-900">{{ $pendingBorrowCount }}</h4>
  </div>
</div>

<!-- BringIn -->
<div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
  <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 text-yellow-500" viewBox="0 0 24 24">
      <path d="M12 1.75a.75.75 0 01.75.75v9.19l4.22 2.44a.75.75 0 01-.75 1.3l-4.47-2.59a.75.75 0 01-.38-.65V2.5A.75.75 0 0112 1.75z"/>
      <path fill-rule="evenodd" d="M12 22a10 10 0 100-20 10 10 0 000 20zm0-1.5A8.5 8.5 0 1120.5 12 8.51 8.51 0 0112 20.5z" clip-rule="evenodd"/>
    </svg>
  </div>
  <div class="p-4 text-right">
    <p class="text-sm font-normal text-blue-gray-600">Pending BringIn Requests</p>
    <h4 class="text-2xl font-semibold text-blue-gray-900">{{ $pendingBringInCount }}</h4>
  </div>
</div>

<!-- PermitTransfer -->
<div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
  <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 text-yellow-500" viewBox="0 0 24 24">
      <path d="M12 1.75a.75.75 0 01.75.75v9.19l4.22 2.44a.75.75 0 01-.75 1.3l-4.47-2.59a.75.75 0 01-.38-.65V2.5A.75.75 0 0112 1.75z"/>
      <path fill-rule="evenodd" d="M12 22a10 10 0 100-20 10 10 0 000 20zm0-1.5A8.5 8.5 0 1120.5 12 8.51 8.51 0 0112 20.5z" clip-rule="evenodd"/>
    </svg>
  </div>
  <div class="p-4 text-right">
    <p class="text-sm font-normal text-blue-gray-600">Pending Transfer Requests</p>
    <h4 class="text-2xl font-semibold text-blue-gray-900">{{ $pendingPermitTransferCount }}</h4>
  </div>
</div>

<!-- Spmo Users -->
<div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
  <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
      <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
    </svg>
  </div>
  <div class="p-4 text-right">
    <p class="text-sm font-normal text-blue-gray-600">Users</p>
    <h4 class="text-2xl font-semibold text-blue-gray-900">{{ $spmoUserCount }}</h4>
  </div>
</div>

             
            </div>
            
            <div class="mb-4 grid grid-cols-1 gap-6 xl:grid-cols-3">
              <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
                <div class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">
                  <div>
                    <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900 mb-1">Most Borrowed Equipments</h6>
                    <p class="antialiased font-sans text-sm leading-normal flex items-center gap-1 font-normal text-blue-gray-600">
                      
                      <strong>Inventory</strong> 
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

                  <form method="GET" class="flex gap-4 items-center px-6 mb-4">
                    <div>
                        <label for="month" class="text-sm text-gray-600">Month:</label>
                        <select name="month" id="month" class="border rounded px-2 py-1 text-sm">
                            <option value="">All</option>
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="year" class="text-sm text-gray-600">Year:</label>
                        <select name="year" id="year" class="border rounded px-2 py-1 text-sm">
                            <option value="">All</option>
                            @for($y = now()->year; $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                            Filter
                        </button>
                    </div>
                </form>
                
                  <table class="w-full min-w-[640px] table-auto">
                    <thead>
                      <tr>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                          <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Equipments</p>
                        </th>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                          <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Borrowed Count</p>
                        </th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($mostBorrowed as $item)
                      <tr>
                          <td class="py-3 px-5 border-b border-blue-gray-50">
                              <div class="flex items-center gap-4">
                                  <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">
                                      {{ $item->equipment->name ?? 'Unknown Equipment' }}
                                  </p>
                              </div>
                          </td>
                          <td class="py-3 px-5 border-b border-blue-gray-50">
                              <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">
                                  {{ $item->total }}
                              </p>
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
</x-spmo_layout>