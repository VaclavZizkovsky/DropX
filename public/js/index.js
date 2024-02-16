window.onload = (e) => {
    window.addEventListener('dragenter', (e) => {
        e.preventDefault();
        document.querySelector('#file-drop').style.display = 'flex';
    })
    window.addEventListener('dragover', (e) => {
        e.preventDefault();
        document.querySelector('#file-drop').style.display = 'flex';
    })
    window.addEventListener('dragleave', (e) => {
        document.querySelector('#file-drop').style.display = 'none';
    });
    window.addEventListener('dragend', (e) => {
        document.querySelector('#file-drop').style.display = 'none';
    });
    window.addEventListener('drop', (e) => {
        e.preventDefault();
        document.querySelector('#file-drop').style.display = 'none';
        fillFileInput(e);
    })

    document.querySelector('#file-input').addEventListener('change', (e) => {
        displayFiles();
    })

    document.querySelector('#clear-file-list-button').addEventListener('click', clearFiles);

    let option = document.querySelector('#add-device-option');
    if (option != null) {
        option.addEventListener('click', addDevice);
    } else {
        document.querySelector('#add-device-button').addEventListener('click', addDevice);
    }

    displayFiles();
}


function fillFileInput(e) {
    let validFiles = new DataTransfer();
    validFiles.files = document.querySelector('#file-input').files;
    for (let i = 0; i < e.dataTransfer.files.length; i++) {
        let file = e.dataTransfer.files[i];
        if (file.size > 0) {
            validFiles.items.add(file);
        }
    }
    document.querySelector('#file-input').files = validFiles.files;
    displayFiles();
}

function displayFiles() {
    let list = document.querySelector('#file-list-table tbody');
    let files = document.querySelector('#file-input').files;
    if (files.length == 0) {
        document.querySelector('#file-list').style.display = 'none';
        return;
    }
    document.querySelector('#file-list').style.display = 'flex';
    list.innerHTML = '';
    let listLength = files.length > 5 ? 5 : files.length;
    for (let i = 0; i < listLength; i++) {
        let file = files[i];
        list.innerHTML += '<tr><td>' + fileIconHtml(file.name) + '</td><td class="file-name">' + file.name + '</td></tr>'
    }
    if (files.length > 5) {
        list.innerHTML += '<tr><td colspan="2">and ' + (files.length - 5) + ' more...</td></tr>';
    }
}

function clearFiles() {
    let input = document.querySelector('#file-input');
    input.files = new DataTransfer().files;
    displayFiles();
}

function addDevice() {
    let select = document.querySelector('#device-select');
    if (select != null) {
        let firstOption = document.querySelector('#device-select option');
        select.value = firstOption.value;
    }

    window.location.href = './add-device/';
}

function formatTransferedFiles() {
    let transferedFiles = document.querySelectorAll('.transfered-file');

    for (let i = 0; i < transferedFiles.length; i++) {
        let transferedFile = transferedFiles[i];
        transferedFile.innerHTML = fileIconHtml(transferedFile.innerText);
    }
}