$(function(){
    LoadAdmin();
    LoadHistory();

    $("#btn_create").click(function(){
        $("#modify_admin_modal").css("display", "flex");
    });

    $("#btn_cancel").click(function(){
        Reset();
        $("#modify_admin_modal").css("display", "none");
        
    });

    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to add this record?")){
            if($("#slct_type").val() == ""){
                $(".message_div").text("Please select an admin type.");
                $("#slct_type").focus();
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name.");
                $("#txt_name").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_username").val() == ""){
                $(".message_div").text("Please enter a username.");
                $("#txt_username").focus();
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_pass").val() == ""){
                $(".message_div").text("Please enter a password.");
                $("#txt_pass").focus();
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                AddAdmin();
            }
        }
    });

    $("#btn_update").click(function(){
        if(confirm("Are you sure you want to update this record?")){
            if($("#slct_type").val() == ""){
                $(".message_div").text("Please select an admin type.");
                $("#slct_type").focus();
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name.");
                $("#txt_name").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_username").val() == ""){
                $(".message_div").text("Please enter a username.");
                $("#txt_username").focus();
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_pass").val() == ""){
                $(".message_div").text("Please enter a password.");
                $("#txt_pass").focus();
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                UpdateAdmin();
            }
        }
        
    });

    $(document.body).on('click', '.btn_del', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var admin_id = $(this).attr("admin_id");
            RemoveAdmin(admin_id);
        }
    });

    $(document.body).on('click', '.btn_edit', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var admin_id = $(this).attr("admin_id");
            GetAdmin(admin_id);
        }
    });
});

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Create New Admin");
    $(".txt_inpt").val("");

}

function LoadAdmin(){
    $.ajax({
        "type": "POST",
        "url": "load_admin.php",
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function LoadHistory(){
    $.ajax({
        "type": "POST",
        "url": "load_adminlog.php",
        "success": function(text){
            $(".log_output").html(text);
        }
    });
}

function AddAdmin(){
    var cParam = "";
    cParam = "slct_type="+$("#slct_type").val();
    cParam += "&txt_name="+$("#txt_name").val();
    cParam += "&txt_contact="+$("#txt_contact").val();
    cParam += "&txt_email="+$("#txt_email").val();
    cParam += "&txt_username="+$("#txt_username").val();
    cParam += "&txt_pass="+$("#txt_pass").val();

    $.ajax({
        "type":"POST",
        "url":"add_admin.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadAdmin();
                $(".message_div").text("New admin has been added successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_admin_modal").css("display", "none");
                Reset();
                
            }
        }
    });
}

function RemoveAdmin(admin_id){
    var cParam = "";
    cParam = "admin_id="+admin_id;
    $.ajax({
        "type": "POST",
        "url": "remove_admin.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadAdmin();
                $(".message_div").text("Admin has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_admin_modal").css("display", "none");
                Reset();
                
            }
        }
    });
}

function GetAdmin(admin_id){
    var cParam = "";
    cParam = "admin_id="+admin_id;

    $.ajax({
        "type": "POST",
        "url": "get_admin.php",
        "data": cParam,
        "success": function(text){
            var a_admin = JSON.parse(text);
            $("#slct_type").val(a_admin.type);
            $("#txt_name").val(a_admin.name);
            $("#txt_contact").val(a_admin.contact);
            $("#txt_email").val(a_admin.email);
            $("#txt_username").val(a_admin.username);
            $("#txt_pass").val(a_admin.password);
            $("#txt_admin_id").val(admin_id);

            $(".modify_title").text("Update Existing Admin");
            $("#btn_save").css("display", "none");
            $("#btn_update").css("display", "inline-block");
            $("#modify_admin_modal").css("display", "flex");

        }
    });
}

function UpdateAdmin(){
    var cParam = "";
    cParam = "slct_type="+$("#slct_type").val();
    cParam += "&txt_name="+$("#txt_name").val();
    cParam += "&txt_contact="+$("#txt_contact").val();
    cParam += "&txt_email="+$("#txt_email").val();
    cParam += "&txt_username="+$("#txt_username").val();
    cParam += "&txt_pass="+$("#txt_pass").val();
    cParam += "&admin_id="+$("#txt_admin_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_admin.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadAdmin();
                $(".message_div").text("Admin has been updated successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_admin_modal").css("display", "none");
                Reset();
                
            }
        }
    });
}