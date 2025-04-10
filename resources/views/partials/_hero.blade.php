<section class="relative h-72  flex flex-col justify-center align-center text-center space-y-4 mb-4 mt-20 pt-20 ">
  <!-----src="{{ asset('images/umak_logo.png') }}"------>
      <!-- component -->
  <!-- component -->
  <head>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      
      
      <section class="relative h-80 flex flex-col justify-center items-center text-center space-y-4 mb-4 mt-20 py-20">
        <div x-data="carousel()" x-init="init()" class="relative w-full min-h-screen overflow-hidden">
    
            <!-- Slides -->
            <div class="relative w-full h-full">
                <!-- Slide 1 -->
                <div x-show="current === 0" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/welcome_herons.jpg') }}');"></div>
                    <div class="absolute inset-0 bg-black/30 "></div>
                </div>
    
                <!-- Slide 2 -->
                <div x-show="current === 1" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/welcome_herons.jpg') }}');"></div>
                    <div class="absolute inset-0 bg-black/30 "></div>
                </div>
    
                <!-- Slide 3 -->
                <div x-show="current === 2" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/welcome_herons.jpg') }}');"></div>
                    <div class="absolute inset-0 bg-black/30 "></div>
                </div>
    
                <!-- Slide 4 -->
                <div x-show="current === 3" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('images/welcome_herons.jpg') }}');"></div>
                    <div class="absolute inset-0 bg-black/30 "></div>
                </div>
            </div>
    
            <!-- Arrows -->
            <button @click="prev" class="absolute top-1/2 -translate-y-1/2 left-6 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full backdrop-blur-md transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </button>
    
            <button @click="next" class="absolute top-1/2 -translate-y-1/2 right-6 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full backdrop-blur-md transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
            </button>
    
            <!-- Dots -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2">
                <template x-for="i in total">
                    <button 
                        @click="goTo(i - 1)"
                        class="w-3 h-3 rounded-full bg-white/50 hover:bg-white/70 transition"
                        :class="current === (i - 1) ? 'bg-white' : ''">
                    </button>
                </template>
            </div>
            <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2 text-white space-y-2">
              <h2 class="text-4xl font-semibold">Uniconnect</h2>
              <p class="text-lg">Stay Connected to our university Events</p>
          </div>
        </div>
    </section>
    
    <script>
        function carousel() {
            return {
                current: 0, // Starts at the first image
                total: 4, // Number of total images in the slider
                images: [
                    'https://source.unsplash.com/1600x900/?technology',
                    'https://source.unsplash.com/1600x900/?startup',
                    'https://source.unsplash.com/1600x900/?conference',
                    'https://source.unsplash.com/1600x900/?innovation'
                ],
                init() {
                    this.startAutoplay();
                },
                startAutoplay() {
                    setInterval(() => {
                        this.next(); // Automatically move to the next slide
                    }, 6000); // Slide changes every 6 seconds
                },
                next() {
                    this.current = (this.current + 1) % this.total; // Loop through images
                },
                prev() {
                    this.current = (this.current - 1 + this.total) % this.total; // Go to previous image
                },
                goTo(index) {
                    this.current = index; // Go to specific slide
                }
            };
        }
    </script>
    
    
      </body>
  </section>
  