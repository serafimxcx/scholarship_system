$(function(){
    $("#btn_back2login").click(function(){
        window.location.href="user_login.php";
    })

    var studentno_pattern = /^\d{5}-\d{2}-\d{4}$/;
    var email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var contact_pattern = /^[0-9+\-\(\)\s]+$/;

    $("#btn_saveregister").click(function(){
        if(confirm("Are you sure the information you provided are correct?")){
            if($("#txt_studentno").val().trim() == ""){
                $(".message_div").text("Please enter a student number.");
                $("#txt_studentno").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if(!studentno_pattern.test($("#txt_studentno").val().trim())){
                $(".message_div").text("Invalid student number format. Please use #####-##-####.");
                $("#txt_studentno").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_pass").val().trim() == ""){
                $(".message_div").text("Please enter a password.");
                $("#txt_pass").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_pass2").val().trim() == ""){
                $(".message_div").text("Please retype your password.");
                $("#txt_pass2").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_pass2").val().trim() != $("#txt_pass").val().trim()){
                $(".message_div").text("Password are not the same.");
                $("#txt_pass2").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_email").val().trim() == ""){
                $(".message_div").text("Please enter a working email.");
                $("#txt_email").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if(!email_pattern.test($("#txt_email").val().trim())){
                $(".message_div").text("Invalid email format.");
                $("#txt_email").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_contact").val().trim() == ""){
                $(".message_div").text("Please enter a contact number.");
                $("#txt_contact").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if(!contact_pattern.test($("#txt_contact").val().trim())){
                $(".message_div").text("Invalid contact number format. Only numbers and symbols (+, -, (, ), space) are allowed.");
                $("#txt_contact").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                Register();
            }
        }
    });
});

function Register(){
    var cParam = "";

    cParam = "txt_studentno="+$("#txt_studentno").val();
    cParam += "&txt_pass="+$("#txt_pass").val();
    cParam += "&txt_email="+$("#txt_email").val();
    cParam += "&txt_contact="+$("#txt_contact").val();

    $.ajax({
        "type":"POST",
        "url": "register.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                $(".message_div").text(text);
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);

                $("#txt_studentno").focus();
            }else{
                $(".message_div").text("created successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                Login($("#txt_studentno").val(), $("#txt_pass").val());
            }
        }
    });
}

function Login(studentno, pass){
    var cParam = "";

            cParam = "txt_studentno="+studentno;
            cParam += "&txt_pass="+pass;
        
            $.ajax({
            "type": 'POST',
            "url": 'login.php',
            "data": cParam,
            "dataType": 'json',
            "success": function (response) {
                if(response.success){
                    $(".message_div").text(response.message);
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        window.location.href = '/scholarship_system/user/profile/profile.php';
                    }, 2000);
                    
                }else{
                    
                    $(".message_div").text(response.message);
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 2000);
                }
                
                }
            });
}