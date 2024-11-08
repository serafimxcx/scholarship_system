<?php 
    include("../navbar.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage School Fees</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">Scholarship Management</h5><br>
        <div class="admin_container">
            <button type="button" class="btn btn-danger" id="btn_create"><i class="bi bi-plus-lg"></i>&nbsp; Add New Scholarship</button>
            <br><br>
            <div class="records_output">

            </div>
        </div>
    </div>

    <div class="modal" id="modify_scholarship_modal">
        <div id="modify_scholarship_div">
            <table width="100%">
                <tr><td><h3 class="modify_title"><b>Add New Scholarship</b></h3></td>
                    <td style="text-align: right;"> <h3>
                    <button type="button" class="btn btn-default" id="btn_cancel" style="display: inline-block">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btn_save" style="display: inline-block">Save</button>
                    <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>
                    </h3>
                    
            </td></tr></table>
            <hr>
            <input type="hidden" id="txt_scholarship_id" class="txt_inpt">
            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Name: </label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="txt_name" class="form-control txt_inpt">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Description: </label>
                </div>
                <div class="col-md-9">
                    <textarea id="txt_desc" class="form-control txt_inpt"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Allowance: </label>
                </div>
                <div class="col-md-9">
                    <input type="number" id="txt_allowance" class="form-control txt_inpt" step="any" >
                </div>
            </div>
            <br><br>
            <label>Application Period</label><br>
            <div class="row">
                
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Start Date: </label>
                </div>
                <div class="col-md-3">
                    <input type="date" id="txt_startdate" class="form-control txt_inpt" >
                </div>
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>End Date: </label>
                </div>
                <div class="col-md-3">
                    <input type="date" id="txt_enddate" class="form-control txt_inpt" >
                </div>
            </div>
        </div>
    </div>
</body>
<script src="scholarship_script.js"></script>
</html>