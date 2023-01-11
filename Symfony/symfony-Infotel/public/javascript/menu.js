function cargarMenuIcono() {
    var menuToogle = document.getElementById('icono');
    menuToogle.addEventListener("click",desplegar) 
}

function desplegar(event) {
    
    var menu = document.getElementById('barra_de_navegacion');
    var menuToogleIcon = document.querySelector('.menu-toogle i')
    menu.classList.toggle('show');

    if(menu.classList.contains('show')){
        menuToogleIcon.setAttribute('class','fa fa-times');
    }else{
        menuToogleIcon.setAttribute('class','fa fa-bars')
    }
}