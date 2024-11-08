let selectedFees = [];


$(function(){
    LoadPrograms();
    LoadYearLevel();

    $("#btn_create").click(function(){
        $("#modify_program_modal").css("display", "flex");
    });

    $("#btn_cancel").click(function(){
        Reset();
        $("#modify_program_modal").css("display", "none");
        
    });

    $("#btn_cancel2").click(function(){
        $("#btn_cancel2").css("display", "none");

        Reset();
        
    });

    $(".btn_closemodal").click(function(){
        window.location.href="program.php";
    });

    $(document.body).on('click', '.btn_del', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var program_id = $(this).attr("program_id");
            RemoveProgram(program_id);
        }
    });

    $(document.body).on('click', '.btn_edit', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var program_id = $(this).attr("program_id");
            GetProgram(program_id);
        }
    });

    $(document.body).on('click', '.btn_yearlevel', function(){
        var program_id = $(this).attr("program_id");
        window.location.href="program.php?program_id="+program_id+"&modify_yearlevel=true";
        
    });

    $("#btn_save").click(function(){
        if(confirm("Are you sure you want to save this record?")){
            if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name for this program.");
                $("#txt_name").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_cost").val() == ""){
                $(".message_div").text("Please enter a cost per unit for this program.");
                $("#txt_cost").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                AddProgram();
            }
        }
    });

    $("#btn_update").click(function(){
        if(confirm("Are you sure you want to update this record?")){
            if($("#txt_name").val() == ""){
                $(".message_div").text("Please enter a name for this program.");
                $("#txt_name").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else if($("#txt_cost").val() == ""){
                $(".message_div").text("Please enter a cost per unit for this program.");
                $("#txt_cost").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                UpdateProgram();
            }
        }
    });

    $('.includedFees').change(function() {
        updateSelectedFees();
    });

    updateSelectedFees();

    $("#btn_save2").click(function(){
        if(confirm("Are you sure you want to save this data")){
            if($("#slct_yearlevel").val() == ""){
                $(".message_div").text("Please select a year for this program.");
                $("#slct_yearlevel").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                AddYearLevel();
                
            }
        }
    });

    $("#btn_update2").click(function(){
        if(confirm("Are you sure you want to update this data")){
            if($("#slct_yearlevel").val() == ""){
                $(".message_div").text("Please select a year for this program.");
                $("#slct_yearlevel").focus()
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
            }else{
                UpdateYearLevel();
                
            }
        }
    });

    $(document.body).on('click', '.btn_delyr', function(){
        if(confirm("Are you sure you want to delete this record?")){
            var yearlevel_id = $(this).attr("yearlevel_id");
            RemoveYearLevel(yearlevel_id);
        }
    });

    $(document.body).on('click', '.btn_edityr', function(){
        if(confirm("Are you sure you want to edit this record?")){
            var yearlevel_id = $(this).attr("yearlevel_id");
            GetYearLevel(yearlevel_id);
        }
    });


});

function updateSelectedFees() {
    selectedFees = [];
    $('.includedFees:checked').each(function() {
        selectedFees.push($(this).val());
    });
    let selectedFeesString = selectedFees.join(',');
    $("#txt_fees").val(selectedFeesString);
}

function Reset(){
    $("#btn_save").css("display", "inline-block");
    $("#btn_update").css("display", "none");
    $(".modify_title").text("Add New Program");

    $("#btn_save2").css("display", "inline-block");
    $("#btn_update2").css("display", "none");
    $(".modify_title2").text("Add New Year Level");

    $(".txt_inpt").val("");

    $('.includedFees').prop('checked', false);
    updateSelectedFees();

}


function LoadPrograms(){
    $.ajax({
        "type": "POST",
        "url": "load_programs.php",
        "success": function(text){
            $(".records_output").html(text);
        }
    });
}

function LoadYearLevel(){
    var cParam ="";
    cParam = "program_id="+$("#program_id").val();
    $.ajax({
        "type": "POST",
        "url": "load_yearlevel.php",
        "data": cParam,
        "success": function(text){
            $(".yearlevel_output").html(text);
        }
    });
}

