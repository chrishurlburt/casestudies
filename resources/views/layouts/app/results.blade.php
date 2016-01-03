@extends('base')

@if(!$studies->isEmpty())

<div class="row">
    <div class="col-lg-12">
        @foreach($studies as $study)
            <a href="#"><h4>{{ $study->title }}</h4></a>
        @endforeach
    </div>
</div>

@endif
