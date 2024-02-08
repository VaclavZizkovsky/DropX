window.onload = (e) => {
    document.querySelector('#this-device-code').addEventListener('click', showCopied)
};


let deviceCode = 'ready';
function showCopied() {
    if(deviceCode != 'ready'){
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