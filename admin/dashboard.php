<?php 
    include("navbar.php");
    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");
    
    $active_yearsem = "";
    $total_scholarships = 0;
    $total_applicants = 0;
    $total_approved = 0;
    $total_pending = 0;
    $total_rejected = 0;
    $total_programs = 0;
    $total_fees = 0;
    $total_admins = 0;

    $resultYearSem = $conn->query("select * from tb_yearsem");

    while($row=$resultYearSem->fetch_assoc()){
        $start_date = openssl_decrypt($row["start_date"], $method, $key);
        $end_date = openssl_decrypt($row["end_date"], $method, $key);
     
        if($dateNow >= $start_date && $dateNow <= $end_date){
            $active_yearsem = openssl_decrypt($row["academic_year"], $method, $key) ." ".openssl_decrypt($row["semester"], $method, $key);
        }
           
    }

    $resultScholarship = $conn->query("select * from tb_scholarships");
    $total_scholarships = mysqli_num_rows($resultScholarship);

    $resultApplicants = $conn->query("select * from tb_application");
    $total_applicants = mysqli_num_rows($resultApplicants);

    $resultApprove = $conn->query("select * from tb_approve");
    $total_approved = mysqli_num_rows($resultApprove);

    $rejected = openssl_encrypt("Rejected", $method, $key);
    $resultRejected = $conn->query("select * from tb_application where stats = '$rejected'");
    $total_rejected = mysqli_num_rows($resultRejected);

    $pending = openssl_encrypt("Pending", $method, $key);
    $resultPending = $conn->query("select * from tb_application where stats = '$pending'");
    $total_pending = mysqli_num_rows($resultPending);

    $resultProgram = $conn->query("select * from tb_program");
    $total_programs = mysqli_num_rows($resultProgram);

    $resultFees = $conn->query("select * from tb_fees");
    $total_fees = mysqli_num_rows($resultFees);

    $resultAdmins = $conn->query("select * from tb_admin");
    $total_admins = mysqli_num_rows($resultAdmins);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="/scholarship_system/style.css">
    <style>
        @media (max-width: 1200px){
            .col-md-4{
                margin-bottom: 10px;
            }

            .col-md-6{
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-6">
                <a href="./manage_yearsem/yearsem.php"><div class="dashboard_content">
                    <b>ACTIVE YEAR</b>
                     <h3 class="dashboard_title"><b><?php echo $active_yearsem; ?></b></h3>

                  
                </div></a><br>
                <div class="row">
                    <div class="col-md-6">  
                        <a href="./manage_program/program.php"><div class="dashboard_content">
                            <center>
                            <b>PROGRAMS</b>

                            <h1 class="dashboard_title"><?php echo $total_programs;?></h1>
                            </center>
                        </div></a>
                    </div>
                    <div class="col-md-6" >
                        <a href="./manage_fees/fees.php"><div class="dashboard_content">
                            <center>
                            <b>SCHOOL FEES</b>
                            

                            <h1 class="dashboard_title"><?php echo $total_fees;?></h1>
                            </center>
                            
                        </div></a>
                    </div>
                </div><br>
                <a href="./manage_scholarship/scholarship.php"><div class="dashboard_content">
                    <table width="100%">
                        <tr>
                            <td><h3 class="dashboard_title">SCHOLARSHIPS</h3></td>
                            <td style="text-align: right"><h3 class="dashboard_counts"><?php echo $total_scholarships;?></h3></td>
                        </tr>
                    </table>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                        <?php 
                        
                        while($row = $resultScholarship->fetch_assoc()){
                            $start_date = openssl_decrypt($row["start_date"], $method, $key);
                            $end_date = openssl_decrypt($row["end_date"], $method, $key);
                            $scholarship_name = openssl_decrypt($row["name"], $method, $key);
                            
                            echo "<tr>
                                <td>$scholarship_name</td>
                                <td>";
                                if($dateNow < $start_date){
                                    echo  "Not Yet Started";
                                }else if($dateNow > $end_date){
                                    echo "Finished";
                                }else{
                                    echo "Ongoing";
    
                                }
                            
                            echo "</td></tr>";
                            
                        }
                        
                        ?>
                    </table>
                    
                </div></a><br>
                <a href="./manage_applications/applications.php"><div class="dashboard_content">
                    <table width="100%">
                        <tr>
                            <td><h3 class="dashboard_title">APPLICANTS</h3></td>
                            <td style="text-align: right"><h3 class="dashboard_counts"><?php echo $total_applicants;?></h3></td>
                        </tr>
                    </table>
                </div></a>
                <br>
                <div class="row">
                    <div class="col-md-4">  
                        <div class="dashboard_content">
                            <center>
                            <b>APPROVED</b>

                            <h1 class="dashboard_title"><?php echo $total_approved;?></h1>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="dashboard_content">
                            <center>
                            <b>REJECTED</b>
                            

                            <h1 class="dashboard_title"><?php echo $total_rejected;?></h1>
                            </center>
                            
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="dashboard_content">
                            <center>
                            <b>PENDING</b>

                            

                            <h1 class="dashboard_title"><?php echo $total_pending;?></h1>
                            </center>
                            
                        </div>
                    </div>
                </div>
                <br>
                <a href="./payroll_billing/payroll_billing.php"><div class="dashboard_content">
                    <h3 class="dashboard_title">APPROVED APPLICANTS</h3>
                    <hr>
                    <center>
                    <img src="approved_chart.php" class="pie_chart" alt="Pie Chart">

                    </center>
                    <br>
                    <div class="legend">
                        <h4>Legend:</h4>
                        <?php
                        $accepted = openssl_encrypt("Accepted", $method, $key);

                        $sql = "select tb_scholarships.name as scholarship_name, COUNT(*) as count
                            FROM tb_application
                            JOIN tb_yearsem ON tb_application.yearsem_id = tb_yearsem.id
                            JOIN tb_studentinfo ON tb_application.student_id = tb_studentinfo.student_id
                            JOIN tb_scholarships ON tb_application.scholarship_id = tb_scholarships.id
                            WHERE tb_application.stats = '$accepted'
                            GROUP BY tb_scholarships.id";
                        $result = $conn->query($sql);
                        
                        // Initialize an empty array to store data
                        $scholarship_data = [];

                        $image_width = 600;
                        $image_height = 600;

                        // Create GD image resource
                        $image = imagecreatetruecolor($image_width, $image_height);

                        // Check if image creation succeeded
                        if (!$image) {
                            die('Unable to create GD image resource');
                        }

                        // Allocate colors
                        $bg_color = imagecolorallocate($image, 255, 255, 255); // white background
                        $text_color = imagecolorallocate($image, 0, 0, 0); // black text
                        $red_color = imagecolorallocate($image, 225, 55, 69); // example red color

                        // Example usage: Fill background
                        imagefilledrectangle($image, 0, 0, $image_width, $image_height, $bg_color);
                        // Fetch data and populate array
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $scholarship_name = openssl_decrypt($row['scholarship_name'], $method, $key);
                                    if ($scholarship_name === false) {
                                        echo "Decryption failed for: " . $row['scholarship_name'] . "<br>";
                                        exit;
                                    }
                                    $scholarship_data[$scholarship_name] = $row['count'];
                                }
                            } else {
                                echo "No data found";
                                exit;
                            }

                            // Check if scholarship data is populated
                            if (empty($scholarship_data)) {
                                echo "No valid scholarship data found";
                                exit;
                            }


                            // Define colors for slices
                            $colors = [
                                imagecolorallocate($image, 225, 55, 69),  // #E13745
                                imagecolorallocate($image, 101, 23, 30),  // #65171e
                                imagecolorallocate($image, 255, 0, 0)     // red
                            ];

                            function image_rgb($color) {
                                return sprintf('#%02x%02x%02x', ($color >> 16) & 0xFF, ($color >> 8) & 0xFF, $color & 0xFF);
                            }
                        // Display legend based on $colors array
                        $i = 0;
                        foreach ($scholarship_data as $label => $count) {
                            echo '<div class="legend_item">';
                            echo '<span class="legend_color" style="background-color: ' . htmlspecialchars(image_rgb($colors[$i % count($colors)])) . ';"></span>';
                            echo '<span>' . htmlspecialchars($label) . ' - ' . $count . ' recipient/s</span>';
                            echo '</div>';
                            $i++;
                        }
                        ?>
                    </div>
                    


                </div></a>
            
            </div>
            <div class="col-md-6">
                <a href="./manage_announcement/announcement.php"><div class="dashboard_content">
                    <h3 class="dashboard_title">LATEST ANNOUNCEMENT</h3>
                    <hr>
                 
                        <?php
                            $resultAnnouncement = $conn->query("select * from tb_announcement order by id DESC LIMIT 1");
                            while($row = $resultAnnouncement->fetch_assoc()){
                                $title = openssl_decrypt($row["title"], $method, $key);
                                $content = openssl_decrypt($row["body"], $method, $key);
                                $created_at = openssl_decrypt($row["created_at"], $method, $key);
                                $created_at_create = date_create($created_at);
                                $format_created_at = date_format($created_at_create,"F j, Y");

                                echo "
                                <h4><b>$title</b></h4>
                                <h5><b>$format_created_at</b></h5>
                                
                                <br><p>$content</p>";
                            }

                        ?>
                   
                </div></a>
                <br>
                
                <a href="./manage_admin/admin.php"><div class="dashboard_content">
                    <table width="100%">
                        <tr>
                            <td><h3 class="dashboard_title">ADMINS</h3></td>
                            <td style="text-align: right"><h3 class="dashboard_counts"><?php echo $total_admins;?></h3></td>
                        </tr>
                    </table>
                </div></a>
                <br>

                <div class="dashboard_content">
                    <h3 class="dashboard_title">ADMIN LOG</h3>
                    <hr>
                    <?php 
                    $query = "select tb_admin.name as admin_name, tb_adminlog.actn, tb_adminlog.date_time from tb_admin, tb_adminlog where tb_adminlog.admin_id = tb_admin.id order by tb_adminlog.id DESC LIMIT 5";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                
                    echo "<table class='table table-bordered table_records'> 
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Activity</th>
                                    </tr>";
                
                    while($row = mysqli_fetch_assoc($result)){
                        $name = openssl_decrypt($row["admin_name"], $method, $key);
                        $action = openssl_decrypt($row["actn"], $method, $key);
                        $date_time = openssl_decrypt($row["date_time"], $method, $key);
                
                        $date_create = date_create($date_time);
                        $format_date = date_format($date_create,"F j, Y");
                        $format_time = date_format($date_create,"h:i:s A");
                
                        echo "<tr>
                                <td>$format_date</td>
                                <td>$format_time</td>
                                <td>$name has $action.</td>
                        </tr>";
                
                    }
                
                    echo "</table>";
                    
                    ?>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>