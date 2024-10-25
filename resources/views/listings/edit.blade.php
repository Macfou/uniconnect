<x-layout>
  <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
      <div class="max-w-[1000px] mx-auto position:sticky pt-20 pl-32">
          <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
                  <div class="container max-w-screen-lg mx-auto">
                      <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                              <div class="text-gray-600">
                                  <p class="font-medium text-black text-lg">Update: <strong>{{$listing->tags}}</strong></p>
                                  <p>Please fill out all the fields.</p>
                              </div>
                              <div class="lg:col-span-2">
                                  <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                      <div class="md:col-span-5">
                                          <label for="tags">Title</label>
                                          <input type="text" name="tags" id="tags" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$listing->tags}}" />
                                      </div>
                                      <div class="md:col-span-5">
                                          <label for="title">Organization</label>
                                          <input type="text" name="title" id="title" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$listing->title}}" />
                                      </div>
                                      <div class="md:col-span-2">
                                          <label for="venue">Venue</label>
                                          <input type="text" name="venue" id="venue" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$listing->venue}}" />
                                      </div>
                                      <div class="md:col-span-3">
                                          <label for="organization">Organization Involve</label>
                                          <input type="text" name="organization" id="organization" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$listing->organization}}" />
                                      </div>
                                      <div class="md:col-span-3">
                                          <label for="event_date">Select Date</label>
                                          <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                              <input type="date" name="event_date" id="event_date" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="{{$listing->event_date}}" />
                                          </div>
                                          @error('event_date')
                                          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                          @enderror
                                      </div>
                                      <div class="md:col-span-2">
                                          <label for="event_time">Select Time</label>
                                          <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                              <input type="time" name="event_time" id="event_time" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="{{$listing->event_time}}" />
                                          </div>
                                          @error('event_time')
                                          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                          @enderror
                                      </div>
                                      <div class="md:col-span-5">
                                          <label for="image">Upload Image</label>
                                          <input type="file" name="image" id="image" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                          @error('image')
                                          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                          @enderror
                                      </div>
                                      <div class="md:col-span-5">
                                          <label for="description">Description</label>
                                          <textarea class="bg-gray-50 text-black border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Description about event">{{$listing->description}}</textarea>
                                          @error('description')
                                          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                          @enderror
                                      </div>
                                      <div class="md:col-span-5 text-right">
                                          <button class="bg-laravel hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Update Event</button>
                                          <a href="/" class="text-black ml-4"> Back </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
</x-layout>
