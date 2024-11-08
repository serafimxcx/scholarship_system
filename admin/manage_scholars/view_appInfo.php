

<div class="row">
    <div class="col-md-4">
        <label>Academic Year & Semester</label>
        <select name="slct_yearsem" id="slct_yearsem" class="form-control" disabled>
            <?php 
                $result= $conn->query("select * from tb_yearsem");

                
                while($row=$result->fetch_assoc()){
                    echo "<option value='$row[id]'";
                    
                        if($row["id"] == $yearsem_id){
                            echo  "selected";
                        }else{
                            echo "disabled";
                        }
                        
                    echo ">".openssl_decrypt($row["academic_year"], $method, $key) ." - ".openssl_decrypt($row["semester"], $method, $key) ."</option>";
                }

                
                
            
            ?>
        </select>
    </div>
    <div class="col-md-4">
        <label>Applicant Type: </label>
        <select name="slct_type" id="slct_type" class="form-control" disabled>
            <option value="">Select...</option>
            <option value="New" <?php if($applicant_type == "New"){ echo "selected";} ?>>New</option>
            <option value="Continuing" <?php if($applicant_type == "Continuing"){ echo "selected";} ?>>Continuing</option>
        </select>
    </div>
    <div class="col-md-4">
        <label>Application Date: </label>
        <input type="date" name="txt_date" id="txt_date" class="form-control" value='<?php 
            echo $application_date;
        ?>' disabled>
    </div>
    
</div>
<br><br>

<div class="row">
    <div class="col-md-8">
        <label>Submitted Files:</label> <br>

        <?php

            if(!empty($filesArr)){
                echo "<p id='file_container'>";
                foreach($filesArr as $fileNames){
                    echo "<ul class='file_output'>
                        <li><a href='/scholarship_system/user/apply/applicationfiles/$fileNames' target='_blank'>$fileNames</a></li>
                    </ul>";
                }
                echo "</p>";
            }else{
                echo "<br>This applicant haven't submitted any files.";
            }
        
        ?>
        
        
    </div>
</div>
<br><hr><br>
<div class="row">
    <div class="col-md-6">
    <p>Are you enjoying other financial assistance?</p>
        <select name="slct_isScholar" id="slct_isScholar" class="form-control"disabled>
            <option value="">Select...</option>
            <option value="Yes" <?php if($isScholar == "Yes"){ echo "selected";} ?>>Yes</option>
            <option value="No" <?php if($isScholar == "No"){ echo "selected";} ?>>No</option>
        </select>
    </div>
    <div class="col-md-6">
        <p>If yes, please specify...</p>
        <textarea name="txt_otherScholarships" id="txt_otherScholarships" class="form-control" disabled><?php echo $otherScholarships; ?></textarea>
    </div>
</div><br>