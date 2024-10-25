@props(['organizationsCsv'])

@php
 $organizations = explode(',', $organizationsCsv);
@endphp

<ul class="flex">
 
    @foreach($organizations as $organization)
    <li class="border flex items-center justify-center bg-black opacity-80 text-white rounded-xl py-1 px-3 mr-2 text-xs">
      <a href="/?organization={{$organization}}">{{$organization}}</a>
    </li>
    @endforeach

  
</ul>
