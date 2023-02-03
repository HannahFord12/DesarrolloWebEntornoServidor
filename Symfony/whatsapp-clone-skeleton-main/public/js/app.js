$(document).ready(function(){
    //Open a WebSocket connection.
    websocket = new WebSocket("ws://localhost:9000/");
    
    //Connected to server
    websocket.onopen = function(ev) {
        console.log('Connected to server ');
        
    }
    
    //Connection close
    websocket.onclose = function(ev) { 
        console.log('Disconnected');
    };
    websocket.onmessage = function(evt) { 
        var response 		= JSON.parse(evt.data); //PHP sends Json data
        //hacer lo que corresponda con response
        console.log(response)
    };
        
    //Error
    websocket.onerror = function(ev) { 
        console.log('Error '+ev.data);
    };
    
});
    