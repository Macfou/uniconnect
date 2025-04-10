<x-layout>
  <div class="bg-gray-100 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">📣 Announcements</h2>
        <p class="mt-4 text-lg text-gray-600">Stay informed with the latest updates from your organization.</p>
      </div>

      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3 lg:max-w-none">
        @forelse ($announcements as $announcement)
          <article class="relative flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-shadow duration-300">
            <div class="flex-1 p-6 flex flex-col justify-between">
              <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                <time datetime="{{ $announcement->created_at }}">
                  {{ $announcement->created_at->format('M d, Y') }}
                </time>
                <span class="bg-laravel text-white px-2 py-1 rounded text-xs">{{ $announcement->org }}</span>
              </div>

              <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 hover:text-laravel transition-colors duration-200">
                  <a href="#">
                    <span class="absolute inset-0"></span>
                    {{ $announcement->title }}
                  </a>
                </h3>
                <p class="mt-3 text-sm text-gray-600 line-clamp-3">
                  {{ $announcement->description }}
                </p>
              </div>
            </div>

            <div class="flex items-center gap-x-4 px-6 py-4 bg-gray-50 border-t">
              <img src="{{ asset('images/logo/umak_ccis_logo.png') }}" class="h-10 w-10 rounded-full object-cover" alt="Logo">
              <div class="text-sm">
                <p class="font-medium text-gray-900">
                  <a href="#">
                    {{ $announcement->user->lname ?? 'Unknown' }}
                  </a>
                </p>
                <p class="text-gray-500">Posted by</p>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-full text-center py-20">
            <p class="text-gray-600 text-lg">No announcements available at the moment.</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>

  @include('partials._footer')
</x-layout>
