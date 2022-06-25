@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv);
@endphp


  @foreach($tags as $tag)

    <a href="/Listings/?tag={{$tag}}"><button class="btn btn-primary rounded">{{$tag}}</button></a>

  @endforeach
