$(function(){
    LoadYearSem();

    $("#btn_create").click(function(){
        $("#modify_yearsem_modal").css("display", "flex");
    });

    $("#btn_cancel").click(function(){
        Reset();
        $("#modify_yearsem_modal").css("display", "none");
        
    });

    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to save this record?")){
            if($("#slct_startyear").val() == ""){
                $(".message_div").text("Please select a starting year for this academic period.");
                $("#slct_startyear").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_endyear").val() == ""){
                $(".message_div").text("Please select a ending year for this academic period.");
                $("#slct_endyear").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_semester").val() == ""){
                $(".message_div").text("Please select a semester.");
                $("#slct_semester").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_startdate").val() == ""){
                $(".message_div").text("Please enter a start date for this semester.");
                $("#txt_startdate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_enddate").val() == ""){
                $(".message_div").text("Please enter an end date for this semester.");
                $("#txt_enddate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                AddYearSem();
            }
        }
    });

    $("#btn_update").click(function(){
        if(confirm("Are you sure you want to update this record?")){
            if($("#slct_startyear").val() == ""){
                $(".message_div").text("Please select a starting year for this academic period.");
                $("#slct_startyear").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_endyear").val() == ""){
                $(".message_div").text("Please select a ending year for this academic period.");
                $("#slct_endyear").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_semester").val() == ""){
                $(".message_div").text("Please select a semester.");
                $("#slct_semester").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_startdate").val() == ""){
                $(".message_div").text("Please enter a start date for this semester.");
                $("#txt_startdate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_enddate").val() == ""){
                $(".message_div").text("Please enter an end date for this semester.");
                $("#txt_enddate").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                UpdateYearSem();
            }
        }
    });

    $(document.body).on('click', '.btn_del', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var yearsem_id = $(this).attr("yearsem_id");
            RemoveYearSem(yearsem_id);
        }
    });

    $(document.body).on('click', '.btn_edit', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var yearsem_id = $(this).attr("yearsem_id");
            GetYearSem(yearsem_id);
        }
    });

});

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Add New AY and Semester");
    $(".txt_inpt").val("");

}

function LoadYearSem(){
    $.ajax({
        "type": "POST",
        "url": "load_yearsem.php",
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function AddYearSem(){
    var cParam = "";

    cParam = "slct_startyear="+$("#slct_startyear").val();
    cParam += "&slct_endyear="+$("#slct_endyear").val();
    cParam += "&slct_semester="+$("#slct_semester").val();
    cParam += "&txt_startdate="+$("#txt_startdate").val();
    cParam += "&txt_enddate="+$("#txt_enddate").val();

    $.ajax({
        "type": "POST",
        "url": "add_yearsem.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadYearSem();
                $(".message_div").text("New AY/Semester has been added successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_yearsem_modal").css("display", "none");
                Reset();
            }
        }
    });
}

function RemoveYearSem(yearsem_id){
    var cParam = "";
    cParam = "yearsem_id="+yearsem_id;
    $.ajax({
        "type": "POST",
        "url": "remove_yearsem.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadYearSem();
                $(".message_div").text("AY/Semester has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                
            }
        }
    });
}

function GetYearSem(yearsem_id){
    var cParam = "";
    cParam = "yearsem_id="+yearsem_id;

    $.ajax({
        "type": "POST",
        "url": "get_yearsem.php",
        "data": cParam,
        "success": function(text){
            var a_yearsem = JSON.parse(text);
            $("#slct_startyear").val(a_yearsem.start_year);
            $("#slct_endyear").val(a_yearsem.end_year);
            $("#slct_semester").val(a_yearsem.semester);
            $("#txt_startdate").val(a_yearsem.start_date);
            $("#txt_enddate").val(a_yearsem.end_date);
            $("#txt_yearsem_id").val(yearsem_id);

            $(".modify_title").text("Update Existing AY and Semester");
            $("#btn_save").css("display", "none");
            $("#btn_update").css("display", "inline-block");
            $("#modify_yearsem_modal").css("display", "flex");

        }
    });
}

function UpdateYearSem(){
    var cParam = "";

    cParam = "slct_startyear="+$("#slct_startyear").val();
    cParam += "&slct_endyear="+$("#slct_endyear").val();
    cParam += "&slct_semester="+$("#slct_semester").val();
    cParam += "&txt_startdate="+$("#txt_startdate").val();
    cParam += "&txt_enddate="+$("#txt_enddate").val();
    cParam += "&yearsem_id="+$("#txt_yearsem_id").val();

    $.ajax({
        "type": "POST",
        "url": "update_yearsem.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadYearSem();
                $(".message_div").text("AY/Semester has been updated successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_yearsem_modal").css("display", "none");
                Reset();
            }
        }
    });
}
