window.addEventListener('load', (e) => {
    document.querySelector('.modal').addEventListener('click', (e) => {
        if (e.target == document.querySelector('.modal')) {
            closeModal();
        }
    })
});

/**
 * @description opens modal
 * @param {string} text modal text
 * @param {Array} buttons array of modal buttons in object format {type, text, onclick}
 */
function modal(text, buttons) {
    let modal = document.querySelector('.modal');
    let modalText = document.querySelector('.modal-text');
    modalText.innerHTML = text;

    let modalButtons = document.querySelector('.modal-buttons');
    modalButtons.innerHTML = '';
    buttons.forEach((button) => {
        let buttonDOM = document.createElement('button');
        buttonDOM.innerHTML = button.text;
        buttonDOM.classList.add(button.type + '-button');
        buttonDOM.addEventListener('click', button.onclick);
        modalButtons.appendChild(buttonDOM);
    });
    modal.style.display = 'flex';
}

function closeModal() {
    document.querySelector('.modal').style.display = 'none';
}

function fileIconHtml(fileName) {
    let fileTypes = {
        document: ['pdf', 'docx', 'doc', 'odt', 'pages', 'rtf', 'tex', 'txt', 'json'],
        image: ['jpg', 'png', 'gif', 'svg', 'blend', 'bmp'],
        music: ['mp3', 'wav', 'ogg', 'flac', 'aac'],
        zip: ['zip', '7z', 'tar.gz', 'zipx', 'rar'],
        executable: ['apk', 'app', 'bat', 'cmd', 'com', 'exe', 'jar', 'sh', 'html', 'php'],
    }
    let fileExtension = fileName.split('.');
    fileExtension = fileExtension[fileExtension.length - 1].toLowerCase();
    let fileType = 'file';

    if (fileTypes.document.indexOf(fileExtension) != -1) {
        fileType = 'file';
    } else if (fileTypes.image.indexOf(fileExtension) != -1) {
        fileType = 'image';
    } else if (fileTypes.music.indexOf(fileExtension) != -1) {
        fileType = 'music';
    } else if (fileTypes.zip.indexOf(fileExtension) != -1) {
        fileType = 'file-zipper'
    } else if (fileTypes.executable.indexOf(fileExtension) != -1) {
        fileType = 'terminal'
    }
    return '<i class="fa-solid fa-' + fileType + '"></i>';
}