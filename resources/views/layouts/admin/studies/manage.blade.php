@extends('admin-base')


@section('content')

@foreach($studies as $study)
<h2><a href="/case/{{ $study->slug }}">{{ $study->name }}</a></h2>
    <ul>
    @foreach($study->keywords as $studykeyword)
       <li>{{ $studykeyword->name}}</li>
    @endforeach
    </ul>
@endforeach

@stop