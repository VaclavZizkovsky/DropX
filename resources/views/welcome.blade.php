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
                <p>
                    DropX is a simple application for <strong>quick file transfer</strong> between devices you
                    own. Instead of sending the files through an email or another platform, you can use this
                    easy tool to do it much quicker and for <strong>free</strong>.
                </p>
                <h2 id="start-using-h2">Start using!</h2>
                <p>
                    To use DropX, just choose your device name. You won't even need a password. <a href="#cookie-info">Here is why!</a> 
                    I also recommend reading <a href="#tutorial">how DropX works</a> to understand basic principles about this intuitive app.
                </p>
            </section>
        </article>
        <article id="tutorial">
            <section id="tutorial-section">
                <h2>How does it work? (boring stuff)</h2>
                <p>I will be explaining the functionality of the application in the rows below.</p>

                <section>
                    <h3>Registering a device</h3>
                    <p>
                        An essential step for using DropX is a registration of a device. Luckily for you, you don't need to create a password for every device you want to use.
                        DropX uses a <span id="cookie-info">cookie</span> – a small file stored in your browser – to remember your device instead and every time you visit this site,
                        DropX logs you to your "account" automatically.
                        However, the drawback is that when you or your browser deletes the cookie, you lose your connections to other devices.
                        
                    </p>
                </section>
                <section>
                    <h3>Connecting two devices</h3>
                    <p>
                        After registration, the next thing you have to do in order to send files is to connect the devices together. 
                        Estabilishing a connection between two devices is actually pretty easy.
                        Start with opening the <em>Devices</em> tab, finding <em>Add a device</em> sections and write the six-digit code from one device to another.
                        Then, confirm the request in the other device (refresh the page to see the request).
                        Your devices should be connected now and you should be able to see them as connected in the table below the form.
                    </p>
                </section>
                <section>
                    <h3>Sending files</h3>
                    <p>
                        The main part of DropX is of course the file sending.
                        You may select the file by clicking on the <em>Select files</em> button or just dragging the files on the screen (if you are on PC).
                        Next, select the reciever device of the files – the device must be connected to appear in the list.
                        After sending the files a progress bar will pop up indicating the upload state until the uploading is finished.
                    </p>
                    <p>
                        To download the files, navigate to the <em>Incoming</em> tab and find the transfer in the incoming transfers part. 
                        If you are sending only a single file, the file will begin to download, but if you are sending multiple files, they will be packed in a zip folder.
                    </p>
                </section>
                <section>
                    <h3>Other features</h3>
                    <p>
                        Of course I am not leaving you in this without great additional features I added to improve your experience. 
                        For example, you can find your history of file transfers in the <em>File log</em> section in <em>Incoming</em> tab.
                        In the <em>Devices</em> tab, you are able to see your cancelled and outcoming connection requests or delete your device from the database.
                    </p>
                </section>
                <section>
                    <p>
                        Congratulations, that's it! You just read 5 paragraphs of text that explains something you would figured out yourself! 
                        I wish you good luck using DropX and if you discover some bugs, please let me know!
                    </p>
                </section>
            </section>
        </article>
        <article id="faq">
            <h2>FAQ</h2>
            <p>Here are some of the most asked questions. If you have a question you want to ask, write me an email
                <a href="mailto:vaclav.zizkovsky@gmail.com">vaclav.zizkovsky@gmail.com</a>
            </p>
            <section id="faq-questions">
                <section class="question">    
                    <h3>Is there a way to download the files in a non-zip format?</h3>
                    <p>Unfortunately, some dumb web protocols do not allow to make you easily download multiple files at once, so I have to pack them first to a zip file and you can then download it as a one file.</p>
                </section>
                <section class="question">    
                    <h3>Why don't I need to have a password?</h3>
                    <p>When you register, the site creates a small file in your local browser called cookie, and when you visit the site again, the cookie data is sent to the server and it automatically logs you in.</p>
                </section>
                <section class="question">    
                    <h3>Is there a maximum upload size?</h3>
                    <p>Yes, you can only upload a file with size up to 10 MB. This is because of the limits of the server I'm hosting this project at.</p>
                </section>
            </section>
        </article>
        <footer>
            <span class="author"><a href="https://zizkovsky.eu">&copy; Václav Žižkovský 2024</a></span>
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