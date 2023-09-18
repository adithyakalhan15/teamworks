
@extends('template')
{{--
@php
    $title = $author->GetNameWithInitials();    
@endphp
--}}
@section('main_content')
    <h3>Login</h3>
    <form action="/user/login" method="post">
        @csrf
        <input type="text" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit">LOGIN</button> 
        &nbsp;
        &nbsp;
        <a href="/user/register">REGISTER</a>
    </form>
@endsection
