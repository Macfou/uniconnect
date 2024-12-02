<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#111827",  
                    },
                },
            },
        };
    </script>
    <title>UMak Events</title>


</head>


    <body class="mb-48 bg-center bg-cover bg-no-repeat h-screen bg-fixed bg-gray-100" >      
   
        

        <nav class="bg-white dark:bg-gray-900 fixed w-full z-50 top-0 start-0 border-b border-gray-200 dark:border-gray-600 ">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
              <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/uniconnect_logo.png') }}" class="h-8 sm:h-10 md:h-12 lg:h-16" alt="Uniconnect Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
              </a>
              <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <!-- account button start--->
                <div class="relative inline-block text-left">
                  
                   @auth
                   <p id="account-btn" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">
                    <i class="fa-solid fa-user pr-4"></i>{{ucfirst(auth()->user()->fname)}}
                </p>
            
                <!-- Dropdown Menu -->
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-20">
                    <div class="py-1">
                        <a href="/editaccount" class="font-normal block px-4 py-2 text-black hover:bg-gray-100 hover:!text-white dark:text-white dark:hover:bg-gray-700">
                          <i class="fa-solid fa-gear pr-4"></i> Manage Account
                        </a>
                        <form class="inline" method="POST" action="/logout">
    @csrf
    <button type="submit" class="font-normal block px-4 py-2 text-black hover:bg-gray-100 hover:!text-white dark:text-white dark:hover:bg-gray-700">
        <i class="fa-solid fa-door-closed pr-4"></i>Logout
    </button>
</form>

                    </div>
                </div>
            </div>
            @else

                    
                  <p id="account-btn" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">
                      <i class="fa-solid fa-user pr-4"></i>Account
                  </p>
              
                  <!-- Dropdown Menu -->
                  <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-20">
                      <div class="py-1">
                          <a href="/login" class="font-normal block px-4 py-2 text-black hover:bg-gray-100 hover:!text-white dark:text-white dark:hover:bg-gray-700">
                            <i class="fa-solid fa-right-to-bracket pr-4"></i>  Login
                          </a>
                          <a href="/register" class="font-normal block px-4 py-2 text-black hover:bg-gray-100 hover:!text-white dark:text-white dark:hover:bg-gray-700">
                            <i class="fa-solid fa-user-plus pr-4"></i>Register
                          </a>
                      </div>
                  </div>
              </div>
              @endauth
                  <!--button end--->
               <!-- <p class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"><i class="fa-solid fa-user pr-4"></i>Account</p>-->
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                  <span class="sr-only">Open main menu</span>
                  <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                  </svg>
                </button>
              </div>
              <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                  <li>
                    <a href="/home" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>
                  </li>
                    @auth

                   
                    @if(auth()->user()->isInAdminUsersTable())

                    <li>
                        <a href="/listings/create" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">My Events</a>
                    </li>
                @endif
                         
      <li>
        <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Events</a>
      </li>

      <li>
        <a href="/announcement" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Announcements</a>
      </li>
      @endauth
     
      <li>      
     <a href="/facility" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Facilities</a>    
    </li>
    
    <li>
      <a href="/about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About Us</a>
    </li>
   
    </ul>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('[data-collapse-toggle]');
        const navbarMenu = document.getElementById('navbar-sticky');
        
        toggleButton.addEventListener('click', function() {
            navbarMenu.classList.toggle('hidden');
        });
    });
</script>

</nav>
<script>
  const accountBtn = document.getElementById('account-btn');
  const dropdownMenu = document.getElementById('dropdown-menu');

  accountBtn.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
  });

  // Optionally close the dropdown if clicked outside of it
  window.addEventListener('click', (e) => {
      if (!accountBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
      }
  });
  const toggleSidebar = document.getElementById('toggleSidebar');
	const sidebar = document.getElementById('sidebar');
  
	toggleSidebar.addEventListener('click', () => {
	  sidebar.classList.toggle('hidden');
	});
