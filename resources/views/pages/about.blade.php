<x-layout>

    <div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32 pt-24">
        <img src="{{ asset('images/umakadmin.jpg') }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
        <div class="absolute inset-0 bg-black opacity-50 -z-10"></div>
        <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl" aria-hidden="true">
          <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu" aria-hidden="true">
          <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-5xl font-semibold tracking-tight text-white sm:text-7xl">Uniconnect</h2>
            <p class="mt-8 text-pretty text-lg font-medium text-white sm:text-xl/8">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat.</p>
          </div>
          <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 text-base/7 font-semibold text-white sm:grid-cols-2 md:flex lg:gap-x-10">
              <a href="#">Register <span aria-hidden="true">&rarr;</span></a>
              <a href="#">Login <span aria-hidden="true">&rarr;</span></a>
              <a href="#">Get the Updates on Events <span aria-hidden="true">&rarr;</span></a>
              <a href="#">Attend <span aria-hidden="true">&rarr;</span></a>
              <a href="/pages/eventattended">Feedback <span aria-hidden="true">&rarr;</span></a>
            </div>
            <dl class="mt-16 grid grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
              <div class="flex flex-col-reverse gap-1">
                <dt class="text-base/7 text-white">Colleges</dt>
                <dd class="text-4xl font-semibold tracking-tight text-white">  {{ $organizationCount }}</dd>
              </div>
              <div class="flex flex-col-reverse gap-1">
                <dt class="text-base/7 text-white">Users</dt>
                <dd class="text-4xl font-semibold tracking-tight text-white">{{ $userCount }}</dd>
              </div>
              <div class="flex flex-col-reverse gap-1">
                <dt class="text-base/7 text-white"> Events</dt>
                <dd class="text-4xl font-semibold tracking-tight text-white">{{ $listingCount }}</dd>
              </div>
              
            </dl>
          </div>
        </div>
      </div>
      
</x-layout>

@include('partials._footer')