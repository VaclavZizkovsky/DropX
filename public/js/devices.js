window.onload = () => {
    document.querySelector('#add-device-button').addEventListener('click', addDevice);
};

function addDevice() {
    window.location.href = './add-device/';
}