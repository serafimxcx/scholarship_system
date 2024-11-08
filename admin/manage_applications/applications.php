<?php 
    include("../navbar.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">Applications</h5><br>
        <div class="admin_container">
            <table style="float: right;">
                <tr>
                    <td style=" text-align: right; padding-right: 20px;">Num. of Rows: </td>
                    <td>
                        <select id="slct_rows" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                        </select>
                    </td>
                </tr>
            </table><br><br>
            <div class="row">
                <div class="col-md-2" style="transform: translateY(25%);">
                <label>Student Name:</label>

                </div>
                <div class="col-md-10">
                    <input type="text" id="txt_name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>A.Y & Semester:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_yearsem" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Program:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_program" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Year Level:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_yearlevel" class="form-control">
                                <option value="">Select...</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                                <option value="5th Year">5th Year</option>
                                <option value="6th Year">6th Year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Scholarship:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_scholarship" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Status:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_status" class="form-control">
                                <option value="">Select...</option>
                                <option value="Pending">Pending</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Applicant:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_apptype" class="form-control">
                                <option value="">Select...</option>
                                <option value="New">New</option>
                                <option value="Continuing">Continuing</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="records_output">

            </div>

        </div>

    </div>

    <?php
        include_once("modal_viewinfo.php");
    ?>
</body>
<script src="applications_script.js"></script>
</html>