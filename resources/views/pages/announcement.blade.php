<x-layout>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Announcements</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">Check out the latest announcements below.</p>
      </div>
      <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @forelse ($announcements as $announcement)
          <article class="flex max-w-xl flex-col items-start justify-between">
            <div class="flex items-center gap-x-4 text-xs">
              <time datetime="{{ $announcement->created_at }}" class="text-gray-500">
                {{ $announcement->created_at->format('M d, Y') }}
              </time>
            </div>
            <div class="group relative">
              <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="#">
                  <span class="absolute inset-0"></span>
                  {{ $announcement->title }}
                </a>
              </h3>
              <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                {{ $announcement->description }}
              </p>
            </div>
            <div class="relative mt-8 flex items-center gap-x-4">
              <img src="{{ asset('images/logo/umak_ccis_logo.png') }}" class="h-10 w-10 rounded-full bg-gray-50">
              <div class="text-sm leading-6">
                <p class="font-semibold text-gray-900">
                  <a href="#">
                    <span class="absolute inset-0"></span>
                    {{ $announcement->user->lname ?? 'Unknown' }}
                  </a>
                </p>
                <p class="text-gray-600">
                  {{ $announcement->org }}
                </p>
              </div>
            </div>
          </article>
        @empty
          <p class="text-gray-600">No announcements available at the moment.</p>
        @endforelse
      </div>
    </div>
  </div>

  @include('partials._footer')
</x-layout>
