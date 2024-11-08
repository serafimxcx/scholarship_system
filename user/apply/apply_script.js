$(function(){
    $("#btn_back").click(function(){
        window.location.href="applynow.php";
    });

    $(".btn_apply").click(function(){
        var scholarship_id = $(this).attr("scholarship_id");

        window.location.href="applynow.php?scholarship_id="+scholarship_id+"&apply=true";
    });

    $(".btn_viewapplication").click(function(){
        var scholarship_id = $(this).attr("scholarship_id");

        window.location.href="applynow.php?scholarship_id="+scholarship_id+"&apply=true";

    });

    $("#btn_updateform").click(function(){
        $("button").prop("disabled", false);
        $("input").prop("disabled", false);
        $("select").prop("disabled", false);
        $("textarea").prop("disabled", false);
        $("#btn_updateform").css("display", "none");
        $("#btn_cancel").css("display", "inline-block");
        $("#btn_update").css("display", "inline-block");

        $("#txt_date").prop("disabled", true);

        $(".message_div").text("You can now update the form.");
        $(".message_div").fadeIn("fast");
        setTimeout(function() {
            $('.message_div').fadeOut('slow');
        }, 2000);
    });

    $("#btn_cancel").click(function(){
        if(confirm("Are you sure you want to cancel?")){
            location.reload();
        }
    });

    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to save the application? ")){
            var notEmpty = true;
            $('input[type="text"], input[type="file"], select, textarea').each(function() {
                if ($(this).val().trim() === "") {  
                    $(".message_div").text("Please enter a value.");
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 2000);

                    $(this).focus();
                    notEmpty = false;
                }
            });

            if(notEmpty == true){
                var formData = new FormData($("#application_form")[0]);

                Apply(formData);
            }
        }
    });

    $("#btn_update").click(function(){
        if(confirm("Are you sure you want to save changes? ")){
            var notEmpty = true;
            $('input[type="text"], input[type="file"], select, textarea').each(function() {
                if ($(this).val().trim() === "") {  
                    $(".message_div").text("Please enter a value.");
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 2000);

                    $(this).focus();
                    notEmpty = false;
                }
            });

            if(notEmpty == true){
                var formData = new FormData($("#application_form")[0]);

                UpdateApplication(formData);
            }
        }
    });

    $("#slct_isScholar").change(function(){
        if($("#slct_isScholar").val() == "Yes"){
            $("#txt_otherScholarships").val("");

        }else{
            $("#txt_otherScholarships").val("N/A");

        }
    });

    $("#btn_clearfiles").click(function(){
        if(confirm("Are you sure you want to clear the files you previously submit?")){
            $("#txt_files").val("N/A");
            $(".file_output").empty();
        }
        
    });
});

function Apply(formData){

    $.ajax({
        type:'POST',
        url:'add_application.php',
        data:formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response){
            if(response.success){
                $(".message_div").text(response.message);
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                   location.reload();

                }, 2000);

                
            }else{
                alert(response.message);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('XHR ERROR ' + XMLHttpRequest.status);
            return JSON.parse(XMLHttpRequest.responseText);
        }
    });
}

function UpdateApplication(formData){

    $.ajax({
        type:'POST',
        url:'update_application.php',
        data:formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response){
            if(response.success){
                $(".message_div").text(response.message);
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                    location.reload();

                }, 2000);

                
            }else{
                alert(response.message);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('XHR ERROR ' + XMLHttpRequest.status);
            return JSON.parse(XMLHttpRequest.responseText);
        }
    });
}

