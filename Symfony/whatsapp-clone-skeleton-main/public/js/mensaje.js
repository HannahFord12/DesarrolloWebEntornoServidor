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
const message =  document.getElementById("messages");
const templateMensageMe=document.getElementById("templateMensageMe").innerHTML;
const templateMensageOther=document.getElementById("templateMensageOther").innerHTML;
function createDOMMessageMe(m){
    var el = document.createElement('span');
    /* m.timestamp.DateTimeFormat("az").format(date) */
    var hora=m.timestamp.date
    el.innerHTML = templateMensageMe;
    el.getElementsByClassName("message.text")[0].innerHTML = m.text;
    el.getElementsByClassName("message.time")[0].innerHTML=m.timestamp;
    
    message.appendChild(el);
} 
function createDOMMessageOther(m){
    var el = document.createElement('span');
    el.innerHTML = templateMensageOther;
    el.getElementsByClassName("message.text")[0].innerHTML = m.text;
    el.getElementsByClassName("message.name")[0].innerHTML = m.name;
   
    el.getElementsByClassName("message.time")[0].innerHTML=m.timestamp;
    message.appendChild(el);
} 

$(document).ready(function(){
    var url=`/contact`;
    $.get(url, function(data){
        data.forEach(function(contacto){
            createDOMContact(contacto);
            $(".contact").on('click', function(){
                let toUserId=$(this).attr('data-id');
                var mss=`/messages/from/${toUserId}`; 
                $.get(mss, function(data){
                    data.forEach(function(msg){
                        if(msg.toUser==toUserId){
                            createDOMMessageMe(msg)
                        }else{
                            createDOMMessageOther(msg);
                            
                        }
                    })
                });
            })
        })
    })
    
})

/*Cosas funcionales */
/* $(document).ready(function(){
    var url=`/contact`;
    $.get(url, function(data){
        data.forEach(function(contacto){
            createDOMContact(contacto);
        })
    })
}) */

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
