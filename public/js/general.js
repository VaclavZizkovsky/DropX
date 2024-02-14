function fileIconHtml(fileName) {
    let fileTypes = {
        document: ['pdf', 'docx', 'doc', 'odt', 'pages', 'rtf', 'tex', 'txt', 'json'],
        image: ['jpg', 'png', 'gif', 'svg', 'blend', 'bmp'],
        music: ['mp3', 'wav', 'ogg', 'flac', 'aac'],
        zip: ['zip', '7z', 'tar.gz', 'zipx', 'rar'],
        executable: ['apk', 'app', 'bat', 'cmd', 'com', 'exe', 'jar', 'sh', 'html', 'php'],
    }
    let fileExtension = fileName.split('.');
    fileExtension = fileExtension[fileExtension.length - 1];
    let fileType;

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