$(function(){
    LoadScholarship();
    LoadYearsem();
    LoadProgram();
    LoadFees();
    var file = "";

    $("#slct_scholarship").change(function(){
        $(".fees_container").css("display", "none");
        
        if($("#slct_scholarship").val() == ""){
            $(".other_filter_div").css("display", "none");
        }else{
            $(".other_filter_div").css("display", "block");

            $("#slct_file").empty();
            LoadFiles($("#slct_scholarship").val());
            LoadPayroll();

        }
        
    
    });

    $("#slct_file").change(function(){
        file = $("#slct_file").val();
        if( file == "tes_annex5"){
            $("#slct_apptype").val("New");
            $("#slct_apptype").prop("disabled", true);
            $(".fees_container").css("display", "none");

        }else if( file == "tes_annex2"){
            $("#slct_apptype").val("Continuing");
            $("#slct_apptype").prop("disabled", true);
            $(".fees_container").css("display", "none");

        }else if(file == "fhe_billing_statement"){
            $(".fees_container").css("display", "block");
        }
        else{
            $("#slct_apptype").val("");
            $("#slct_apptype").prop("disabled", false);
            $(".fees_container").css("display", "none");


        }

        LoadPayroll();

    });

    $("#slct_yearsem1").change(function(){
        LoadPayroll();
    });

    $("#slct_yearsem2").change(function(){
        LoadPayroll();
    });

    $("#slct_program").change(function(){
        LoadPayroll();
    });

    $("#slct_yearlevel").change(function(){
        LoadPayroll();
    });

    $("#slct_apptype").change(function(){
        LoadPayroll();
    });

    $("#btn_print").click(function(){
        if($("#slct_file").val() == ""){
            $(".message_div").text("Please choose a file.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#slct_file").focus();
        }else if($("#slct_yearsem1").val() == ""){
            $(".message_div").text("Select an academic year.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#slct_yearsem1").focus();

        }else if((file == "tes_form1" || file == "tes_form2" || file == "tdp_form2" || file == "tdp_form4" || file == "tdp_annex5") && $("#slct_apptype").val() == ""){
            $(".message_div").text("Select an applicant type.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            $("#slct_apptype").focus();

        }else{
            
            print();
        }
    });

    $("#btn_excel").click(function(){
        if($("#slct_file").val() == ""){
            $(".message_div").text("Please choose a file.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#slct_file").focus();
        }else if($("#slct_yearsem1").val() == ""){
            $(".message_div").text("Select an academic year.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#slct_yearsem1").focus();

        }else if((file == "tes_form1" || file == "tes_form2" || file == "tdp_form2" || file == "tdp_form4" || file == "tdp_annex5") && $("#slct_apptype").val() == ""){
            $(".message_div").text("Select an applicant type.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            $("#slct_apptype").focus();

        }else{
            
            exportExcel();
        }
    });

});

function LoadScholarship(){
    $.ajax({
        "type": "POST",
        "url": "../manage_applications/load_scholarship.php",
        "success": function(text){
            $("#slct_scholarship").append(text);
        }
    });
}

function LoadYearsem(){
    $.ajax({
        "type": "POST",
        "url": "../manage_applications/load_yearsem.php",
        "success": function(text){
            $("#slct_yearsem1").append(text);
            $("#slct_yearsem2").append(text);
        }
    });
}


function LoadProgram(){
    $.ajax({
        "type": "POST",
        "url": "../manage_applications/load_program.php",
        "success": function(text){
            $("#slct_program").append(text);
        }
    });
}

function LoadFees(){
    $.ajax({
        "type": "POST",
        "url": "load_fees.php",
        "success": function(text){
            $("#slct_fee").append(text);
        }
    });
}


function LoadPayroll(){
    var cParam ="";
    cParam = "slct_yearsem1="+$("#slct_yearsem1").val();
    cParam += "&slct_yearsem2="+$("#slct_yearsem2").val();
    cParam += "&slct_program="+$("#slct_program").val();
    cParam += "&slct_yearlevel="+$("#slct_yearlevel").val();
    cParam += "&slct_scholarship="+$("#slct_scholarship").val();
    cParam += "&slct_apptype="+$("#slct_apptype").val();


    $.ajax({
        "type": "POST",
        "url": "load_payroll.php",
        "data": cParam,
        "success": function(text){
            $(".records_container").html(text);

        }
    });
}

function print(){
    var cParam ="";
    cParam = "slct_yearsem1="+$("#slct_yearsem1").val();
    cParam += "&slct_yearsem2="+$("#slct_yearsem2").val();
    cParam += "&slct_program="+$("#slct_program").val();
    cParam += "&slct_yearlevel="+$("#slct_yearlevel").val();
    cParam += "&slct_scholarship="+$("#slct_scholarship").val();
    cParam += "&slct_apptype="+$("#slct_apptype").val();
    cParam += "&slct_file="+$("#slct_file").val();
    cParam += "&slct_fee="+$("#slct_fee").val();


    var cFile = "print_payroll.php?"+cParam;
    window.open(cFile, "_blank");
}

function exportExcel(){
    var cParam ="";
    cParam = "slct_yearsem1="+$("#slct_yearsem1").val();
    cParam += "&slct_yearsem2="+$("#slct_yearsem2").val();
    cParam += "&slct_program="+$("#slct_program").val();
    cParam += "&slct_yearlevel="+$("#slct_yearlevel").val();
    cParam += "&slct_scholarship="+$("#slct_scholarship").val();
    cParam += "&slct_apptype="+$("#slct_apptype").val();
    cParam += "&slct_file="+$("#slct_file").val();
    cParam += "&slct_fee="+$("#slct_fee").val();


    var cFile = "export_excel.php?"+cParam;
    window.open(cFile, "_blank");
}

function LoadFiles(scholarship_id){
    var cParam = "";

    cParam = "scholarship_id="+scholarship_id;
   
    $.ajax({
        "type": "POST",
        "url": "load_files.php",
        "data": cParam,
        "success":function(text){
            $("#slct_file").append(text);
        }
    });
}