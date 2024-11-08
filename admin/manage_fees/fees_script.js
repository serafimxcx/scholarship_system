$(function(){
    LoadFees();

    $("#btn_create").click(function(){
        $("#modify_fees_modal").css("display", "flex");
    });

    $("#btn_cancel").click(function(){
        Reset();
        $("#modify_fees_modal").css("display", "none");
        
    });

    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to add this record?")){
            if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name for this fee.");
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
            }else if($("#txt_amount").val() == ""){
                $(".message_div").text("Please enter an amount.");
                $("#txt_amount").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_coverage").val() == ""){
                $(".message_div").text("Please select a coverage if per unit or per sem.");
                $("#slct_coverage").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_frequency").val() == ""){
                $(".message_div").text("Please select a frequency per AY.");
                $("#slct_frequency").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_refno").val() == ""){
                $(".message_div").text("Please enter the Reference/BOT resolution number.");
                $("#txt_refno").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_date").val() == ""){
                $(".message_div").text("Please enter the date of approval for BOT Resolution.");
                $("#txt_date").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                AddFee();   
            }
        }
    });

    $("#btn_update").click(function(){
        if(confirm("Are you sure you want to add this record?")){
            if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name for this fee.");
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
            }else if($("#txt_amount").val() == ""){
                $(".message_div").text("Please enter an amount.");
                $("#txt_amount").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_coverage").val() == ""){
                $(".message_div").text("Please select a coverage if per unit or per sem.");
                $("#slct_coverage").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#slct_frequency").val() == ""){
                $(".message_div").text("Please select a frequency per AY.");
                $("#slct_frequency").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_refno").val() == ""){
                $(".message_div").text("Please enter the Reference/BOT resolution number.");
                $("#txt_refno").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_date").val() == ""){
                $(".message_div").text("Please enter the date of approval for BOT Resolution.");
                $("#txt_date").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                UpdateFee();   
            }
        }
    });

    $(document.body).on('click', '.btn_del', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var fee_id = $(this).attr("fee_id");
            RemoveFee(fee_id);
        }
    });

    $(document.body).on('click', '.btn_edit', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var fee_id = $(this).attr("fee_id");
            GetFee(fee_id);
        }
    });
});

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Add New Fee");
    $(".txt_inpt").val("");

}

function LoadFees(){
    $.ajax({
        "type": "POST",
        "url": "load_fees.php",
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function AddFee(){
    var cParam = "";

    cParam = "txt_name="+$("#txt_name").val();
    cParam += "&txt_desc="+$("#txt_desc").val();
    cParam += "&txt_amount="+$("#txt_amount").val();
    cParam += "&slct_coverage="+$("#slct_coverage").val();
    cParam += "&slct_frequency="+$("#slct_frequency").val();
    cParam += "&txt_refno="+$("#txt_refno").val();
    cParam += "&txt_date="+$("#txt_date").val();

    $.ajax({
        "type": "POST",
        "url": "add_fee.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadFees();
                $(".message_div").text("New School Fee has been added successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_fees_modal").css("display", "none");
                Reset();
            }
        }
    });
}

function RemoveFee(fee_id){
    var cParam = "";
    cParam = "fee_id="+fee_id;
    $.ajax({
        "type": "POST",
        "url": "remove_fee.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadFees();
                $(".message_div").text("A School Fee has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                
            }
        }
    });
}

function GetFee(fee_id){
    var cParam = "";
    cParam = "fee_id="+fee_id;

    $.ajax({
        "type": "POST",
        "url": "get_fee.php",
        "data": cParam,
        "success": function(text){
            var a_fee = JSON.parse(text);
            $("#txt_name").val(a_fee.name);
            $("#txt_desc").val(a_fee.description.replace(/<br\s*\/?>/gi, "\n"));
            $("#txt_amount").val(a_fee.amount);
            $("#slct_coverage").val(a_fee.coverage);
            $("#slct_frequency").val(a_fee.frequency);
            $("#txt_refno").val(a_fee.ref_no);
            $("#txt_date").val(a_fee.approval_date);
            $("#txt_fee_id").val(fee_id);

            $(".modify_title").text("Update Existing Fee");
            $("#btn_save").css("display", "none");
            $("#btn_update").css("display", "inline-block");
            $("#modify_fees_modal").css("display", "flex");

        }
    });
}

function UpdateFee(){
    var cParam = "";
    cParam = "&txt_name="+$("#txt_name").val();
    cParam += "&txt_desc="+$("#txt_desc").val();
    cParam += "&txt_amount="+$("#txt_amount").val();
    cParam += "&slct_coverage="+$("#slct_coverage").val();
    cParam += "&slct_frequency="+$("#slct_frequency").val();
    cParam += "&txt_refno="+$("#txt_refno").val();
    cParam += "&txt_date="+$("#txt_date").val();
    cParam += "&fee_id="+$("#txt_fee_id").val();

    $.ajax({
        "type":"POST",
        "url":"update_fee.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadFees();
                $(".message_div").text("Scholar Fee has been updated successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_fees_modal").css("display", "none");
                Reset();
                
            }
        }
    });
}