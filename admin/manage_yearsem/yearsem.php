<?php 
    include("../navbar.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Academic Year & Semester</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">Academic Year and Semester Management</h5><br>
        <div class="admin_container">
            <button type="button" class="btn btn-danger" id="btn_create"><i class="bi bi-plus-lg"></i>&nbsp; Add New AY and Semester</button>

            <br><br>
            <div class="records_output">

            </div>
        </div>
    </div>

    <div class="modal" id="modify_yearsem_modal">
        <div id="modify_yearsem_div">
            <table width="100%">
                <tr><td><h3 class="modify_title"><b>Add New AY and Semester</b></h3></td>
                    <td style="text-align: right;"> <h3>
                    <button type="button" class="btn btn-default" id="btn_cancel" style="display: inline-block">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btn_save" style="display: inline-block">Save</button>
                    <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>
                    </h3>
                    
            </td></tr></table>
            <hr>
            <input type="hidden" id="txt_yearsem_id" class="txt_inpt">

            <label>Academic Period</label><br>
            <div class="row">
                
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Start Year: </label>
                    
                </div>
                <div class="col-md-3">
                    <select id="slct_startyear" class="form-control txt_inpt" >
                        <option value="">Select...</option>
                        <?php
                        $start_year = 2020;
                        $end_year = date('Y') + 2; 

                        for ($year = $end_year; $year >= $start_year; $year--) {
                            echo "<option value='$year'>$year</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>End Year: </label>
                </div>
                <div class="col-md-3">
                    <select id="slct_endyear" class="form-control txt_inpt" >
                        <option value="">Select...</option>
                        <?php
                        $start_year = 2020;
                        $end_year = date('Y') + 2; 

                        for ($year = $end_year; $year >= $start_year; $year--) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Semester: </label>
                </div>
                <div class="col-md-9">
                    <select id="slct_semester" class="form-control txt_inpt">
                        <option value="">Select...</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                    </select>
                </div>
            </div>
            <br>
            <label>Semester Period</label><br>
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
<script src="yearsem_script.js"></script>
</html>