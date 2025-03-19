

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.icon" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <script>
        tailwind.config = {
    theme: {
        extend: {
            colors: {
                laravel: "#111827",  
            },
        },
    },
    plugins: [
        function({ addUtilities }) {
            const newUtilities = {
                '.no-sort-arrow': {
                    '&::after, &::before': {
                        content: 'none !important',
                    },
                },
            }
            addUtilities(newUtilities, ['responsive', 'hover'])
        }
    ]
};
    </script>
    <title>UMak Events</title>


</head>
<body>
    <div class="min-h-screen bg-gray-50/50">
        <aside class="bg-gradient-to-br from-gray-800 to-gray-900 -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
          <div class="relative border-b border-white/20">
            <a class="flex items-center gap-4 py-6 px-8" href="#/">
             
                  <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-white">
                      SPMO
                  </h6>
             
          </a>
            <button class="middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 absolute right-0 top-0 grid rounded-br-none rounded-tl-none xl:hidden" type="button">
              <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </span>
            </button>
          </div>
          <div class="m-4">
            <ul class="mb-4 flex flex-col gap-1">
              <li>
                <a  href="/spmo/spmo_pages/spmo_dashboard">
                  <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 " type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                      <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"></path>
                      <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"></path>
                    </svg>
                    <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">dashboard</p>
                  </button>
                </a>

                <a  href="/spmo/spmo_pages/spmo_category">
                    <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 " type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                        <path fill-rule="evenodd" d="M12 2 3 7v10l9 5 9-5V7l-9-5zm7 7.85V9l-7 3.89L5 9v.85L12 14l7-4.15zM5 17.69V11l7 3.89V20l-7-3.31zm9 3.31v-5.11L19 11v6.69l-5 3.31z" clip-rule="evenodd"/>
                    </svg>
                    
                      <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">Inventory</p>
                    </button>
                  </a>

                 

                  <a  href="/spmo/spmo_pages/spmo_borrowed">
                    <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 " type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                        <path fill-rule="evenodd" d="M8 2h8a2 2 0 0 1 2 2v1h3v17H3V5h3V4a2 2 0 0 1 2-2zm0 2v1h8V4H8zm-2 5h12v2H6v-2zm0 4h12v2H6v-2zm0 4h8v2H6v-2z" clip-rule="evenodd"/>
                    </svg>
                    
                      <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">Borrowed</p>
                    </button>
                  </a>

                  <a  href="/spmo/spmo_pages/spmo_returned">
                    <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 " type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                        <path fill-rule="evenodd" d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-2.34-5.66L15 10h7V3l-2.69 2.69A9.97 9.97 0 0 0 12 2zm1 5h-2v6l5 3 .91-1.63-3.91-2.37V7z" clip-rule="evenodd"/>
                    </svg>
                    
                      <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">History</p>
                    </button>
                  </a>

                <ul class="w-64 bg-gray-900 rounded-md shadow-md">
                    <!-- Dropdown Parent -->
                    <li class="opcion-con-desplegable">
                        <input type="checkbox" id="agendaToggle" class="peer hidden" />
                        <label for="agendaToggle" class="middle  none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4">
                            <div class="flex items-center  ">
                                
                                <span class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium  pr-20">Borrow Request</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs peer-checked:rotate-180 transition-transform"></i>
                        </label>
            
                        <!-- Dropdown Menu -->
                        <ul class="desplegable ml-4 hidden peer-checked:block">
                            <li>
                                <a href="/spmo/spmo_pages/spmo_pending" class="block p-2 hover:bg-gray-700 flex items-center text-white">
                                    
                                    Pending Requests
                                </a>
                            </li>
                            <li>
                                <a href="/spmo/spmo_pages/spmo_approved" class="block p-2 hover:bg-gray-700 flex items-center text-white">
                                    
                                    Approved Requests
                                </a>
                            </li>

                            <li>
                                <a href="/spmo/spmo_pages/spmo_cancelled" class="block p-2 hover:bg-gray-700 flex items-center text-white">
                                    
                                    Cancelled Requests
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                
             
              
            
   
           
          </li>
        </ul>
            <ul class="mb-4 flex flex-col gap-1">
              <li class="mx-3.5 mt-4 mb-2">
                <p class="block antialiased font-sans text-sm leading-normal text-white font-black uppercase opacity-75">auth pages</p>
              </li>

              <a  href="">
                <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 " type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-inherit">
                    <path fill-rule="evenodd" d="M12 2a5 5 0 1 1-5 5 5 5 0 0 1 5-5zm0 2a3 3 0 1 0 3 3 3 3 0 0 0-3-3zm-7 16a7 7 0 0 1 14 0v2H5v-2zm2 0a5 5 0 0 1 10 0H7z" clip-rule="evenodd"/>
                </svg> 
                  <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">Add User</p>
                </button>
              </a>

              <a href="">
                <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 " type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-inherit">
                        <path fill-rule="evenodd" d="M15 14a5 5 0 1 0-6 0 7 7 0 0 0-6 7h2a5 5 0 0 1 10 0h2a7 7 0 0 0-6-7zm-3-2a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm10-1h-2v-2h-2v2h-2v2h2v2h2v-2h2z" clip-rule="evenodd"/>
                    </svg>
                    <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">Profile</p>
                </button>
            </a>
            

              
              

              <li>
                <form id="logout-form" action="{{ route('spmo.logout') }}" method="GET" style="display: none;">
                </form>
                
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                            <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">Logout</p>
                    </button>
                </a>
            </li>
            
              
            </ul>
          </div>
        </aside>
        <div class="p-4 xl:ml-80">
          <nav class="block w-full max-w-full bg-transparent text-white shadow-none rounded-xl transition-all px-0 py-1">
            <div class="flex flex-col-reverse justify-between gap-6 md:flex-row md:items-center">
              <div class="capitalize">
                <nav aria-label="breadcrumb" class="w-max">
                  <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                    <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                     
                    
                    </li>
                   
                  </ol>
                </nav>
                
              </div>
              <div class="flex items-center">
                <div class="mr-auto md:mr-4 md:w-56">
                  <div class="relative w-full min-w-[200px] h-10">
                    <input class="peer w-full h-full bg-transparent text-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-blue-500" placeholder=" ">
                    <label class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal peer-placeholder-shown:text-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-blue-gray-400 peer-focus:text-blue-500 before:border-blue-gray-200 peer-focus:before:border-blue-500 after:border-blue-gray-200 peer-focus:after:border-blue-500">Type here</label>
                  </div>
                </div>
               
               
                  
                  @auth
                  <p id="account-btn" class="block py-2 px-3 text-black rounded hover:underline  cursor-pointer">
                   <i class="fa-solid fa-user pr-4"></i>
               </p>
                  @endauth
                </a>
                <button class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                  <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5 text-blue-gray-500">
                      <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd"></path>
                    </svg>
                  </span>
                </button>
                <button aria-expanded="false" aria-haspopup="menu" id=":r2:" class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                  <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5 text-blue-gray-500">
                      <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z" clip-rule="evenodd"></path>
                    </svg>
                  </span>
                </button>
                
              </div>
            </div>
          </nav>

          <div>
            {{$slot}}
        </div>
          
          
        </div>
      </div>
    
</body>
</html>