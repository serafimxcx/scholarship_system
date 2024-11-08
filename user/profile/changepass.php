<?php 
    include("../navbar.php");
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <div class="header user_header">
    <table width="100%">
        <tr>
            <td><span class="navbar-btn user_navbar" onclick="openNav()">&#9776;</span></td>
            <td style='text-align:right; color: #65171e;'><h2><b>CHANGE PASSWORD</b></h2><h4>Scholarship Application</h4></td>
        </tr>
    </table>
    </div>
    
    <div class="content_container user_content_container">
        <div class="admin_container profile_container">
            <div class="row">
                <div class="col-md-2" style="transform: translateY(25%)">
                    <label >Old Password:</label>
                </div>
                <div class="col-md-4">
                    <input type="password" id="txt_oldpass" class="form-control txt_inpt">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2" style="transform: translateY(25%)">
                    <label >New Password:</label>
                </div>
                <div class="col-md-4">
                    <input type="password" id="txt_newpass" class="form-control txt_inpt">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2" style="transform: translateY(25%)">
                    <label >Retype New Password:</label>
                </div>
                <div class="col-md-4">
                    <input type="password" id="txt_newpass2" class="form-control txt_inpt">
                </div>
            </div>
            <br>
            <button type="button" id="btn_save" class="btn btn-danger">Change Password</button>
        </div>
    </div>

    
    
</body>
    <script src="changepass_script.js"></script>
</html>