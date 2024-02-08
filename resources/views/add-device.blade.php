<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Václav Žižkovský">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{url('css/general.css')}}">
    <link rel="stylesheet" href="{{url('css/add-device.css')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('/assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('/assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('/assets/favicon/site.webmanifest')}}">
    <script src="{{url('/js/general.js')}}"></script>
    <script src="{{url('/js/add-device.js')}}"></script>
    <title>Add new device – DropX</title>
</head>

<body>
    <header>
        <img src="{{url('/assets/images/logo.png')}}" alt="DropX logo" id="logo">
        <h1>Add new device</h1>
    </header>

    <main>
        <p>Enter the code of the device you want to connect and then click on the button</p>
        <form action="{{url('add-device')}}" method="POST" id="add-device-form" autocomplete="off">
            <span>Code of this device:</span>
            <span id="this-device-code">032540</span>
            <input type="text" name="code" placeholder="Code" id="device-code-input" pattern="[0-9]{6}" required>
            <button type="submit" id="add-device-button">Connect devices</button>
        </form>
    </main>
</body>

</html>