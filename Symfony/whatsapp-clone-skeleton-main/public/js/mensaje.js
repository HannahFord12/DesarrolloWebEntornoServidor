function sendMessage (event){
    const url = "/message/3"
    if (event.keyCode === 13) {
        $.get(url)
    }
}

/* $(document).ready(function(){
    const url = "./app_page"
    $("#send-message").on("keypress", function(){
        if (this.keyCode === 13) {
            $.get(url)
        }
    })
}) */