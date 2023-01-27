var currentId;
function sendMessage (event){
    const url = `/post/touser/${currentId}`;
    if (event.keyCode === 13) {
        $.get(url)
    }
} 

/* $(document).ready(function(){
    const url = `/messages/from/${toUserId}`
    $("#user").on("click", function(){
        $.get(url,function(data){
            data.foreach(function(message){
               createDOMMessage(message);
            })
        })
    })
})  */
const message =  document.getElementById("contacts");
function createDOMMessage(m){
    var el = document.createElement('span');
    el.innerHTML = templateContact;
    el.getElementById("message.text").innerHTML = m.text;
    el.getElementById("message.time").innerHTML=m.timestamp;
    contacts.appendChild(el);
}

/*Cosas funcionales */
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
