var currentId;
let meCurrtentId = "";
function sendMessage (event){
    var form=$("#send-message"); 
    const url = `/post/touser/${currentId}`;
    if (event.keyCode === 13) {
        $.post(url,form.serialize(), function(event){
            document.getElementById("send-message").reset();
        })
    }
} 

const message =  document.getElementById("messages");
const templateMensageMe=document.getElementById("templateMensageMe").innerHTML;
const templateMensageOther=document.getElementById("templateMensageOther").innerHTML;
function createDOMMessageMe(m){
    var el = document.createElement('span');
    /* m.timestamp.DateTimeFormat("az").format(date) */
    var hora=m.timestamp.date
    el.innerHTML = templateMensageMe;
    el.getElementsByClassName("message.text")[0].innerHTML = m.text;
    el.getElementsByClassName("message.time")[0].innerHTML=hora;/* new Intl.DateTimeFormat('en-US').format(hora) */
    
    message.appendChild(el);
} 
function createDOMMessageOther(m){
    var el = document.createElement('span');
    el.innerHTML = templateMensageOther;
    var hora=m.timestamp.date
    el.getElementsByClassName("message.text")[0].innerHTML = m.text;
    console.log(m.name )
    el.getElementsByClassName("message.name")[0].innerHTML = m.fromUserName;
    el.getElementsByClassName("message.time")[0].innerHTML=hora;
    message.appendChild(el);
} 

$(document).ready(function(){
    
    var url=`/contact`;
    $.get(url, function(data){
        data.forEach(function(contacto){
            createDOMContact(contacto);
            $(".contact").off();
            $(".contact").on('click', function(){
                $("#messages").empty();
                let toUserId=$(this).attr('data-id');
                currentId=toUserId;
                var mss=`/messages/from/${toUserId}`; 
                //prepare json data
                var msg = {
                    type: 'chatData',
                    fromUserId: toUserId,
                    toUserId: -1
                };
                //convert and send data to server
                websocket.send(JSON.stringify(msg));
                /* var contactos = document.getElementsByClassName("contact");
                [...contactos].forEach(contacto => {
                    contacto.setAttribute("active",false)
                });
                this.setAttribute("active",true)  */
                $.get(mss, function(data){
                    console.log(data)
                    data.forEach(function(msg){
                        if(msg.toUser!=meCurrtentId){
                            createDOMMessageMe(msg)
                        }else{
                            createDOMMessageOther(msg);
                            
                        }
                    })
                });
                
                
            })
        })
    })
    meCurrtentId= $('#user').attr('data-user-id');//document.getElementById("user").attr('data-user-id');
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
