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
    if(files.length == 0){
        //list.innerHTML = '<tr><td colspan="2">No selected files</td></tr>';
        document.querySelector('#file-list').style.display = 'none';
        return;
    }
    document.querySelector('#file-list').style.display = 'flex';
    list.innerHTML = '';
    let listLength = files.length > 5 ? 5 : files.length;
    for (let i = 0; i < listLength; i++) {
        let file = files[i];
        let fileTypes = {
            document: ['pdf', 'docx', 'doc', 'odt', 'pages', 'rtf', 'tex', 'txt', 'json'],
            image: ['jpg', 'png', 'gif', 'svg', 'blend', 'bmp'],
            zip: ['zip', '7z', 'tar.gz', 'zipx', 'rar'],
            executable: ['apk', 'app', 'bat', 'cmd', 'com', 'exe', 'jar', 'sh', 'html', 'php'],
        }
        let fileExtension = file.name.split('.');
        fileExtension = fileExtension[fileExtension.length - 1];
        let fileType;

        if (fileTypes.document.indexOf(fileExtension) != -1) {
            fileType = 'file';
        } else if (fileTypes.image.indexOf(fileExtension) != -1) {
            fileType = 'image';
        } else if (fileTypes.zip.indexOf(fileExtension) != -1) {
            fileType = 'file-zipper'
        } else if (fileTypes.executable.indexOf(fileExtension) != -1) {
            fileType = 'terminal'
        }
        list.innerHTML += '<tr><td class="file-icon"><i class="fa-solid fa-' + fileType + '"></td><td class="file-name">' + file.name + '</td></tr>'
    }
    if (files.length > 5) {
        list.innerHTML += '<tr><td colspan="2">and ' + (files.length - 5) + ' more...</td></tr>';
    }
}

function clearFiles(){
    let input = document.querySelector('#file-input');
    input.files = new DataTransfer().files;
    displayFiles();
}