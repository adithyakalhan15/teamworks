<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @isset($title)
            {{$title}}
        @else
            USJ PUB
        @endisset
    </title>
</head>
<body>
    {{--header section --}}
    @hasSection ('custom_header')
        @yield('custom_header')
    @else
        @include('components.headers.header')
        @include('components.search_bar')
    @endif


    {{--main section --}}
    @hasSection ('main_content')
        @yield('main_content')
    @endif

    {{--footer --}}
    @hasSection ('custom_footer')
        @yield('custom_footer')
    @else
        @include('components.footers.footer')
    @endif

</body>
</html>