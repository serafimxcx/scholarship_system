$(function(){
    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to save your new password?")){
            if($("#txt_oldpass").val() == ""){
                $(".message_div").text("Please enter your old password.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_oldpass").focus();
            }else if($("#txt_newpass").val() == ""){
                $(".message_div").text("Please enter your new password.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_newpass").focus();
            }else if($("#txt_newpass2").val() == ""){
                $(".message_div").text("Please retype your new password.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_newpass2").focus();
            }else if($("#txt_newpass2").val() != $("#txt_newpass").val()){
                $(".message_div").text("Password does not match.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_newpass2").focus();
            }else{
                ChangePass();
            }
        }
    });
});

function ChangePass(){
    var cParam = "";
    cParam = "oldpass="+$("#txt_oldpass").val();
    cParam += "&newpass="+$("#txt_newpass").val();

    $.ajax({
        "type": "POST",
        "url": "updatepass.php",
        "data": cParam,
        "success": function(text){
            if(text != ""){
                $(".message_div").text(text);
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_oldpass").focus();
                $(".txt_inpt").val("");

            }else{
                $(".message_div").text("Password changed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $(".txt_inpt").val("");
            }
        }
    });
}