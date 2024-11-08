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
                                echo "<option value='Pending'";
                                    if($status == "Pending"){
                                        echo "selected disabled";
                                    }
                                echo ">Pending</option>

                                <option value='Accepted'";
                                    if($status == "Accepted"){
                                        echo "selected disabled";
                                    }
                                echo ">Accepted</option>
                                <option value='Rejected'";
                                    if($status == "Rejected"){
                                        echo "selected disabled";
                                    }
                                echo ">Rejected</option>
                                
                                
                                ";
                            
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3" style='text-align: right;'>
                        <table>
                            <tr>
                                <td><button type="button" class="btn btn-default" id="btn_print" application_id='<?php echo $application_id?>'>Print</button>&nbsp;</td>
                                <td><button type="button" class="btn btn-default" id="btn_editapprove" style='<?php if($isAccepted){ echo "display:inline-block";}else{ echo "display:none";}?>'>Edit</button></td>
                            </tr>
                        </table>
                        
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
                <td><h3><b>Accept Applicant</b></h3></td>
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
                <input type="text" class="form-control" id="txt_awardnumber" value='<?php echo $award_number; ?>'>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6" style="transform: translateY(25%);">
                <label>Allowance: </label>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="txt_newallowance" value='<?php if($isAccepted){echo $allowance;}else{echo $default_allowance;}?>'>
            </div>
        </div>
        <br><br>
        <center>
            <?php
                if($isAccepted){
                    echo "
                    <button type='button' class='btn btn-danger' id='btn_update_accept' approve_id=".$approve_id.">Update Applicant</button>

                    ";
                }else{
                    echo "
                    <button type='button' class='btn btn-danger' id='btn_accept'>Accept Applicant</button>

                    ";
                }
            ?>
        </center>


        
    </div>
</div>