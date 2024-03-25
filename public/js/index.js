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
    });

    document.querySelector('#upload-form-button').addEventListener('click', (e) => {
        uploadFiles();
    });

    document.querySelector('#file-input').addEventListener('change', (e) => {
        displayFiles();
    })

    document.querySelector('#clear-file-list-button').addEventListener('click', clearFiles);

    let select = document.querySelector('#device-select');
    if (select != null) {
        select.addEventListener('change', () => {
            if (select.value == '-1') {
                addDevice();
            }
        });
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
    document.querySelector('#file-input').files = filterFolders(document.querySelector('#file-input').files).files;
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

function filterFolders(files) {
    let filteredFiles = new DataTransfer();

    files = [...files];
    files.forEach(file => {
        let fileParts = file.name.split('.');
        if (fileParts.length > 1 || file.type != '') {
            filteredFiles.items.add(file);
        }
    });

    return filteredFiles;
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

    window.location.href = '/devices';
}

function formatTransferedFiles() {
    let transferedFiles = document.querySelectorAll('.transfered-file');

    for (let i = 0; i < transferedFiles.length; i++) {
        let transferedFile = transferedFiles[i];
        transferedFile.innerHTML = fileIconHtml(transferedFile.innerText);
    }
}

function uploadFiles() {
    let files = document.querySelector('#file-input');

    if (files.files.length == 0) {
        return;
    }

    let request = new XMLHttpRequest();
    request.open('POST', '/upload', true);

    request.upload.onprogress = (e) => {
        if (e.lengthComputable) {
            document.querySelector('#progress-bar').style.width = (e.loaded / e.total) * 100 + '%';
        }
    };

    request.onload = (e) => {
        document.querySelector('#upload-progress').style.display = 'none';
        clearFiles();
        document.querySelector('.success-message').style.display = 'block';
        document.querySelector('.success-message').innerText = 'Files successfully uploaded';
    }

    request.onerror = (e) => {
        document.querySelector('#upload-progress').style.display = 'none';
        clearFiles();
        document.querySelector('.error-message').style.display = 'block';
        document.querySelector('.error-message').innerText = 'Error uploading files';
    }

    document.querySelector('#upload-progress').style.display = 'block';
    document.querySelector('.error-message').style.display = 'none';
    document.querySelector('.success-message').style.display = 'none';

    let formData = new FormData(document.querySelector('#upload-form'));
    request.send(formData);
}