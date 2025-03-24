<x-layout>
   
   
      <x-card class=" pt-32">
        <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
        </a>
</x-card>



<div class="sm:mb-10 lg:grid lg:grid-cols-5 md:grid-cols-none md:bg-gray-300 bg-gray-300 lg:bg-white lg:h-full">
    <div class=" px-10 py-10 max-w-md m-auto lg:col-span-2 mt-20 mb-20 shadow-xl rounded-xl lg:mt-10 md:shadow-xl md:rounded-xl lg:shadow-none lg:rounded-none lg:w-full lg:mb-10 lg:px-5 lg:pt-5 lg:pb-5 lg:max-w-lg bg-white">
    
      <div class="flex items-center">
        <!-- Organization Logo -->
        
        <img class="h-10 mr-4" src="{{ asset('storage/logos/' . $organization->orgLogo) }}" alt="{{ strtoupper($organization->orgNameAbbv) }} Logo">

    
        <!-- Organization Name -->
        <p class="text-lg font-semibold">{{ ucwords(strtolower($organization->orgName)) }}</p>
    </div>
    

      <img class="h-64 sm:h-52 sm:w-full sm:object-cover lg:hidden object-center mt-2 rounded-lg shadow-2xl" src="{{$listing->image ? asset('storage/' . $listing->image) : asset('/images/no-image.png')}}" alt="Image">
      <p>What: <strong>{{$listing->tags}}</strong></p>
      <p>Where: <strong>{{$listing->venue}}</strong></p>
      <p>When: <strong>{{ \Carbon\Carbon::parse($listing->event_date)->format('F j, Y') }} at {{$listing->event_time}}</strong></p>
      <p>For: <x-listing-organizations :organizationsCsv="$listing->organization" /> </p> 
      <h1 class="font-bold text-lg text-gray-600"></h1>
      <h1 class="text-lg text-gray-600 text-justify pt-2 p-10">{{$listing->description}}</h1>
      <a href="{{ route('event.register', $listing->id) }}" class="mt-5 bg-blue-500 p-3 rounded-xl text-white font-bold hover:bg-blue-700">
        Register Now
    </a>
    
    </div>

    <div class="hidden relative lg:block  lg:col-span-3">
      <img class="absolute inset-0 w-full h-full object-cover rounded object-center" src="{{$listing->image ? asset('storage/' . $listing->image) : asset('/images/no-image.png')}}" alt="Event Image">
    </div>
</div>

       
</x-layout>

@include('partials._footer')