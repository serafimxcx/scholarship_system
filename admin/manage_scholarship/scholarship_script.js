$(function(){
    LoadScholarship();

    $("#btn_create").click(function(){
        $("#modify_scholarship_modal").css("display", "flex");
    });

    $("#btn_cancel").click(function(){
        Reset();
        $("#modify_scholarship_modal").css("display", "none");
        
    });

    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to add this record?")){
            if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name for scholarship.");
                $("#txt_name").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_desc").val() == ""){
                $(".message_div").text("Please enter a description.");
                $("#txt_desc").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_allowance").val() == ""){
                $(".message_div").text("Please enter an allowance.");
                $("#txt_allowance").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_startdate").val() == ""){
                $(".message_div").text("Please enter a start date.");
                $("#txt_startdate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_enddate").val() == ""){
                $(".message_div").text("Please enter a end date.");
                $("#txt_enddate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                AddScholarship();
            }
        }
        
    });

    $("#btn_update").click(function(){
        if(confirm("Are you sure you want to update this record?")){
            if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name for scholarship.");
                $("#txt_name").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_desc").val() == ""){
                $(".message_div").text("Please enter a description.");
                $("#txt_desc").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_allowance").val() == ""){
                $(".message_div").text("Please enter an allowance.");
                $("#txt_allowance").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_startdate").val() == ""){
                $(".message_div").text("Please enter a start date.");
                $("#txt_startdate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_enddate").val() == ""){
                $(".message_div").text("Please enter a end date.");
                $("#txt_enddate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                UpdateScholarship();
            }
        }
    });

    $(document.body).on('click', '.btn_del', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var scholarship_id = $(this).attr("scholarship_id");
            RemoveScholarship(scholarship_id);
        }
    });

    $(document.body).on('click', '.btn_edit', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var scholarship_id = $(this).attr("scholarship_id");
            GetScholarship(scholarship_id);
        }
    });

});

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Add New Scholarship");
    $(".txt_inpt").val("");

}

function LoadScholarship(){
    $.ajax({
        "type": "POST",
        "url": "load_scholarships.php",
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function AddScholarship(){
    var cParam = "";

    cParam = "txt_name="+$("#txt_name").val();
    cParam += "&txt_desc="+$("#txt_desc").val();
    cParam += "&txt_allowance="+$("#txt_allowance").val();
    cParam += "&txt_startdate="+$("#txt_startdate").val();
    cParam += "&txt_enddate="+$("#txt_enddate").val();

    $.ajax({
        "type": "POST",
        "url": "add_scholarship.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadScholarship();
                $(".message_div").text("New scholarship has been added successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_scholarship_modal").css("display", "none");
                Reset();
            }
        }
    });
}

function RemoveScholarship(scholarship_id){
    var cParam = "";
    cParam = "scholarship_id="+scholarship_id;
    $.ajax({
        "type": "POST",
        "url": "remove_scholarship.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadScholarship();
                $(".message_div").text("Scholarship has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                
            }
        }
    });
}

function GetScholarship(scholarship_id){
    var cParam = "";
    cParam = "scholarship_id="+scholarship_id;

    $.ajax({
        "type": "POST",
        "url": "get_scholarship.php",
        "data": cParam,
        "success": function(text){
            var a_scholarship = JSON.parse(text);
            $("#txt_name").val(a_scholarship.name);
            $("#txt_desc").val(a_scholarship.description);
            $("#txt_allowance").val(a_scholarship.allowance);
            $("#txt_startdate").val(a_scholarship.start_date);
            $("#txt_enddate").val(a_scholarship.end_date);
            $("#txt_scholarship_id").val(scholarship_id);

            $(".modify_title").text("Update Existing Scholarship");
            $("#btn_save").css("display", "none");
            $("#btn_update").css("display", "inline-block");
            $("#modify_scholarship_modal").css("display", "flex");

        }
    });
}

function UpdateScholarship(){
    var cParam = "";
    cParam = "&txt_name="+$("#txt_name").val();
    cParam += "&txt_desc="+$("#txt_desc").val();
    cParam += "&txt_allowance="+$("#txt_allowance").val();
    cParam += "&txt_startdate="+$("#txt_startdate").val();
    cParam += "&txt_enddate="+$("#txt_enddate").val();
    cParam += "&scholarship_id="+$("#txt_scholarship_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_scholarship.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadScholarship();
                $(".message_div").text("Scholarship has been updated successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_scholarship_modal").css("display", "none");
                Reset();
                
            }
        }
    });
}