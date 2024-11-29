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

	
    <script >
	
  const toggleSidebar = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');

  toggleSidebar.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
  });
</script>
	</script>
</div>
</section>