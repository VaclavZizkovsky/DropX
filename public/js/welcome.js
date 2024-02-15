window.onload = (e) => {
    fillDeviceType();
};

function fillDeviceType() {
    let ua = navigator.userAgent;
    let deviceTypeInput = document.querySelector('#device-type-input');

    let deviceType = 'Desktop';

    if (ua.match(/Mobi|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone/i)) {
        deviceType = 'Mobile';
    }

    deviceTypeInput.value = deviceType;
    return deviceType;
}