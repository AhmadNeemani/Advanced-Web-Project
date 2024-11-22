$('.message a').click(function(){ //to change between login or sign up
    $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow");
    $('.register-form').animate({height: "toggle", opacity: "toggle"}, "slow");
    
 });
 $("button").click(function(){ // enter if all login fields are in
    if($('.login-form').is(':visible')){
        if($("#name_log").val() == ""){
            $(".error").show();
        }
        else{
            if($("#pass_log").val() == ""){
            $(".error").show();

            }else{
                
             window.location.href = "/test";
               

            }
        }
    ;}
    if($('.register-form').is(':visible')){ // enter if all registration fiels are in
        if($("#name_reg").val() == ""){
            $(".error_reg").show();
        }
        else{
            if($("#pass_reg").val() == ""){
            $(".error_reg").show();

            }else{
                if($("#email_reg").val()=="" || IsEmail($("#email_reg").val()) == false){
                     $(".error_reg").show();

                }else{
                
             window.location.href = "/test";
                }

            }
        }
    ;}
    
    
 })


 function IsEmail(email) { //email validation function
    var regex =
/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}