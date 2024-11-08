<?php 
    include("../navbar.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <style>
        div{
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .header, .user_content_container, .user_sidenav{
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="header user_header">
    <table width="100%">
        <tr>
            <td><span class="navbar-btn user_navbar" onclick="openNav()">&#9776;</span></td>
            <td style='text-align:right; color: #65171e;'><h2><b>PROFILE</b></h2><h4>Kolehiyo ng Lungsod ng Lipa</h4></td>
        </tr>
    </table>
    </div>

    <div class="content_container user_content_container">
        <?php 
            if($haveInfo == false){
                echo "<h4>Complete the form to apply for scholarship.</h4>";
            } 
        ?>
        <div class="admin_container profile_container">
           <form enctype="multipart/form-data" id="add_profile_form">
           <div class="row">
                <div class="col-lg-3 profile-container">
                    <input type="file" name="slct_profileimg" id="slct_profileimg" style="display: none;" accept="image/png, image/jpeg, image/jpg" capture disabled>
                    <center>
                    <button type="button" id="btn_slctimg" disabled>
                    <img src='
                    <?php 
                        if($profile_pic == ""){
                            echo "./profilepic/default.png";
                        }else{
                            echo "./profilepic/".$profile_pic;
                        }
                    
                    ?>
                    ' class='profile_img'>
                    </button>
                    </center>
                    
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-sm-6">
                           <h3><b>Personal Information</b></h3>
                        </div>
                        <div class="col-sm-6 user_side_btn_col">
                        <h3>
                                <?php 
                                    if($haveInfo == false){
                                        echo "<button type='button' id='btn_addinfo' class='btn btn-danger' style='display: inline-block;'><i class='bi bi-plus-lg'></i> &nbsp; Add Personal Info</button>";
                                    }else{
                                        echo "<button type='button' id='btn_updateinfo' class='btn btn-danger' style='display: inline-block;'><i class='bi bi-plus-lg'></i> &nbsp; Update Personal Info</button>";
                                    }

                                    


                                ?>
                                <button type="button" class="btn btn-default" id="btn_cancel" style="display: none">Cancel</button>
                                <button type="button" class="btn btn-danger" id="btn_save" style="display: none">Save</button>
                                <button type="button" class="btn btn-danger" id="btn_update" style="display: none">Update</button>

                            </h3>
                        </div>
                    </div>
                    <br>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Student Number:</label>
                            <input type="text" name="txt_studentno" id="txt_studentno" class="form-control" value='<?php echo $student_no;?>' disabled>
                        </div>
                        <div class="col-md-6">
                            <label>LRN:</label>
                            <input type="text" name="txt_lrn" id="txt_lrn" class="form-control" value='<?php echo $lrn;?>' disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Program:</label>
                            <select name="slct_program" id="slct_program" class="form-control" disabled>
                                <option value="">Select Program...</option>
                                <?php 
                                    $result = $conn->query("select * from tb_program");
                                    while($row=$result->fetch_assoc()){
                                        echo "<option value='$row[id]' ";
                                        if($row["id"] == $program_id){
                                            echo "selected";
                                        }
                                        echo ">".openssl_decrypt($row["name"], $method, $key)."</option>";
                                    }
                                
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Year Level:</label>
                            <select name="slct_yearlevel" id="slct_yearlevel" class="form-control" disabled>
                                <option value="">Select Year Level...</option>
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label>Total Units:</label>
                            <input type="number" name="txt_units" id="txt_units" class="form-control" value='<?php echo $total_units;?>' disabled>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Last Name:</label>
                    <input type="text" name="txt_lastname" id="txt_lastname" value='<?php echo $last_name;?>' class="form-control" disabled>
                </div>
                <div class="col-md-4">
                    <label>First Name:</label>
                    <input type="text" name="txt_firstname" id="txt_firstname" value='<?php echo $first_name;?>' class="form-control" disabled>
                </div>
                <div class="col-md-4">
                    <label>Middle Name:</label>
                    <input type="text" name="txt_middlename" id="txt_middlename" class="form-control" value='<?php echo $middle_name;?>' placeholder='Type _ if none' disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <label>Email:</label>
                    <input type="text" name="txt_email" id="txt_email" class="form-control" value='<?php echo $email; ?>' disabled>
                </div>
                <div class="col-lg-3">
                    <label>Contact Number:</label>
                    <input type="text" name="txt_contact" id="txt_contact" class="form-control" value='<?php echo $contact; ?>' disabled>
                </div>
                <div class="col-lg-3">
                    <label>Address:</label>
                    <input type="text" name="txt_address" id="txt_address" class="form-control" placeholder="Street Barangay, Town or City or Municipality, Province" value='<?php echo $address;?>' disabled>
                </div>
                <div class="col-lg-3">
                    <label>Postal Code:</label>
                    <input type="text" name="txt_postal" id="txt_postal" value='<?php echo $postal_code;?>' class="form-control" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <label>Birthdate:</label>
                    <input type="date" name="txt_birthdate" id="txt_birthdate" class="form-control" value='<?php echo $birthdate;?>' disabled>
                </div>
                <div class="col-lg-4">
                    <label>Place of Birth:</label>
                    <input type="text" name="txt_birthplace" id="txt_birthplace" class="form-control" value='<?php echo $birthplace ;?>' disabled>
                </div>
                <div class="col-lg-4">
                    <label>Sex:</label>
                    <select name="slct_sex" id="slct_sex" class="form-control" disabled>
                        <option value="">Select Sex...</option>
                        <option value="M" <?php if($sex == "M"){ echo "selected"; } ?>>Male</option>
                        <option value="F" <?php if($sex == "F"){ echo "selected"; } ?>>Female</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <label>Citizenship:</label>
                    <input type="text" name="txt_citizenship" id="txt_citizenship" class="form-control" value='<?php echo $citizenship ;?>'  disabled>
                </div>
                <div class="col-lg-4">
                    <label>Religion:</label>
                    <input type="text" name="txt_religion" id="txt_religion" class="form-control" value='<?php echo $religion ;?>'  disabled>
                </div>
                <div class="col-lg-4">
                    <label>Civil Status:</label>
                    <select name="slct_civilstatus" id="slct_civilstatus" class="form-control" disabled>
                        <option value="">Select Civil Status...</option>
                        <option value="Single" <?php if($civil_status == "Single"){ echo "selected"; } ?>>Single</option>
                        <option value="Married" <?php if($civil_status == "Married"){ echo "selected"; } ?>>Married</option>
                        <option value="Divorced" <?php if($civil_status == "Divorced"){ echo "selected"; } ?>>Divorced</option>
                        <option value="Widowed" <?php if($civil_status == "Widowed"){ echo "selected"; } ?>>Widowed</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label>Name of School Attended:</label>
                        <input type="text" name="txt_sch_attended" id="txt_sch_attended" class="form-control" value='<?php echo $school_attended ;?>' disabled>
                    </div><br>
                    <div>
                        <label>School ID Number:</label>
                        <input type="text" name="txt_sch_num" id="txt_sch_num" class="form-control" value='<?php echo $school_id_num ;?>' disabled>
                    </div><br>
                    
                </div>
                <div class="col-lg-6">
                     <div>
                        <label>School Address:</label>
                        <input type="text" name="txt_sch_address" id="txt_sch_address" class="form-control" value='<?php echo $school_address ;?>' disabled>
                    </div><br>
                    <div>
                        <label>School Sector:</label>
                        <select name="slct_sch_sector" id="slct_sch_sector" class="form-control"  disabled>
                            <option value="">Select School Sector</option>
                            <option value="Public" <?php if($school_sector == "Public"){ echo "selected"; } ?>>Public</option>
                            <option value="Private" <?php if($school_sector == "Private"){ echo "selected"; } ?>>Private</option>
                        </select>
                    </div><br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label>Type of Disability (if applicable):</label>
                    <input type="text" name="txt_disability" id="txt_disability" class="form-control" value='<?php echo $disability ;?>' placeholder="Type N/A if none" disabled>
                </div>
                <div class="col-lg-6">
                    <label>Tribal Membership (if applicable):</label>
                    <input type="text" name="txt_membership" id="txt_membership" class="form-control" value='<?php echo $tribal_membership ;?>' placeholder="Type N/A if none" disabled>
                </div>
            </div>
            <br><hr><br>
            <h3><b>Family Background</b></h3><br>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <table width="100%">
                            <tr>
                                <td style="transform: translateY(10%); padding-right: 20px;"><label>Father: </label></td>
                                <td>
                                    <select name="slct_f_status" id="slct_f_status" class="form-control" disabled>
                                        <option value="">Select Living or Deceased...</option>
                                        <option value="Living" <?php if($father_status == "Living"){ echo "selected"; } ?>>Living</option>
                                        <option value="Deceased" <?php if($father_status == "Deceased"){ echo "selected"; } ?>>Deceased</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div>
                        <label>Father Name:</label>
                        <input type="text" name="txt_f_name" id="txt_f_name" class="form-control" value='<?php echo $father_name ;?>' disabled>
                    </div>
                    <br>
                    <div>
                        <label>Father Address:</label>
                        <input type="text" name="txt_f_address" id="txt_f_address" value='<?php echo $father_address ;?>' class="form-control" disabled>
                    </div><br>
                    <div>
                        <label>Father Occupation:</label>
                        <input type="text" name="txt_f_occupation" id="txt_f_occupation" value='<?php echo $father_occupation ;?>' class="form-control" disabled>
                        <br><br>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div>
                        <table width="100%">
                            <tr>
                                <td style="transform: translateY(10%); padding-right: 20px;"><label>Mother: </label></td>
                                <td>
                                    <select name="slct_m_status" id="slct_m_status" class="form-control" disabled>
                                        <option value="">Select Living or Deceased...</option>
                                        <option value="Living" <?php if($mother_status == "Living"){ echo "selected"; } ?>>Living</option>
                                        <option value="Deceased" <?php if($mother_status == "Deceased"){ echo "selected"; } ?>>Deceased</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div>
                        <label>Mother Name:</label>
                        <input type="text" name="txt_m_name" id="txt_m_name" class="form-control" value='<?php echo $mother_name ;?>' disabled>
                    </div>
                    <br>
                    <div>
                        <label>Mother Address:</label>
                        <input type="text" name="txt_m_address" id="txt_m_address" class="form-control" value='<?php echo $mother_address ;?>' disabled>
                    </div><br>
                    <div>
                        <label>Mother Occupation:</label>
                        <input type="text" name="txt_m_occupation" id="txt_m_occupation" class="form-control" value='<?php echo $mother_occupation ;?>' disabled>
                    </div>
                    
                </div>
            </div><br>
            <table width="100%">
                <tr>
                    <td style="transform: translateY(10%);">Total Parent Gross Income:</td>
                    <td style=" padding-right: 20px;"><input type="number" name="txt_grossincome" id="txt_grossincome" value='<?php echo $gross_income ;?>' class="form-control" step="any" disabled></td>
                    <td style="transform: translateY(10%);">No. of Siblings:</td>
                    <td><input type="number" name="txt_siblings"id="txt_siblings" class="form-control" value='<?php echo $no_of_siblings ;?>' disabled></td>
                </tr>
            </table>

           </form>
            <br><br>
        </div>
    </div>
</body>
<script src="profile_script.js"></script>
</html>