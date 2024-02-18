window.onload = () => {
    document.querySelector('#this-device-code').addEventListener('click', showCopied)

    document.querySelector('#add-device-button').addEventListener('click', addDevice);
};


let deviceCode = 'ready';
function showCopied() {
    if (deviceCode != 'ready') {
        return;
    }

    deviceCode = document.querySelector('#this-device-code').innerText;
    navigator.clipboard.writeText(deviceCode);
    document.querySelector('#this-device-code').innerText = 'Copied!';
    setTimeout(() => {
        document.querySelector('#this-device-code').innerText = deviceCode;
        deviceCode = 'ready';
    }, 1500);
}

function addDevice() {
    window.location.href = './add-device/';
}