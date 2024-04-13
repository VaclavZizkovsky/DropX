window.addEventListener('load', (e) => {
    document.querySelectorAll('.incoming-files').forEach(transfer => {
        transfer.querySelectorAll('.incoming-files-buttons .download-files-form').forEach(form => {
            form.addEventListener('submit', (e) => {
                hideIncomingTransfer(transfer, form);
            })
        })
    });

    loadPagination();
});


const pageSize = 10;
var page = 1;

function loadPagination() {
    let transfers = document.querySelectorAll('.file-transfer');

    if (!(transfers.length / pageSize > 1)) {
        document.querySelectorAll('.file-transfer').forEach(transfer => {
            transfer.style.display = 'flex';
        });
        document.querySelector('#pagination').style.display = 'none';
        return;
    }

    let pages = document.querySelector('#pagination');
    pages.innerHTML = '';

    let allLeftPages = page - 1;
    let allRightPages = Math.ceil(transfers.length / pageSize) - page;

    let leftPages = Math.min(4 - Math.min(2, allRightPages), allLeftPages);
    for (let i = leftPages; i > 0; i--) {
        pages.innerHTML += '<button onclick="changePage(' + (page - i) + ')">' + (page - i) + '</button>';
    }

    pages.innerHTML += '<button class="active-page-button">' + page + '</button>';

    let rightPages = Math.min(4 - leftPages, allRightPages);
    for (let i = 0; i < rightPages; i++) {
        pages.innerHTML += '<button onclick="changePage(' + (page + i + 1) + ')">' + (page + i + 1) + '</button>';
    }


    for (let i = 0; i < Math.min(pageSize, transfers.length - Math.ceil((page - 1) * pageSize)); i++) {
        transfers[(page - 1) * pageSize + i].style.display = 'flex';
    }
}

function changePage(pageNumber) {
    page = pageNumber;
    document.querySelectorAll('.file-transfer').forEach(transfer => {
        transfer.style.display = 'none';
    });
    loadPagination();
}

var hiddenTransfers = 0;
function hideIncomingTransfer(transfer, form) {
    console.log(transfer);
    transfer.style.display = 'none';
    hiddenTransfers++;

    if(document.querySelectorAll('.incoming-files').length - hiddenTransfers == 0){
        document.querySelector('#incoming-transfers').style.display = 'none';
    }
}