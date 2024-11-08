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
        <h5 class="content_title">School Fees Management</h5><br>

        <div class="admin_container">
            <button type="button" class="btn btn-danger" id="btn_create"><i class="bi bi-plus-lg"></i>&nbsp; Add New Fee</button>
            <br>
            <br>
            <div class="records_output">

            </div>
        </div>
    </div>

    <div class="modal" id="modify_fees_modal">
        <div id="modify_fees_div">
            <table width="100%">
                <tr><td><h3 class="modify_title"><b>Add New Fee</b></h3></td>
                    <td style="text-align: right;"> <h3>
                    <button type="button" class="btn btn-default" id="btn_cancel" style="display: inline-block">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btn_save" style="display: inline-block">Save</button>
                    <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>
                    </h3>
                    
            </td></tr></table>
            <hr>
            <input type="hidden" id="txt_fee_id" class="txt_inpt">
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
                    <label>Amount: </label>
                </div>
                <div class="col-md-9">
                    <input type="number" id="txt_amount" class="form-control txt_inpt" step="any" >
                </div>
            </div>

            <br>
            <div class="row">
                
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Coverage: </label>
                </div>
                <div class="col-md-3">
                    <select id="slct_coverage" class="form-control txt_inpt" >
                        <option value="">Select...</option>
                        <option value="per unit">Per Unit</option>
                        <option value="per student">Per Student</option>
                    </select>
                </div>
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Frequency: </label>
                </div>
                <div class="col-md-3">
                    <select id="slct_frequency" class="form-control txt_inpt" >
                        <option value="">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Reference No: </label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="txt_refno" class="form-control txt_inpt" placeholder="BOT Resolution Number">
                    
                </div>

            </div>
            
            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Approval Date: </label>
                </div>
                <div class="col-md-9">
                    <input type="date" id="txt_date" class="form-control txt_inpt" >

                </div>
            </div>

        </div>
    </div>
</body>
<script src="fees_script.js"></script>
</html>