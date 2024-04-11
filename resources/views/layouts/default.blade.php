<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Václav Žižkovský">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('/css/general.css')}}">
    <link rel="stylesheet" href="{{url('/css/layout.css')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <script src="{{url('/js/general.js')}}" defer></script>
    @yield('head')
</head>

<body>
    <nav>
        <ul>
            <li><a href="{{url('/')}}">Send</a></li>
            <li>
                <a href="{{url('/log')}}">Incoming</a>
                @if(auth()->user()->getTransfers('to', 'sent')->count() > 0)
                <span class="notification-label">{{auth()->user()->getTransfers('to', 'sent')->count()}}</span>
                @endif
            </li>
            <li>
                <a href="{{url('/devices')}}">Devices</a>
                @if(auth()->user()->getConnections('to', 'pending')->count() > 0)
                <span class="notification-label">{{auth()->user()->getConnections('to', 'pending')->count()}}</span>
                @endif
            </li>
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

    <section class="modal">
        <div class="modal-content">
            <span class="modal-text">
                This modal shouldn't appear with this text. 
                Please contact <a href="mailto:vaclav.zizkovsky@gmail.com">vaclav.zizkovsky@gmail.com</a> to report this issue.
            </span>
            <div class="modal-buttons">

            </div>
        </div>
    </section>
</body>

</html>