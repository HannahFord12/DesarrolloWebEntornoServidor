
function cargarProductosOnload() {
    var smartphones = document.getElementsByClassName('producto');
    for (let i = 0; i < smartphones.length; i++) {
         smartphones[i].addEventListener('mouseenter', ampliar)
         smartphones[i].addEventListener('mouseleave', disminuir)
    }
}

function ampliar() {
    this.style.transform = "scale(1.1)"
}

function disminuir() {
    this.style.transform = ""
}