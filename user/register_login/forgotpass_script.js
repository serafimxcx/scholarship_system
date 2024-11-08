$(function(){
    $("#btn_changepass").click(function(){
        if($("#txt_studentno").val() == ""){
            $(".message_div").text("Please enter you student number.");
            $("#txt_studentno").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else if($("#txt_code").val() == ""){
            $(".message_div").text("Please enter a verification code. Send code and check your registered email.");
            $("#txt_code").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else if($("#txt_newpass").val() == ""){
            $(".message_div").text("Please enter your desired new password.");
            $("#txt_newpass").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else if($("#txt_newpass2").val() == ""){
            $(".message_div").text("Please retype your new password.");
            $("#txt_newpass2").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else if($("#txt_newpass2").val() != $("#txt_newpass").val()){
            $(".message_div").text("Passwords does not match.");
            $("#txt_newpass2").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else{
            if(confirm("Are you sure you want to save your new password?")){
                ChangePass();
            }
        }
    });

    $("#btn_sendcode").click(function(){
        if($("#txt_studentno").val() == ""){
            $(".message_div").text("Please enter you student number.");
            $("#txt_studentno").focus();
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else{
            var studentno = $("#txt_studentno").val();
            SendCode(studentno);

        }
    });
});

function SendCode(studentno){
    var cParam = "";
    cParam = "studentno="+studentno;

    $.ajax({
        "type": "POST",
        "url": "sendcode.php",
        "data": cParam,
        "success": function(text){
            if(text != ""){
                $(".message_div").text(text);
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_studentno").focus();

            }else{
                $(".message_div").text("Please check your email for your verification code.");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_code").focus();

            }
        },
        "beforeSend": function(){
            $(".message_div").text("Loading...");
            $(".message_div").fadeIn("fast");
        }
    });
}


function ChangePass(){
    var cParam = "";

    cParam = "studentno="+ $("#txt_studentno").val();
    cParam += "&code="+ $("#txt_code").val();
    cParam += "&newpass="+ $("#txt_newpass").val();

    $.ajax({
        "type": "POST",
        "url": "forgot_updatepass.php",
        "data": cParam,
        "success": function(text){
            if(text != ""){
                $(".message_div").text(text);
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 3000);
                $("#txt_studentno").focus();
            }else{
                $(".message_div").text("Password changed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                    window.location.href="user_login.php";
                }, 2000);
            }
        }
    });
}


