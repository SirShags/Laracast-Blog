{{-- This layout is using template inheretance --}}
<!doctype html>

<title> My Blog </title>
<link rel="stylesheet" type="text/css" href="/app.css">

<body>
    @yield('content')
</body>


{{--This layout is using blade components

<!doctype html>

<title> My Blog </title>
<link rel="stylesheet" type="text/css" href="/app.css">

<body>
    {{ $slot }}
</body> --}}
