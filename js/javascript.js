$(document).ready(function(){
    /*=====================LOGIN/REGISTRATION=========================*/
    //Change value of name in button Login
    $('#registr').click(function(){
        if($('#login').attr('name')==='login'){    
            $('#login').attr('name', 'registration');
        } else {
            $('#login').attr('name', 'login');
        }
    });
    /*=========================UPLOAD FILE============================*/	
    //Upload files via ajax
    var messagePanel = $('.info-upload-panel');
    $("button[name = 'upload']").click(function(){
        messagePanel.empty();
        messagePanel.prepend("<span class='info-log-info'>"
                             +"<img src='images/loader.gif' alt='loader'> Uploading..."
                             +"</span>");
        var formData = new FormData($('form')[0]);
        $.ajax({
            url: '',  
            type: 'POST',
            success:  function(data){  
                //clear
                $('input[type="file"]').val('');
                messagePanel.empty(); 
                //show message
                $.each(data, function(index, value) {
                   messagePanel.prepend("<span class='info-log-"+value[0]+"'>"
                                 +value[1]
                                 +"</span>"
                                 +"<br>");  
                });               
            },
            error:  function(e) {},
            data: formData,
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });     
        
});