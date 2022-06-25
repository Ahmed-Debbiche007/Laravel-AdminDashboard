@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv);
@endphp


  @foreach($tags as $tag)

    <a href="/Products/?tag={{$tag}}"><button class="btn btn-info rounded">{{$tag}}</button></a>

  @endforeach
