document.addEventListener('DOMContentLoaded', function () {
    var printButton = document.getElementById('printButton');

    printButton.addEventListener('click', function () {
        window.print();
    });
});