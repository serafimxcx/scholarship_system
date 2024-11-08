$(function(){
    var program_id = $("#slct_program").val();
    var address_pattern = /^([a-zA-Z\s.]+,){2}[a-zA-Z\s.]+$/;

    $("#btn_addinfo").click(function(){
        $("button").prop("disabled", false);
        $("input").prop("disabled", false);
        $("select").prop("disabled", false);
        $("#btn_addinfo").css("display", "none");
        $("#btn_cancel").css("display", "inline-block");
        $("#btn_save").css("display", "inline-block");

        $("#txt_studentno").prop("disabled", true);
        $("#txt_email").prop("disabled", true);
        $("#txt_contact").prop("disabled", true);

        $(".message_div").text("You can now fill up the form.");
        $(".message_div").fadeIn("fast");
        setTimeout(function() {
            $('.message_div').fadeOut('slow');
        }, 2000);
        
    });

    $("#btn_updateinfo").click(function(){
        if(confirm("Are you sure you want to edit the information? ")){
            $("button").prop("disabled", false);
            $("input").prop("disabled", false);
            $("select").prop("disabled", false);
            $("#btn_updateinfo").css("display", "none");
            $("#btn_cancel").css("display", "inline-block");
            $("#btn_update").css("display", "inline-block");


            $(".message_div").text("You can now edit the form.");
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }
        
    });

    $("#btn_cancel").click(function(){
        if(confirm("Are you sure you want to cancel?")){
            location.reload();
        }
    });

    $("#btn_slctimg").click(function(e) {
        $("#slct_profileimg").click();
    });

    $("#slct_profileimg").change(function(){
        var fileInput = $("#slct_profileimg");
        var file = fileInput[0].files[0];

        const fileimg = this.files[0];
        if (fileimg){
          let reader = new FileReader();
          reader.onload = function(event){
            $('.profile_img').attr('src', event.target.result);
          }
          reader.readAsDataURL(fileimg);
        }
    });

    $("#btn_save").click(function(){
        var notEmpty = true;
        $('input[type="text"], input[type="number"], input[type="file"], select').each(function() {
            if ($(this).val().trim() === "") {
                

                if($(this).attr("type") == "file"){
                    if(confirm("You haven't selected an image. Do you want to continue? ")){
                        notEmpty = true;

                    }else{
                        $(".message_div").text("Please enter an image.");
                        $(".message_div").fadeIn("fast");
                        setTimeout(function() {
                            $('.message_div').fadeOut('slow');
                        }, 2000);

                        $(this).focus();
                        notEmpty = false;
                    }
                    
                }else{
                    $(".message_div").text("Please enter a value.");
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 2000);

                    $(this).focus();
                    notEmpty = false;
                }

            }else if(!address_pattern.test($("#txt_address").val())){
                $(".message_div").text("Please follow this format: Street Barangay, Town or City or Municipality, Province");
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 5000);

                    $("#txt_address").focus();
                    notEmpty = false;
            }
        });

        if(notEmpty == true){
            var formData = new FormData($("#add_profile_form")[0]);

            AddInfo(formData);
        }

    });

    $("#btn_update").click(function(){
        var notEmpty = true;
        $('input[type="text"], input[type="number"], input[type="file"], select').each(function() {
            if ($(this).val().trim() === "") {
                

                if($(this).attr("type") == "file"){
                    if(confirm("You haven't selected an image. Do you want to continue? ")){
                        notEmpty = true;

                    }else{
                        $(".message_div").text("Please enter an image.");
                        $(".message_div").fadeIn("fast");
                        setTimeout(function() {
                            $('.message_div').fadeOut('slow');
                        }, 2000);

                        $(this).focus();
                        notEmpty = false;
                    }
                    
                }else{
                    
                    $(".message_div").text("Please enter a value.");
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 2000);

                    $(this).focus();
                    notEmpty = false;
                }

            }else if(!address_pattern.test($("#txt_address").val())){
                $(".message_div").text("Please follow this format: Street Barangay, Town or City or Municipality, Province");
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 5000);

                    $("#txt_address").focus();
                    notEmpty = false;
            }
        });

        if(notEmpty == true){
            var formData = new FormData($("#add_profile_form")[0]);

            UpdateInfo(formData);
        }

    });

    $("#slct_program").change(function(){
        program_id = $("#slct_program").val();
        LoadYearLevel(program_id);
    });

    LoadYearLevel(program_id);
});

function AddInfo(formData){
    $.ajax({
        type:'POST',
        url:'add_info.php',
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

function UpdateInfo(formData){
    $.ajax({
        type:'POST',
        url:'update_info.php',
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

function LoadYearLevel(program_id){
    
    var cParam ="";
    cParam = "program_id="+program_id;

    $.ajax({
        "type":"POST",
        "url":"load_yearlevel.php",
        "data": cParam,
        "success": function(text){
            $("#slct_yearlevel").empty();
            $("#slct_yearlevel").append("<option value=''>Select Year Level...</option>");
            $("#slct_yearlevel").append(text);
        }
    });
}