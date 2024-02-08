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
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <script src="./js/general.js"></script>
    <script src="./js/index.js"></script>
    <title>DropX – file transfer in few clicks</title>
</head>

<body>
    <header>
        <img src="./assets/images/logo.png" alt="DropX logo" id="logo">
        <h1>DropX — file transfer in few clicks</h1>
    </header>

    <main>
        <section>
            <form action="/" method="GET" id="upload-form" autocomplete="off">
                @csrf
                <h1>Send files</h1>
                <div id="file">
                    <div id="file-manual-select">
                        <label for="file-input"><i class="fa-solid fa-file-circle-plus"></i>&nbsp;Select files</label>
                        <input type="file" name="file" id="file-input" required multiple>
                    </div>
                    <p id="file-drop-message">or drag them on the screen</p>
                    <div id="file-drop">
                        <span>Drop the files here</span>
                    </div>
                </div>
                <div id="device">
                    <h3>Choose a device</h3>
                    <select name="device" id="device-select">
                        <option value="1"><i class="fa-solid fa-computer"></i>&nbsp;KaktusPC</option>
                        <option value="2"><i class="fa-solid fa-mobile-screen-button"></i>&nbsp;Samsung Galaxy A52s
                        </option>
                        <option value="3"><i class="fa-solid fa-laptop"></i>&nbsp;Windows 10 laptop</option>
                        <option id="add-device-option">Add a new device</option>
                    </select>
                </div>
                <button type="submit"><i class="fa-solid fa-paper-plane"></i>&nbsp;Send</button>
                <div id="file-list">
                    <h3>Files to send</h3>
                    <table id="file-list-table">
                        <tbody></tbody>
                    </table>
                    <button type="button" id="clear-file-list-button"><i class="fa-solid fa-xmark"></i>&nbsp;Clear
                        list</button>
                </div>
            </form>
        </section>

        <section>
            <h1>My devices</h1>
            <p>Here is the list of all devices connected to this device.</p>
            <button id="add-device-button">Add new device</button>
            <table id="device-table">
                <tr>
                    <td>KaktusPC</td>
                    <td><i class="fa-solid fa-computer"></i>&nbsp;Desktop</td>
                    <td><button><i class="fa-solid fa-link-slash"></i>&nbsp;Disconnect</button></td>
                </tr>
                <tr>
                    <td>Samsung Galaxy A52s</td>
                    <td><i class="fa-solid fa-mobile-screen-button"></i>&nbsp;Mobile</td>
                    <td><button><i class="fa-solid fa-link-slash"></i>&nbsp;Disconnect</button></td>
                </tr>
                <tr>
                    <td>Windows 10 laptop</td>
                    <td><i class="fa-solid fa-laptop"></i>&nbsp;Laptop</td>
                    <td><button><i class="fa-solid fa-link-slash"></i>&nbsp;Disconnect</button></td>
                </tr>
            </table>
        </section>

        <section>
            <h1>File log</h1>
            <p>Here is the list of all sent and incoming files for this device.</p>
            <table id="file-log">
            </table>
        </section>
    </main>
</body>

</html>