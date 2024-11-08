<?php 
    include("../navbar.php");

    if($haveInfo == false){
        echo "<script>alert('Please fill up your personal information first.');
                    window.location.href='/scholarship_system/user/profile/profile.php'</script>";
    }else{
        date_default_timezone_set('Asia/Manila');
        $dateNow = date("Y-m-d");

        $scholarship_id="";
        $scholarship_name="";

    }

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Scholarship</title>
</head>
<body>
    <div class="header user_header">
    <table width="100%">
        <tr>
            <td><span class="navbar-btn user_navbar" onclick="openNav()">&#9776;</span></td>
            <td style='text-align:right; color: #65171e;'><h2><b>APPLY NOW</b></h2><h4>Scholarship Application</h4></td>
        </tr>
    </table>
    </div>

    <div style='<?php 
        if(!isset($_GET["scholarship_id"]) && !isset($_GET["apply"])){
            echo "display: block";
        }else{
            echo "display: none";
        }
    
    ?>'>
    <?php 
        $result = $conn->query("select * from tb_scholarships");
        $accepted = false;

        while($row=$result->fetch_assoc()){
            $start_date = openssl_decrypt($row["start_date"], $method, $key);
            $end_date = openssl_decrypt($row["end_date"], $method, $key);

            $startdate_create = date_create($start_date);
            $format_startdate = date_format($startdate_create,"F j, Y");

            $enddate_create = date_create($end_date);
            $format_enddate = date_format($enddate_create,"F j, Y");


            echo "<div class='content_container user_content_container'>
                <div class='admin_container profile_container'>
                    <h3><b>".openssl_decrypt($row["name"], $method, $key)."</b></h3><br>
                    <p>".openssl_decrypt($row["description"], $method, $key)."<br><br>
                    
                    Start of Application: &nbsp; ".$format_startdate." <br>
                    End of Application: &nbsp; ".$format_enddate." <br>
                    </p><br>
                    ";

                    $checkApplication = $conn->query("select tb_application.id as application_id, tb_application.application_date, tb_application.application_num, tb_application.applicant_type, tb_application.stats, tb_application.files, tb_yearsem.academic_year, tb_yearsem.semester from tb_application, tb_yearsem where student_id='$student_id' and scholarship_id='$row[id]' and tb_application.yearsem_id = tb_yearsem.id LIMIT 1");

                    $submitapplication = false;
                    while($rowApp = $checkApplication->fetch_assoc()){
                        $apply_date = openssl_decrypt($rowApp["application_date"], $method, $key);

                        $applydate_create = date_create($apply_date);
                        $format_applydate = date_format($applydate_create,"F j, Y");

                        if($apply_date >= $start_date && $apply_date <= $end_date){
                            $submitapplication = true;
                            $application_id = $rowApp["application_id"];
                            $application_num = openssl_decrypt($rowApp["application_num"], $method, $key);
                            $academic_year = openssl_decrypt($rowApp["academic_year"], $method, $key);
                            $semester = openssl_decrypt($rowApp["semester"], $method, $key);
                            $applicant_type = openssl_decrypt($rowApp["applicant_type"], $method, $key);
                            $status = openssl_decrypt($rowApp["stats"], $method, $key);
                            $files = openssl_decrypt($rowApp["files"], $method, $key);
                            $filesArr = explode(",",$files);
                            if($status == "Accepted"){
                                $accepted = true;
                            }

                        }
                    }

                    
                    
                    if($submitapplication == false){
                        if($accepted){
                            echo  "<button type='button' class='btn btn-danger' disabled> No Further Applications</button>";
                            echo "<br><br><p><i>A scholarship has already been granted to you.</i></p> ";
                            
                        }else if($dateNow < $start_date){
                            echo  "<button type='button' class='btn btn-danger' disabled>Not Yet Started</button>";
                        }else if($dateNow > $end_date){
                            echo "<button type='button' class='btn btn-danger' disabled>Application has ended.</button>";
                        }else{
                            echo "<button type='button' class='btn btn-danger btn_apply' scholarship_id='$row[id]'>Apply Here</button>";
                            echo "<br><br><p><i>You haven't submitted any application for this scholarship.</i></p> ";

                        }


                    }else{
                        if($status == "Accepted"){
                            echo  "<button type='button' class='btn btn-danger' disabled>Application Accepted</button>";

                        }else if($status == "Rejected"){
                            echo  "<button type='button' class='btn btn-danger' disabled>Application Rejected</button>";

                        }else if($dateNow < $start_date){
                            echo  "<button type='button' class='btn btn-danger' disabled>Not Yet Started</button>";
                        }else if($dateNow > $end_date){
                            echo "<button type='button' class='btn btn-danger' disabled>Application has ended.</button>";
                        }else{
                            echo "<button type='button' class='btn btn-danger btn_viewapplication' scholarship_id='$row[id]' application_id='$application_id'>View Application</button>";
                        }

                        echo "<br><br>
                        <table width='100%' class='table table-bordered'>
                            <tr>
                                <th>Application #</th>
                                <th>Date</th>
                                <th>Academic Year and Semester</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>$application_num</td>
                                <td>$format_applydate</td>
                                <td>$academic_year $semester</td>
                                <td>$applicant_type</td>
                                <td>$status</td>

                            </tr>
                        </table>";
                        
                    }

                    
                    
            echo "</div>
            </div><br>
        
            ";

           

        }
    ?>
    </div>

    <!--div for applying scholarship-->
    <?php 
        include_once("apply_scholarship.php");
    
    ?>
</body>
    <script src="apply_script.js"></script>
</html>