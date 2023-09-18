@extends('template')

@php
    $title = 'USJ PUB';    
@endphp

@section('main_content')
    @include('components.publication_results')

    
    @isset($pagination)
        {!! $pagination !!}
    @endisset

@endsection
