@extends('template')

@php
    $title = $author->GetNameWithInitials();    
@endphp

@section('main_content')
    @include('nonuser.inc.author_table')
@endsection
