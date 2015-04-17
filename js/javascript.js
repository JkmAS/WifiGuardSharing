$(document).ready(function(){
    //Change value of name in button Login
    $('#registr').click(function(){
        if($('#login').attr('name')==='login'){    
            $('#login').attr('name', 'registration');
        } else {
            $('#login').attr('name', 'login');
        }
    });
});


