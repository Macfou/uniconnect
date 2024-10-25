<x-layout>

    @include('partials._hero')
    <section>
        <!-- First Section -->
        <div class="my-20 z-20 rounded-3xl px-6 bg-white">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col lg:flex-row items-center justify-between w-full mb-10">
                    <!-- Text content -->
                    <div class="mb-16 lg:mb-0 lg:max-w-lg lg:pr-5">
                        <div class="max-w-xl mb-6">
                            <h2 class="font-sans text-3xl font-bold tracking-tight text-laravel sm:text-4xl sm:leading-none max-w-lg mb-6">
                                Lorem Ipsum Is Cool.
                            </h2>
                            <p class="text-laravel text-base md:text-lg">
                                Lorem Ipsum is so cool and awesome to act and so cool to think. And very awesome to eat and talk.
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <Link href="/comingsoon">
                                <a class="flex items-center text-white border border-2 justify-center w-full sm:px-10 py-4 leading-6 bg-laravel rounded-lg font-black">
                                    &nbsp;&nbsp;&nbsp;&nbsp; Register Now!
                                </a>
                            </Link>
                        </div>
                    </div>
    
                    <!-- Image beside the text, but outside of the box -->
                    <div class="relative lg:ml-[-80px] z-10">
                        <img class="rounded-lg shadow-lg" alt="logo" width="450" height="450" src="{{ asset('images/umak_after-event.jpg') }}" />
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Second Section -->
        <div class="my-20 z-20 rounded-3xl px-6 bg-white">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col lg:flex-row items-center justify-between w-full mb-10">
                    <!-- Image beside the text, but outside of the box -->
                    <div class="relative lg:mr-[-80px] z-10">
                        <img class="rounded-lg shadow-lg" alt="logo" width="450" height="450" src="{{ asset('images/umak_event.jpg') }}" />
                    </div>
    
                    <!-- Text content -->
                    <div class="mb-16 lg:mb-0 lg:max-w-lg lg:pl-5">
                        <div class="max-w-xl mb-6">
                            <h2 class="font-sans text-3xl font-bold tracking-tight text-laravel sm:text-4xl sm:leading-none max-w-lg mb-6">
                                 Awesome Is Lorem Ipsum
                            </h2>
                            <p class="text-laravel text-base md:text-lg">
                                Lorem Ipsum is so cool and awesome to act and so cool to think. And very awesome to eat and talk.
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <Link href="/comingsoon">
                                <a class="flex items-center text-white border border-2 justify-center w-full sm:px-10 py-4 leading-6 bg-laravel rounded-lg font-black">
                                    &nbsp;&nbsp;&nbsp;&nbsp; Sigin NoW!
                                </a>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Third Section -->
        <div class="my-20 z-20 rounded-3xl px-6 bg-white">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col lg:flex-row items-center justify-between w-full mb-10">
                    <!-- Text content -->
                    <div class="mb-16 lg:mb-0 lg:max-w-lg lg:pr-5">
                        <div class="max-w-xl mb-6">
                            <h2 class="font-sans text-3xl font-bold tracking-tight text-laravel sm:text-4xl sm:leading-none max-w-lg mb-6">
                                Step 3 : Cool and awesome is lorem ipsum
                            </h2>
                            <p class="text-laravel text-base md:text-lg">
                                Lorem Ipsum is so cool and awesome to act and so cool to think. And very awesome to eat and talk.
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <Link href="/comingsoon">
                                <a class="flex items-center text-white border border-2 justify-center w-full sm:px-10 py-4 leading-6 bg-black rounded-lg font-black">
                                    &nbsp;&nbsp;<img width="20" height="20" src="https://upload.wikimedia.org/wikipedia/commons/archive/5/53/20200429221626%21Google_%22G%22_Logo.svg" alt="google auth logo" />&nbsp;&nbsp; Get Started
                                </a>
                            </Link>
                        </div>
                    </div>
    
                    <!-- Image beside the text, but outside of the box -->
                    <div class="relative lg:ml-[-80px] z-10">
                        <img alt="logo" width="450" height="450" src="https://images.unsplash.com/photo-1546195643-70f48f9c5b87?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
</x-layout>
@include('partials._footer')