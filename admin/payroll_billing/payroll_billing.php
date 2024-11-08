<?php 
    include("../navbar.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll & Billing</title>
</head>
<body>
    <div class="content_container">
        <h5 class="content_title">Payroll and Billing</h5><br>
        <div class="admin_container">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Scholarship:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_scholarship" class="form-control">
                                <option value="">Select...</option>
                                <option value="0">Free Higher Education</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>File:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_file" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 fees_container" style="display:none;">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Fees:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_fee" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row other_filter_div" style="display:none;">
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
            <div class="row other_filter_div" style="display:none;">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Starting A.Y & Semester:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_yearsem1" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-4" style="transform: translateY(25%);">
                            <label>Ending A.Y & Semester:</label>
                        </div>
                        <div class="col-lg-8">
                            <select id="slct_yearsem2" class="form-control">
                                <option value="">Select...</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <br>
            <div class="row other_filter_div" style="display:none;">
                <div class="col-md-12" style="text-align: right;">
                    <button type="button" class="btn btn-danger" id="btn_excel">Export to Excel</button>
                    <button type="button" class="btn btn-danger" id="btn_print">Print PDF</button>
                </div>
            </div>
            <br>
            <div class="records_container other_filter_div">
                
            </div>
        </div>
    </div>
</body>
<script src="script_payroll.js"></script>
</html>