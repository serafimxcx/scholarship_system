<?php 
    include("../navbar.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Announcements</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">Announcements</h5><br>

        <div class="admin_container">
            <button type="button" class="btn btn-danger" id="btn_create"><i class="bi bi-plus-lg"></i>&nbsp; Add New Announcement</button>
            <br><br>
            <div class="records_output">

            </div>
        </div>
    </div>

    <div class="modal" id="modify_announcement_modal">
       
        <div id="modify_announcement_div">
            <form enctype="multipart/form-data" id="add_announcement_form">
                <table width="100%">
                    <tr><td><h3 class="modify_title"><b>Add New Announcement</b></h3></td>
                        <td style="text-align: right;"> <h3>
                        <button type="button" class="btn btn-default" id="btn_cancel" style="display: inline-block">Cancel</button>
                        <button type="button" class="btn btn-danger" id="btn_save" style="display: inline-block">Save</button>
                        <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>
                        </h3>
                        
                </td></tr></table>
                <hr>
                <input type="hidden" name="txt_announcement_id" id="txt_announcement_id" class="txt_inpt">
                <div class="row">
                    <div class="col-md-3" style="transform: translateY(25%);">
                        <label>Title: </label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="txt_title" id="txt_title" class="form-control txt_inpt" >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3" style="transform: translateY(25%);">
                        <label>Content: </label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="txt_body" id="txt_body" class="form-control txt_input"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="transform: translateY(25%);">
                        <label>Image: </label>
                    </div>
                    <div class="col-md-9">
                        <input type="file" name="slct_image" id="slct_image" class="form-control txt_input" accept="image/png, image/jpeg, image/jpg" capture>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</body>
<script src="announcement_script.js"></script>
</html>