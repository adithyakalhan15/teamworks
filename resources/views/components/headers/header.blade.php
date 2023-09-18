<br>
<br>
<br>
<style>
    body{
        font-family: 'Times New Roman', sans-serif;
        font-size: 16px;
        margin: 0;
        padding: 16px 32px;
    }
    /*Dark mode*/
    @media (prefers-color-scheme: dark) {
        body{
            background-color: #000000;
            color: #a7a7a7 !important;
        }
        input, button{
            background-color: #000000;
        }
        *{
            color: #a7a7a7 !important;
        }
    }

</style>
<center>
    @isset($publication)
        <h1>{{$publication->title}}</h1>
    @else
        <h1>WELCOME TO USJ PUB</h1>    
    @endisset
    @auth
    <h2>{{ auth()->user()->first_name }} --> {{ auth()->user()->email }} </h2>
    @else
    <h2>PLEASE LOGIN TO CONTINUE</h2>
    @endauth

    <div>
        <a href="/">HOME</a>
        &nbsp;
        &nbsp;
        &nbsp;

        @auth
        <a href="/user/profile">MY ACCOUNT</a>
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="/user/logout">LOGOUT</a>
        @else

        <a href="{{ route("login") }}">LOGIN</a>
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="{{ route("register") }}">REGISTER</a>
        @endauth
        
    </div>

    @include('components.messages')
    
</center>

<br>
<br>