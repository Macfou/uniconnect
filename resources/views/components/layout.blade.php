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
                    @auth

                   
                    @if(auth()->user()->isInAdminUsersTable())

                    <li>
                        <a href="/listings/create" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">My Events</a>
                    </li>
                @endif
                         
      <li>
        <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Events</a>
      </li>
      @endauth
      <li>
        <a href="/home" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>
      </li>
      <li>
        <a href="/announcement" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Feedback</a>
      </li>
      <li>
       
     <a href="/facility" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Facilities</a>
      
              {{-----------------------------------------------}}
          
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
</script>

        
         
              
        
    </div>
    <main class="container">
        {{$slot}}
    </main>
   
</body>
</html>