</script>

        
         
              
        
    </div>

    <button
  id="toggleSidebar"
  class="fixed top-4 left-4 z-50 p-2 bg-white text-laravel rounded-md shadow-lg md:hidden"
  aria-label="Toggle Sidebar">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
  </svg>
</button>
<section id="sidebar" class="hidden fixed inset-0 pt-20 z-40 bg-white shadow-lg md:block md:static md:w-64">
   
<div class="max-w-2xl mx-auto fixed   left-0 p-4 bg-white rounded shadow-lg">

	<aside class="w-64" aria-label="Sidebar">
		<div class="px-3 py-4 overflow-y-auto rounded">
			<ul class="space-y-2">
				<li>
					<a href="/listings/create"
						class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300">
						<svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M19 4h-1V2a1 1 0 10-2 0v2H8V2a1 1 0 10-2 0v2H5a3 3 0 00-3 3v12a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm1 15a1 1 0 01-1 1H5a1 1 0 01-1-1V10h16v9zm-7-8a1 1 0 00-1 1v2h-2a1 1 0 000 2h2v2a1 1 0 002 0v-2h2a1 1 0 000-2h-2v-2a1 1 0 00-1-1z"></path>
						</svg>
						
                          
						<span class="ml-3 font-bold text-laravel">Add Events</span>
					</a>
				</li>
				<li>
					<a href="/manage_all"
						class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300">
						<svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2a1 1 0 00-.447.105l-9 4a1 1 0 000 1.79l2.302 1.022-.735 4.407A1 1 0 005 14.923l6.276-2.509 6.275 2.509a1 1 0 001.18-1.207l-.734-4.407 2.302-1.022a1 1 0 000-1.79l-9-4A1 1 0 0012 2zm6.382 9.018L12 9.203l-6.382 1.815L12 12.733l6.382-1.715zM12 16a1 1 0 00-1 1v3H8v-3a1 1 0 00-2 0v3a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 00-2 0v3h-3v-3a1 1 0 00-1-1z"></path>
                          </svg>
                          
						<span class="ml-3 font-bold text-laravel">Manage Events</span>
					</a>
				</li>
				
				{{------------ttry-----------------}}
				<li>
					<a href="/officers"
						class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300">
						<svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
             d="M10 2a1 1 0 011 1v2.586l1.293 1.293a1 1 0 001.414 0l1.293-1.293V3a1 1 0 112 0v2.586l1.293 1.293a1 1 0 001.414 0l1.293-1.293V3a1 1 0 012 0v5a1 1 0 01-.293.707l-2.293 2.293a1 1 0 01-1.414 0l-1.293-1.293V11a1 1 0 01-.707.293H7.707A1 1 0 017 11V8.414L5.707 9.707a1 1 0 01-1.414 0L2 7.414V3a1 1 0 112 0v2.586l1.293 1.293a1 1 0 001.414 0L7 5.586V3a1 1 0 011-1z"
              clip-rule="evenodd" />
            <path
        d="M10 12a1 1 0 01.874.514l2 4a1 1 0 11-1.748.972l-.626-1.252H8.5l-.626 1.252a1 1 0 01-1.748-.972l2-4A1 1 0 0110 12z" />
         </svg>

						
						<span class="flex-1 ml-3 whitespace-nowrap text-laravel font-bold">Officers</span>
						
					</a>
				</li>

				{{---Certificate----------}}

				<li>
					<a href="/certificates/create"
						class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300">
						<svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
							fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
							</path>
						</svg>
						<span class="flex-1 ml-3 whitespace-nowrap text-laravel font-bold">Create Certificate</span>
						
					</a>
				</li>

				
				<li>
					<a href="#"
						class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-300">
						<svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
							fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
							</path>
						</svg>
						<span class="flex-1 ml-3 whitespace-nowrap text-laravel font-bold">Attendees</span>
						
					</a>
				</li>
				
				
				
			</ul>
		</div>
	</aside>
</div>

    <main class="container">
        {{$slot}}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
  
</body>
</html>
