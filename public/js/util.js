function copyToClipboard(id) {
    const text = document.getElementById(id);
    const elem = document.createElement('textarea');
    elem.value = text.innerText;
    document.body.appendChild(elem);
    elem.select();
    document.execCommand('copy');
    document.body.removeChild(elem);

    document.getElementsByClassName(id)[0].innerText = 'copied'

    setTimeout(function () {
        document.getElementsByClassName(id)[0].innerText = 'copy'
    }, 2000);
}
