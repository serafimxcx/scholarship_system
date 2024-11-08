<?php 
    include("../navbar.php");
    
    if($admin_type == "Staff"){
        echo "<script>alert('You have no access in this page.');
        window.location.href='/scholarship_system/admin/dashboard.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">User Admin and Login History Management</h5><br>
        <div class="row">
            <div class="col-md-6">
                <div class="admin_container">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="admin_title">Admin Management</h4>
                        </div>
                        <div class="col-md-6" style='text-align: right'>
                            <button type="button" class="btn btn-danger" id="btn_create"><i class="bi bi-person-plus-fill"></i>&nbsp; Create New Admin</button>
                        </div>
                    </div>
                    <br>
                    <div class="records_output">

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="admin_container">
                    <h4 class="admin_title">Login History</h4>
                    <br>
                    <div class="log_output">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modify_admin_modal">
        <div id="modify_admin_div">
            <table width="100%">
                <tr><td><h3 class="modify_title"><b>Create New Admin</b></h3></td>
                    <td style="text-align: right;"> <h3>
                    <button type="button" class="btn btn-default" id="btn_cancel" style="display: inline-block">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btn_save" style="display: inline-block">Save</button>
                    <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>
                    </h3>
                    
            </td></tr></table>
            <hr>
            <input type="hidden" id="txt_admin_id" class="txt_inpt">
            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Admin Type: </label>
                </div>
                <div class="col-md-9">
                    <select id="slct_type" class="form-control txt_inpt">
                        <option value="">Select...</option>
                        <option value="Head Admin">Head Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
            </div>

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
                    <label>Contact No: </label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="txt_contact" class="form-control txt_inpt">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Email: </label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="txt_email" class="form-control txt_inpt">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Username: </label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="txt_username" class="form-control txt_inpt">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="transform: translateY(25%);">
                    <label>Password: </label>
                </div>
                <div class="col-md-9">
                    <input type="password" id="txt_pass" class="form-control txt_inpt">
                </div>
            </div>

            <br>
        </div>
    </div>
</body>
<script src="admin_script.js"></script>
</html>