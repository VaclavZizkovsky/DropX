<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Václav Žižkovský">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('/css/general.css')}}">
    <link rel="stylesheet" href="{{url('/css/layout.css')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <script src="{{url('/js/general.js')}}"></script>
    @yield('head')
</head>

<body>
    <nav>
        <ul>
            <li><a href="{{url('/')}}">Send file</a></li>
            <li><a href="{{url('/devices')}}">Devices</a></li>
            <li><a href="{{url('/log')}}">File log</a></li>
        </ul>
    </nav>

    <main>
        <header>
            <h1>
                @yield('h1')
            </h1>
        </header>
        @yield('main')
        <footer>
            <span class="author">&copy; Václav Žižkovský 2024</span>
        </footer>
    </main>

</body>

</html>