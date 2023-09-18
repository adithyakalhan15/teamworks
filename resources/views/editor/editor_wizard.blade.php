@extends('template')

@php
    $title = 'USJ PUB : New Document';    
@endphp

@section('main_content')
    @include('editor.components.editor_wizard_table')
@endsection
