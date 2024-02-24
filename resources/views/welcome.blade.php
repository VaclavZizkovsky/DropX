<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Václav Žižkovský">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/general.css" type="text/css">
    <link rel="stylesheet" href="./css/layout.css" type="text/css">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <script src="./js/general.js"></script>
    <script src="./js/welcome.js"></script>
    <link rel="stylesheet" href="./css/welcome.css" type="text/css">
    <title>DropX – file transfer in few clicks</title>
</head>

<body>

    <main>
        <header>
            <h1>DropX — file transfer in few clicks</h1>
        </header>
        <article id="introduction">
            <form action="/create-device" method="post" id="register-device-form" autocomplete="off">
                @csrf
                <input type="text" name="name" id="device-name-input" placeholder="Device name" pattern="^\S.*$"
                    required>
                <input type="hidden" name="type" id="device-type-input" value="desktop">
                <button type="submit" id="register-device-button">Register device</button>
            </form>
            <section id="what-is-section">
                <h2>What is DropX?</h2>
                <p>DropX is a simple application for <strong>quick file transfer</strong> between devices you
                    own. Instead of sending the files through an email or another platform, you can use this
                    easy tool to do it much quicker and for <strong>free</strong>.</p>
                <h2 id="start-using-h2">Start using!</h2>
                <p>To use the application, choose your device name and then click on the register button. You won't even
                    need
                    a password. <a href="#cookie-info">Why?</a> I also recommend reading <a href="#tutorial">how DropX
                        works</a> to understand basic principles and to know how to use it</p>
            </section>
        </article>
        <article id="tutorial">
            <section id="tutorial-section">
                <h2>How does it work?</h2>
                <p>I will be explaining the functionality of the application in the rows below.</p>
                <p>content will be added soon...</p>
                <h3>Registering a device</h3>
                <h3>Connecting two devices</h3>
                <h3>Sending files</h3>
                <h3>Other features</h3>
                <p>The site uses a cookie to remember the device,
                    so you don't need to create a password.</p>
            </section>
        </article>
        <article id="faq">
            <h2>FAQ</h2>
            <p>Here are some of the most asked questions. If you have a question you want to ask, write me an email
                <a href="mailto:vaclav.zizkovsky@gmail.com">vaclav.zizkovsky@gmail.com</a>
            </p>
        </article>
        <footer>
            <span class="author">&copy; Václav Žižkovský 2024</span>
        </footer>
    </main>

</body>

</html>