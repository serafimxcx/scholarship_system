<div class="modal" style='<?php

    include_once("view_info.php")
?>'>
    <div id="viewinfo_div">
        <input type="hidden" name="application_id" id="application_id" value='<?php echo $application_id;?>'>
        <table width="100%">
            <tr>
                <td><h4><span class="btn_closemodal"><i class="bi bi-x-lg"></i></span></h4></td>
                <td></td>
                
            </tr>
        </table><br>
        <div class="content_container ">
            <table width="100%" >
                <tr>
                    <td>
                        <h3 class="content_title"><b>Application for <?php echo $scholarship_name; ?></b></h3>
                        <h4 class="content_title">Application #: <?php echo $application_num; ?></h4>
                        <input type="hidden" id="txt_scholarshipname" value='<?php echo $scholarship_name; ?>'>
                        <input type="hidden" id="txt_yearsem" value='<?php echo $academic_year ." ".$semester ; ?>'>
                        <input type="hidden" id="txt_studentname" value='<?php echo $first_name ." ".$last_name ; ?>'>
                    </td>
                </tr>
            </table>
            <br>
            <div class="admin_container profile_container">
                <?php 

                    include_once("view_appInfo.php");
                    echo "<br><hr><br>";
                    include_once("view_profile.php");
                    

                ?>

                <br><hr><br>
                <div class="row">
                    <div class="col-md-1" style="transform: translateY(30%);">
                        Status:
                    </div>
                    <div class="col-md-8">
                        <select id='slct_appstatus' class='form-control' application_id='<?php echo $application_id ?>'>

                            <?php
                                echo "<option value=''";
                                    if($status != ""){
                                        echo "selected disabled";
                                    }
                                echo ">Update status...</option>

                                <option value='Ongoing'"; 
                                echo "<option value='Ongoing'";
                                    if($status == "Ongoing"){
                                        echo "selected disabled";
                                    }
                                echo ">Ongoing</option>

                                <option value='Graduated'";
                                    if($status == "Graduated"){
                                        echo "selected disabled";
                                    }
                                echo ">Graduated</option>
                                <option value='Disqualified'";
                                    if($status == "Disqualified"){
                                        echo "selected disabled";
                                    }
                                echo ">Disqualified</option>
                                
                                
                                ";
                            
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3" style='text-align: right;'>
                        <!-- <table>
                            <tr>
                                <td><button type="button" class="btn btn-default" id="btn_print" application_id='<?php //echo $application_id?>'>Print</button>&nbsp;</td>
                                <td><button type="button" class="btn btn-default" id="btn_editapprove" style='<?php //if($isAccepted){ echo "display:inline-block";}else{ echo "display:none";}?>'>Edit</button></td>
                            </tr>
                        </table> -->
                        
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <i style="color: red;">
                            <?php
                            
                            if($status == "Disqualified"){
                                echo "Reason: $reason";
                            }

                            ?>
                        </i>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="modal2" id="accept_applicant_modal">
    <div id="accept_applicant_div">
        <table width="100%">
            <tr>
                <td><h3><b>Disqualify Applicant</b></h3></td>
                <td style="text-align: right;"><h4><span class="btn_closemodal2"><i class="bi bi-x-lg"></i></span></h4></td>
                
            </tr>
        </table><hr>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Application #: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" value='<?php echo $application_num;?>' disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Student #: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" value='<?php echo $student_no;?>' disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Student Name: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" value='<?php echo $last_name.", ".$first_name." ".$middle_name;?>' disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Program Name: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" value='<?php echo $program_name; ?>' disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Year Level: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" value='<?php echo $yearlevel; ?>' disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Award Number: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="txt_awardnumber" value='<?php echo $award_number; ?>' disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Allowance: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="txt_newallowance" value='<?php if($isAccepted){echo $allowance;}else{echo $default_allowance;}?>' disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Reason: </label>
            </div>
            <div class="col-lg-6">
                <textarea class="form-control" id="txt_reason"></textarea>
            </div>
        </div>
        <br><br>
        <center>
        <button type='button' class='btn btn-danger' id='btn_accept'>Save</button>
        </center>


        
    </div>
</div>