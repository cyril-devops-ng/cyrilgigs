<h1>{{$heading}}</h1>
{{-- @if(count($listings) == 0)
<p>No listings found</p>
@endif --}}
@unless (count($listings))
<p>No listings found</p>
@endunless
@foreach ($listings as $listing)
    <h2> <a href="/listing/{{$listing['id']}}">{{$listing['title']}} </a></h2>
    <p> {{$listing['description']}} </p>
@endforeach