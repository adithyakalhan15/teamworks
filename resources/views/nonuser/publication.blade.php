@extends('template')

@php
    $title = $publication->title;    
@endphp

@section('custom_header')
    @include('components.headers.header', ['publication' => $publication])
    @include('components.search_bar')
@endsection

@section('main_content')
    @include('nonuser.inc.publication_table')
@endsection