function AddProgram(){
    var cParam = "";

    cParam = "txt_name="+$("#txt_name").val();
    cParam += "&txt_cost="+$("#txt_cost").val();

    $.ajax({
        "type": "POST",
        "url": "add_program.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadPrograms();
                $(".message_div").text("New Program has been added successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_program_modal").css("display", "none");
                Reset();
            }
        }
    });
}

function RemoveProgram(program_id){
    var cParam = "";
    cParam = "program_id="+program_id;
    $.ajax({
        "type": "POST",
        "url": "remove_program.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadPrograms();
                $(".message_div").text("A program has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                
            }
        }
    });
}

function GetProgram(program_id){
    var cParam = "";
    cParam = "program_id="+program_id;

    $.ajax({
        "type": "POST",
        "url": "get_program.php",
        "data": cParam,
        "success": function(text){
            var a_program = JSON.parse(text);
            $("#txt_name").val(a_program.name);
            $("#txt_cost").val(a_program.cost);
            $("#txt_program_id").val(program_id);

            $(".modify_title").text("Update Existing Program");
            $("#btn_save").css("display", "none");
            $("#btn_update").css("display", "inline-block");
            $("#modify_program_modal").css("display", "flex");

        }
    });
}

function UpdateProgram(){
    var cParam = "";

    cParam = "txt_name="+$("#txt_name").val();
    cParam += "&txt_cost="+$("#txt_cost").val();
    cParam += "&program_id="+$("#txt_program_id").val();

    $.ajax({
        "type": "POST",
        "url": "update_program.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                console.log(text);
            }else{
                LoadPrograms();
                $(".message_div").text("Existing Program has been updated successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                $("#modify_program_modal").css("display", "none");
                Reset();
            }
        }
    });
}

function AddYearLevel(){
    var cParam = "";

    cParam = "slct_yearlevel="+$("#slct_yearlevel").val();
    cParam += "&program_id="+$("#program_id").val();
    cParam += "&txt_fees="+$("#txt_fees").val();

    $.ajax({
        "type": "POST",
        "url": "add_yearlevel.php",
        "data": cParam,
        "success": function(text){
            if(text != ""){
                console.log(text);
            }else{
                LoadYearLevel();
                $(".message_div").text("A year level has been added successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                Reset();
            }
        }
    });
}

function RemoveYearLevel(yearlevel_id){
    var cParam = "";
    cParam = "yearlevel_id="+yearlevel_id;
    $.ajax({
        "type": "POST",
        "url": "remove_yearlevel.php",
        "data": cParam,
        "success": function(text){
            if(text !== ""){
                alert(text);
            }else{
                LoadYearLevel();
                $(".message_div").text("A year level has been removed successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                
            }
        }
    });
}

function GetYearLevel(yearlevel_id){
    var cParam = "";
    cParam = "yearlevel_id="+yearlevel_id;

    $.ajax({
        "type": "POST",
        "url": "get_yearlevel.php",
        "data": cParam,
        "success": function(text){
            var a_yearlevel = JSON.parse(text);
            $("#slct_yearlevel").val(a_yearlevel.name);

            $("#txt_fees").val(a_yearlevel.fees_id);

            var fees_id = a_yearlevel.fees_id;

            let feesArray = fees_id.split(',');

            feesArray.forEach(function(feeId) {
                $('#fee' + feeId).prop('checked', true);
            });

            $("#txt_yearlevel_id").val(yearlevel_id);

            $(".modify_title2").text("Update Existing Year Level");
            $("#btn_save2").css("display", "none");
            $("#btn_update2").css("display", "inline-block");
            $("#btn_cancel2").css("display", "inline-block");

        }
    });
}

function UpdateYearLevel(){
    var cParam = "";

    cParam = "slct_yearlevel="+$("#slct_yearlevel").val();
    cParam += "&program_id="+$("#program_id").val();
    cParam += "&txt_fees="+$("#txt_fees").val();
    cParam += "&yearlevel_id="+$("#txt_yearlevel_id").val();



    $.ajax({
        "type": "POST",
        "url": "update_yearlevel.php",
        "data": cParam,
        "success": function(text){
            if(text != ""){
                console.log(text);
            }else{
                LoadYearLevel();
                $(".message_div").text("A year level has been updated successfully.");
                $(".message_div").fadeIn("fast");
                setTimeout(function() {
                    $('.message_div').fadeOut('slow');
                }, 2000);
                Reset();
            }
        }
    });
}