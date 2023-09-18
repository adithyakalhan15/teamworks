@extends('template')

@php
    $title = 'USJ PUB : New Document';    
@endphp

@section('main_content')
    @include('editor.components.quil_editor')
@endsection
