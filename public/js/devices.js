window.onload = () => {
    document.querySelector('#this-device-code').addEventListener('click', showCopied)

    document.querySelector('#add-device-button').addEventListener('click', addDevice);

    let cancelledRequestsButton = document.querySelector('#show-cancelled-requests-button');
    if (cancelledRequestsButton != null) {
        cancelledRequestsButton.addEventListener('click', toggleCancelledRequests);
    }
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

function toggleCancelledRequests() {
    let table = document.querySelector('#cancelled-requests-table');
    let visibility = table.style.display;
    table.style.display = visibility == 'block' ? 'none' : 'block';
    table.style.maxHeight = visibility == 'block' ? 0 : '100%';

    let buttonSpan = document.querySelector('#show-cancelled-requests-button span');
    let buttonIcon = document.querySelector('#show-cancelled-requests-button i');
    if (visibility == 'block') {
        buttonSpan.innerText = buttonSpan.innerText.replace('Hide', 'Show');
        buttonIcon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        buttonSpan.innerText = buttonSpan.innerText.replace('Show', 'Hide');
        buttonIcon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}