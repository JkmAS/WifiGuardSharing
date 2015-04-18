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
    var message = $('.info-upload-panel');
    $("button[name = 'upload']").click(function(){
        message.prepend("<img src='images/loader.gif' alt='loader'> Uploading...");
        var formData = new FormData($('form')[0]);
        $.ajax({
            url: '',  
            type: 'POST',
            success:  function(data){    
                // clear input form
                $('input[type="file"]').val('');
                //refresh whole page with javascript, font and css
                document.open();
                document.write(data);
                document.close();
            },
            error:  function(e) {},
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });
        
});