<!doctype html>
<head>
    <title>Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
 
    @vite(['resources/scss/index.scss', 'resources/js/app.js'])
</head>
<body>
    @if (Auth::check())
    <script>
        window.Laravel = {!! json_encode([
            'isLoggedIn'=> true,
            'user'=> Auth::user()
        ]) !!};
    </script>
    @else
    <script>
        window.Laravel = {!! json_encode([
            'isLoggedIn'=> false
        ]) !!};
    </script>
    @endif
    <div id="app"></div>
</body>
