$(function(){
    LoadAnnouncements();

    $("#btn_create").click(function(){
        $("#modify_announcement_modal").css("display", "flex");
    });

    $("#btn_cancel").click(function(){
        Reset();
        $("#modify_announcement_modal").css("display", "none");
        
    });

    $("#btn_save").click(function(){
        if($("#txt_title").val() == ""){
            $(".message_div").text("Please enter a title.");
            $("#txt_title").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else if($("#txt_body").val() == ""){
            $(".message_div").text("Please enter the content.");
            $("#txt_body").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else{
            var formData = new FormData($("#add_announcement_form")[0]);

            AddAnnouncement(formData);
        }
    });

    $("#btn_update").click(function(){
        if($("#txt_title").val() == ""){
            $(".message_div").text("Please enter a title.");
            $("#txt_title").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else if($("#txt_body").val() == ""){
            $(".message_div").text("Please enter the content.");
            $("#txt_body").focus()
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
        }else{
            var formData = new FormData($("#add_announcement_form")[0]);

            UpdateAnnouncement(formData);
        }
    });

    $(document.body).on('click', '.btn_del', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var announcement_id = $(this).attr("announcement_id");
            RemoveAnnouncement(announcement_id);
        }
    });

    $(document.body).on('click', '.btn_edit', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var announcement_id = $(this).attr("announcement_id");
            GetAnnouncement(announcement_id);
        }
    });

});

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Add New Announcement");


    $(".txt_inpt").val("");



}

function LoadAnnouncements(){
    $.ajax({
        "type": "POST",
        "url": "load_announcement.php",
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function AddAnnouncement(formData){
    $.ajax({
        type:'POST',
        url:'add_announcement.php',
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

                }, 2000);
                LoadAnnouncements();
                $("#modify_announcement_modal").css("display", "none");
                Reset();

                
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

function UpdateAnnouncement(formData){
    $.ajax({
        type:'POST',
        url:'update_announcement.php',
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

                }, 2000);
                LoadAnnouncements();
                $("#modify_announcement_modal").css("display", "none");
                Reset();

                
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

function RemoveAnnouncement(announcement_id){
    var cParam = "";
    cParam = "announcement_id="+announcement_id;
    $.ajax({
        "type": "POST",
        "url": "remove_announcement.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadAnnouncements();
                $(".message_div").text("An announcement has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                
            }
        }
    });
}

function GetAnnouncement(announcement_id){
    var cParam = "";
    cParam = "announcement_id="+announcement_id;

    $.ajax({
        "type": "POST",
        "url": "get_announcement.php",
        "data": cParam,
        "success": function(text){
            var a_info = JSON.parse(text);
            $("#txt_title").val(a_info.title);
            $("#txt_body").val(a_info.body.replace(/<br\s*\/?>/gi, "\n"));
            $("#txt_announcement_id").val(announcement_id);

            $(".modify_title").text("Update Announcement");
            $("#btn_save").css("display", "none");
            $("#btn_update").css("display", "inline-block");
            $("#modify_announcement_modal").css("display", "flex");

        }
    });
}