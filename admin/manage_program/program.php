<?php 
    include("../navbar.php");

    $program_name = "";
    $program_id = "";

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Programs</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">Program Management</h5><br>

        <div class="admin_container">
            <button type="button" class="btn btn-danger" id="btn_create"><i class="bi bi-plus-lg"></i>&nbsp; Add New Program</button>
            <br><br>
            <div class="records_output">

            </div>
        </div>
    </div>

    <div class="modal" id="modify_program_modal">
        <div id="modify_program_div">
            <table width="100%">
                <tr><td><h3 class="modify_title"><b>Add New Program</b></h3></td>
                    <td style="text-align: right;"> <h3>
                    <button type="button" class="btn btn-default" id="btn_cancel" style="display: inline-block">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btn_save" style="display: inline-block">Save</button>
                    <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>
                    </h3>
                    
            </td></tr></table>
            <hr>
            <input type="hidden" id="txt_program_id" class="txt_inpt">
            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Name: </label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="txt_name" class="form-control txt_inpt" placeholder="Bachelor of ____ in ______">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Cost per Unit: </label>
                </div>
                <div class="col-md-9">
                    <input type="number" id="txt_cost" class="form-control txt_inpt" step="any" >
                </div>
            </div>

        </div>
    </div>

    <!--modal for adding year level-->
    <?php 
        include_once("modify_yearlevel_modal.php");
    ?>
</body>
<script src="program_script.js"></script>
</html>