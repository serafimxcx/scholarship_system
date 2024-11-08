<style>
    .btn{
        margin-bottom: 5px;
    }
</style>
<div class="content_container user_content_container" style='<?php
    if((isset($_GET["scholarship_id"]) && isset($_GET["apply"]))){

        echo "display: block";

        $scholarship_id=$_GET["scholarship_id"];

        $result = $conn->query("select * from tb_scholarships where id='$scholarship_id'");

        while($row=$result->fetch_assoc()){
            $scholarship_name = openssl_decrypt($row["name"], $method, $key);

        }

        $submitapplication = false;

        $apply_date ="";
        $application_id = "";
        $application_num = "";
        $academic_year = "";
        $semester = "";
        $applicant_type = "";
        $status = "";
        $files = "";
        $isScholar = "";
        $otherScholarships = "";
        $filesArr = "";


        $checkApplication = $conn->query("select tb_application.id as application_id, tb_application.application_date, tb_application.application_num, tb_application.applicant_type, tb_application.stats, tb_application.files, tb_application.isScholar, tb_application.otherScholarships, tb_application.yearsem_id, tb_yearsem.academic_year, tb_yearsem.semester from tb_application, tb_yearsem where tb_application.student_id='$student_id' and tb_application.scholarship_id='$scholarship_id' and tb_application.yearsem_id = tb_yearsem.id LIMIT 1");

        while($rowApp = $checkApplication->fetch_assoc()){
            $apply_date = openssl_decrypt($rowApp["application_date"], $method, $key);

            $applydate_create = date_create($apply_date);
            $format_applydate = date_format($applydate_create,"F j, Y");

            if($apply_date >= $start_date && $apply_date <= $end_date){
                $submitapplication = true;
                $application_id = $rowApp["application_id"];
                $application_num = openssl_decrypt($rowApp["application_num"], $method, $key);
                $yearsem_id = $rowApp["yearsem_id"];
                $applicant_type = openssl_decrypt($rowApp["applicant_type"], $method, $key);
                $status = openssl_decrypt($rowApp["stats"], $method, $key);
                $files = openssl_decrypt($rowApp["files"], $method, $key);
                $isScholar = openssl_decrypt($rowApp["isScholar"], $method, $key);
                $otherScholarships = openssl_decrypt($rowApp["otherScholarships"], $method, $key);
                $filesArr = explode(",",$files);


            }
        }
        
        

    }else{
        echo "display: none";
    }

