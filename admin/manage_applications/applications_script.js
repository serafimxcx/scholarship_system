$(function(){
    LoadApplications(1);
    LoadYearsem();
    LoadProgram();
    LoadScholarship();

    $("#slct_yearsem").change(function(){
        LoadApplications(1);
    });

    $("#slct_program").change(function(){
        LoadApplications(1);
    });

    $("#slct_yearlevel").change(function(){
        LoadApplications(1);
    });

    $("#slct_scholarship").change(function(){
        LoadApplications(1);
    });

    $("#slct_status").change(function(){
        LoadApplications(1);
    });

    $("#slct_apptype").change(function(){
        LoadApplications(1);
    });

    $("#slct_rows").change(function(){
        LoadApplications(1);
    });

    $("#txt_name").change(function(){
        LoadApplications(1);
    });

    $(".btn_closemodal").click(function(){
        window.location.href="applications.php";
    });

    $(".btn_closemodal2").click(function(){
        $("#accept_applicant_modal").css("display","none");

    });


    $(document.body).on('click', '.btn_viewinfo', function(){
        var application_id = $(this).attr("application_id");

        window.location.href= "applications.php?application_id="+application_id+"&view_info=true";
    });

    $(document.body).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        if (page > 0) { 
            LoadApplications(page);
        }
    });

    $("#btn_accept").click(function(){
        var status = $("#slct_appstatus").val();
      
        if(confirm("Are you sure you want to accept this applicant? ")){
            if($("#txt_newallowance").val() == ""){
                $(".message_div").text("Please enter an allowance");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#txt_newallowance").focus();
            }else{
                UpdateApplication(status);
            }
        }
    });

    $("#slct_appstatus").change(function(){
        var status = $("#slct_appstatus").val();

        if(status != "Pending"){
            if(confirm(`Are you sure you want this applicant to be ${status} for the scholarship?`)){
                if(status=="Accepted"){
                    $("#accept_applicant_modal").css("display","flex");

                }else{
                    UpdateApplication(status);
                }
                
            }
            
            
        }
        
    });

    $("#btn_editapprove").click(function(){
        $("#accept_applicant_modal").css("display","flex");
    });

    $("#btn_update_accept").click(function(){
        var approve_id = $(this).attr("approve_id")
        if($("#txt_awardnumber").val() == ""){
            $(".message_div").text("Please enter an award number");
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
            $("#txt_awardnumber").focus();
        }else if($("#txt_newallowance").val() == ""){
            $(".message_div").text("Please enter an allowance");
            $(".message_div").fadeIn("fast");
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
            }, 2000);
            $("#txt_newallowance").focus();
        }else{
            EditApproveInfo(approve_id);
        }
    });

    $("#btn_print").click(function(){
        var application_id = $(this).attr("application_id");

        printForm(application_id);
    });
});

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Add New Scholarship");
    $(".txt_inpt").val("");

}

function LoadApplications(page){
    var cParam="";
    cParam = "name="+$("#txt_name").val();
    cParam += "&slct_yearsem="+$("#slct_yearsem").val();
    cParam += "&slct_program="+$("#slct_program").val();
    cParam += "&slct_yearlevel="+$("#slct_yearlevel").val();
    cParam += "&slct_scholarship="+$("#slct_scholarship").val();
    cParam += "&slct_status="+$("#slct_status").val();
    cParam += "&slct_apptype="+$("#slct_apptype").val();
    cParam += "&rows="+$("#slct_rows").val();
    cParam += "&page="+page;


    $.ajax({
        "type": "POST",
        "url": "load_applications.php",
        "data": cParam,
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function LoadYearsem(){
    $.ajax({
        "type": "POST",
        "url": "load_yearsem.php",
        "success": function(text){
            $("#slct_yearsem").append(text);
        }
    });
}

function LoadProgram(){
    $.ajax({
        "type": "POST",
        "url": "load_program.php",
        "success": function(text){
            $("#slct_program").append(text);
        }
    });
}

function LoadScholarship(){
    $.ajax({
        "type": "POST",
        "url": "load_scholarship.php",
        "success": function(text){
            $("#slct_scholarship").append(text);
        }
    });
}

function UpdateApplication(status){
    var cParam = "";
    cParam = "status="+status;
    cParam += "&application_id="+$("#application_id").val();
    cParam += "&scholarship_name="+$("#txt_scholarshipname").val();
    cParam += "&yearsem="+$("#txt_yearsem").val();
    cParam += "&student_name="+$("#txt_studentname").val();
    cParam += "&email="+$("#txt_email").val();
    cParam += "&award_number="+$("#txt_awardnumber").val();
    cParam += "&allowance="+$("#txt_newallowance").val();
    cParam += "&contact="+$("#txt_contact").val();

    $.ajax({
        "type": "POST",
        "url": "update_application.php",
        "data": cParam,
        "success": function(text){
            $(".message_div").text(text);
        
            setTimeout(function() {
                $('.message_div').fadeOut('slow');
                location.reload();

            }, 2000);
            
        },"beforeSend":function(){
            $(".message_div").text("Loading...");
            $(".message_div").fadeIn("fast");
        }
    });
}

function EditApproveInfo(approve_id){
    var cParam = "";
    cParam = "approve_id="+approve_id;
    cParam += "&award_number="+$("#txt_awardnumber").val();
    cParam += "&allowance="+$("#txt_newallowance").val();

    $.ajax({
        "type": "POST",
        "url": "update_approveinfo.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                $(".message_div").text("Info Updated Successfully");
                $(".message_div").fadeIn("fast");
                
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                    location.reload();

                }, 2000);
            
            }
        }
    });
}

function printForm(application_id){
    var cFile = "print_form1.php?application_id="+application_id;
    window.open(cFile, "_blank");
}
