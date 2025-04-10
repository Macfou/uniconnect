<x-layout>

    @include('partials._hero')
    <section>
        <!-- First Section -->
        <div 
        class="fixed inset-0 bg-cover bg-center -z-10"
        style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
    </div>

    <!-- Black Overlay -->
    <div class="fixed inset-0 bg-black opacity-50 -z-10"></div>

        <div class="my-20 z-20 pt-64">
            <div class="px-4 py-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-8">
                <div class="flex flex-col lg:flex-row items-center justify-between w-full mb-10">
                    <!-- Text content -->
                    <div class="mb-16 lg:mb-0 lg:max-w-lg lg:pr-5">
                        <div class="max-w-xl mb-6">
                            <h2 class="font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none max-w-lg mb-6">
                                Lorem Ipsum Is Cool.
                            </h2>
                            <p class="text-white font-bold text-base md:text-lg">
                                Lorem Ipsum is so cool and awesome to act and so cool to think. And very awesome to eat and talk.
                            </p>
                        </div>
                        @guest
                        <div class="flex items-center space-x-3">
                            <Link href="/comingsoon">
                                <a class="flex items-center text-white border border-2 justify-center w-full sm:px-10 py-4 leading-6 bg-laravel rounded-lg font-black">
                                    &nbsp;&nbsp;&nbsp;&nbsp; Register Now!
                                </a>
                            </Link>
                        </div>
                        @endguest
                    </div>
    
                    <!-- Image beside the text, but outside of the box -->
                    <div class="relative lg:ml-[-90px] z-10">
                        <img class="rounded-lg shadow-lg" alt="logo" width="450" height="450" src="{{ asset('images/umak_after-event.jpg') }}" />
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Second Section -->
        <div class="my-20 z-20  px-6 bg-laravel">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col lg:flex-row items-center justify-between w-full mb-10">
                    <!-- Image beside the text, but outside of the box -->
                    <div class="relative lg:mr-[-80px] z-10">
                        <img class="rounded-lg shadow-lg" alt="logo" width="450" height="450" src="{{ asset('images/umak_event.jpg') }}" />
                    </div>
    
                    <!-- Text content -->
                    <div class="mb-16 lg:mb-0 lg:max-w-lg lg:pl-5">
                        <div class="max-w-xl mb-6">
                            <h2 class="font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none max-w-lg mb-6">
                                 Awesome Is Lorem Ipsum
                            </h2>
                            <p class="text-white text-base md:text-lg">
                                Lorem Ipsum is so cool and awesome to act and so cool to think. And very awesome to eat and talk.
                            </p>
                        </div>
                        @guest
                        <div class="flex items-center space-x-3">
                            <Link href="/comingsoon">
                                <a class="flex items-center text-white border border-2 justify-center w-full sm:px-10 py-4 leading-6 bg-laravel rounded-lg font-black">
                                    &nbsp;&nbsp;&nbsp;&nbsp; Sigin NoW!
                                </a>
                            </Link>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   
    <section class="pb-20">
        <h2 class="text-3xl font-bold text-white text-center mb-6">Events</h2>
    
        <div class="max-w-7xl mx-auto my-8 px-2">
            <ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-2 xl:p-5">
                @forelse($previousEvents->take(3) as $event)
                    <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-primary-400">
                        <a class="relative" href="/tool/writey-ai">
                            <div class="relative w-full aspect-video">
                                <img class="rounded w-full h-[280px] object-cover"
                                     src="{{ $event->image ? asset('storage/' . $event->image) : asset('/images/no-image.png') }}" alt="Event">
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-laravel text-white">
                                    <h2 class="text-xl font-semibold">{{ $event->tags }}</h2>
                                </div>
                            </div>
                        </a>
            
                        <div class="flex flex-col justify-between gap-3 px-4 py-2">
                            <p><strong>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }} at {{$event->event_time}}</strong></p>
                            <h3 class="text-sm font-medium text-laravel">
                                <a href="/listings/{{ $event->id }}/previous">See more Info...</a>
                            </h3>
                        </div>
                    </li>
                @empty
                    <div class="p-4 text-center text-lg font-bold pb-80">
                        No Previous events.
                    </div>
                @endforelse
            </ul>
            
        </div>
    
        <div class="flex items-center justify-center">
            <a href="/" class="flex items-center text-white px-4 py-2 sm:px-6 bg-blue-600 hover:bg-laravel rounded-lg font-black cursor-pointer transition-colors duration-300">
                View More...
            </a>
        </div>
        
        
        
    
    
</x-layout>
@include('partials._footer')