?>'>
    <div class="admin_container profile_container">
        <form enctype="multipart/form-data" id="application_form">
        <table width="100%">
            <tr>
                <td>
                    <h3>
                    <button type='button' class='btn btn-default' id='btn_back'>Back</button>

                        <?php
                            if($submitapplication){
                                echo "
                                <button type='button' class='btn btn-danger' id='btn_cancel' style='display: none;'>Cancel</button>
                                <button type='button' class='btn btn-danger' id='btn_update' style='display: none;'>Save Changes</button>
                                <button type='button' class='btn btn-danger' id='btn_updateform' style='display: inline-block;'>Update Form</button>
                                ";
                            }else{
                                echo "<button type='button' class='btn btn-danger' id='btn_save'>Save</button>";
                            }
                        
                        ?>
                    </h3>

                </td>
                <td style="text-align:right;">
                    <input type="hidden" name="scholarship_id" id="scholarship_id" value='<?php echo $scholarship_id; ?>'>
                    <input type="hidden" name="application_id" id="application_id" value='<?php if($submitapplication){ echo $application_id; }else{ echo "N/A"; } ?>'>
                    <h3><b><?php echo $scholarship_name; ?></b></h3>
                </td>
            </tr>
        </table>
        <hr><br>
        <div class="row">
            <div class="col-md-4">
                <label>Academic Year & Semester</label>
                <select name="slct_yearsem" id="slct_yearsem" class="form-control" <?php if($submitapplication){ echo "disabled"; }?>>
                    <?php 
                        $result= $conn->query("select * from tb_yearsem");

                        if($submitapplication){
                            while($row=$result->fetch_assoc()){
                                echo "<option value='$row[id]'";
                                
                                    if($row["id"] == $yearsem_id){
                                        echo  "selected";
                                    }else{
                                        echo "disabled";
                                    }
                                   
                                echo ">".openssl_decrypt($row["academic_year"], $method, $key) ." - ".openssl_decrypt($row["semester"], $method, $key) ."</option>";
                            }

                        }else{
                            while($row=$result->fetch_assoc()){
                                $start_date = openssl_decrypt($row["start_date"], $method, $key);
                                $end_date = openssl_decrypt($row["end_date"], $method, $key);
                                echo "<option value='$row[id]'";
                                
                                    if($dateNow < $start_date){
                                        echo  "disabled";
                                    }else if($dateNow > $end_date){
                                        echo "disabled";
                                    }else{
                                        echo "selected";
                                    }
                                   
                                echo ">".openssl_decrypt($row["academic_year"], $method, $key) ." - ".openssl_decrypt($row["semester"], $method, $key) ."</option>";
                            }
                        }
                        
                    
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label>Applicant Type: </label>
                <select name="slct_type" id="slct_type" class="form-control" <?php if($submitapplication){ echo "disabled"; }?>>
                    <option value="">Select...</option>
                    <option value="New" <?php if($applicant_type == "New"){ echo "selected";} ?>>New</option>
                    <option value="Continuing" <?php if($applicant_type == "Continuing"){ echo "selected";} ?>>Continuing</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Application Date: </label>
                <input type="date" name="txt_date" id="txt_date" class="form-control" value='<?php 
                    echo $dateNow;
                ?>' disabled>
            </div>
            
        </div>
        <br><br>
        <p>Attach the following documents: </p>
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <li>Certificate of Registration/Enrollment (CORs/COEs)</li>
                    <li>Certificate of Indigency</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>Certified True Copy of Latest Grade</li>
                    <li>Student ID</li>
                </ul>
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-4">
                <label>Attach Files: </label>
                <input type="hidden" name="txt_files" id="txt_files" value='<?php if($submitapplication){ echo $files; }else{ echo "N/A"; } ?>'>
                <input type="file" name="inputFiles[]" id="inputFiles" class="form-control" accept=".pdf, .png, .jpg, .jpeg, application/pdf, image/png, image/jpeg" multiple <?php if($submitapplication){ echo "disabled"; }?>><br>
                <?php 

                    if($submitapplication){
                        echo "
                        <button type='button' class='btn btn-default' id='btn_clearfiles' disabled>Clear Files</button><br><br>";
                    }
                
                ?>
            </div>
            <div class="col-md-8">
                <label>Submitted Files:</label> <br>

                <?php

                    if($submitapplication){
                        echo "<p id='file_container'>";
                        foreach($filesArr as $fileNames){
                            echo "<ul class='file_output'>
                                <li><a href='./applicationfiles/$fileNames' target='_blank'>$fileNames</a></li>
                            </ul>";
                        }
                        echo "</p>";
                    }else{
                        echo "<br>You haven't submitted any files.";
                    }
                
                ?>
                
                
            </div>
        </div>
        <br><hr><br>
        <div class="row">
            <div class="col-md-6">
            <p>Are you enjoying other financial assistance?</p>
                <select name="slct_isScholar" id="slct_isScholar" class="form-control" <?php if($submitapplication){ echo "disabled"; }?>>
                    <option value="">Select...</option>
                    <option value="Yes" <?php if($isScholar == "Yes"){ echo "selected";} ?>>Yes</option>
                    <option value="No" <?php if($isScholar == "No"){ echo "selected";} ?>>No</option>
                </select>
            </div>
            <div class="col-md-6">
                <p>If yes, please specify...</p>
                <textarea name="txt_otherScholarships" id="txt_otherScholarships" class="form-control" <?php if($submitapplication){ echo "disabled"; }?>><?php echo $otherScholarships; ?></textarea>
            </div>
        </div><br>
        


        </form>
    </div>

</div>