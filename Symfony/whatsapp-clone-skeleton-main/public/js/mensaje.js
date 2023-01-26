var currentId;
function sendMessage (event){
    const url = `/post/touser/${currentId}`;
    if (event.keyCode === 13) {
        $.get(url)
    }
} 

/*$(document).ready(function(){
    const url = "./app_page"
    $("#send-message").on("keypress", function(){
        if (this.keyCode === 13) {
            $.get(url)
        }
    })
}) */
$(document).ready(function(){
    var url=`/contact`;
    $.get(url, function(data){
        data.forEach(function(contacto){
            createDOMContact(contacto);
        })
    })
})

//Pintar contactos
const contacts =  document.getElementById("contacts"); //div donde vamos a pintar los contactos
const templateContact = document.getElementById("templateContact").innerHTML;

function createDOMContact(m){
    var el = document.createElement('span');
    el.innerHTML = templateContact;
    el.getElementsByClassName("contact.userName")[0].innerHTML = m.username;
    el.getElementsByClassName("contact")[0].setAttribute("data-id", m.id);
    el.getElementsByClassName("contact.info")[0].innerHTML = m.info;
    el.getElementsByClassName("contact.image")[0].src=( "/img/" + m.image);
    contacts.appendChild(el);
    //Ya solo te falta añadir los eventos clic
}
