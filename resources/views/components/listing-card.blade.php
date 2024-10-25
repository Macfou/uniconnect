@props(['listing'])

<x-card class="bg-white shadow-md">
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block"
        src="{{$listing->image ? asset('storage/' . $listing->image) : asset('/images/no-image.png')}}" alt="" />
        <div>
            
            <h3 class="text-2xl text-laravel">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4 text-laravel">{{$listing->tags}}</div>

            <x-listing-organizations :organizationsCsv="$listing->organization" />

           
            <div class="text-lg mt-4 text-laravel">
                <i class="fa-solid fa-location-dot text-laravel"></i>{{$listing->venue}}
            </div>
        </div>
    </div>
</x-card>