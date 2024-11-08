<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    $yearsem1 = $_POST["slct_yearsem1"];
    $yearsem2 = $_POST["slct_yearsem2"];
    $program = $_POST["slct_program"];

    $scholarship= $_POST["slct_scholarship"];

    
    if($_POST["slct_yearlevel"] != ""){
        $yearlevel = openssl_encrypt($_POST["slct_yearlevel"], $method, $key);

    }else{
        $yearlevel = "";
    }



    if($_POST["slct_apptype"] != ""){
        $type = openssl_encrypt($_POST["slct_apptype"], $method, $key);

    }else{
        $type = "";
    }



    $conditions = [];
    if (!empty($yearsem1)) {
        $conditions[] = "tb_application.yearsem_id LIKE '%$yearsem1%'";
       

    }

    if (!empty($yearsem2)) {
        $conditions[] = "tb_application.yearsem_id LIKE '%$yearsem2%'";
       

    }

    if (!empty($program)) {
        $conditions[] = "tb_studentinfo.program_id LIKE '%$program%'";
       

    }
    if (!empty($yearlevel)) {
        $conditions[] = "tb_yearlevel.name LIKE '%$yearlevel%'";
       

    }
  

    if (!empty($type)) {
        $conditions[] = "tb_application.applicant_type LIKE '%$type%'";
       

    }

    $whereClause = "";
    if (count($conditions) > 0) {
        $whereClause = "and (" . implode(" and ", $conditions) . ")";
    }


    $loadinfo ="";

    $n = 1;
    
    if($scholarship != ""){
        if($scholarship != "0"){
            $query = "select 
            tb_yearsem.academic_year,
            CASE WHEN tb_yearsem.semester = '".openssl_encrypt("1st Semester", $method, $key)."' THEN tb_approve.allowance ELSE NULL END AS '1st_semester',
            CASE WHEN tb_yearsem.semester = '".openssl_encrypt("2nd Semester", $method, $key)."' THEN tb_approve.allowance ELSE NULL END AS '2nd_semester',
            
            tb_application.application_num, tb_application.application_date, tb_application.applicant_type, tb_application.id as application_id, tb_yearsem.academic_year, tb_yearsem.semester, tb_program.name as program_name, tb_studentinfo.last_name, tb_studentinfo.first_name, tb_studentinfo.middle_name, tb_yearlevel.name as yearlevel, tb_scholarships.name as scholarship_name, tb_approve.award_number, tb_approve.approved_date, tb_student.student_number
            FROM tb_application, tb_yearsem, tb_program, tb_studentinfo, tb_yearlevel, tb_scholarships, tb_approve, tb_student
            WHERE tb_application.yearsem_id = tb_yearsem.id and tb_application.student_id = tb_studentinfo.student_id and tb_application.scholarship_id = tb_scholarships.id and tb_studentinfo.program_id = tb_program.id  and tb_studentinfo.yearlevel_id = tb_yearlevel.id and tb_studentinfo.student_id = tb_student.id and tb_approve.application_id = tb_application.id and tb_application.scholarship_id = '$scholarship' $whereClause GROUP BY tb_application.student_id, tb_yearsem.academic_year";
    
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    
            $loadinfo = "<table class='table table-bordered table_records'> 
                        <tr>
                            <th>Sequence #</th>
                            <th>Award Number</th>
                            <th>Student ID</th>
                            <th>Last Name</th>
                            <th>Given Name</th>
                            <th>Middle Initial</th>
                            <th>Program</th>
                            <th>Year Level</th>
                            <th>Academic Year</th>
                            <th>1st Semester</th>
                            <th>2nd Semester</th>
                            <th>Total Amount</th>
                            </tr>";
            
            $accumulated_total = 0;
            $accumulated_firsttotal = 0;
            $accumulated_secondtotal = 0;
            while($row = mysqli_fetch_assoc($result)){
                $total_amount = 0;
                $application_num = openssl_decrypt($row["application_num"], $method, $key);
                $application_date = openssl_decrypt($row["application_date"], $method, $key);
    
                $applydate_create = date_create($application_date);
                $format_applydate = date_format($applydate_create,"F j, Y");
    
                $type = openssl_decrypt($row["applicant_type"], $method, $key);
                $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
                $semester = openssl_decrypt($row["semester"], $method, $key);
                $program_name = openssl_decrypt($row["program_name"], $method, $key);
                $last_name = openssl_decrypt($row["last_name"], $method, $key);
                $first_name = openssl_decrypt($row["first_name"], $method, $key);
                $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
                $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
                $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);
    
                $award_number = openssl_decrypt($row["award_number"], $method, $key);
                $student_number = openssl_decrypt($row["student_number"], $method, $key);
    
                $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
                $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);
    
    
    
                if ($row["1st_semester"] !== null) {
    
                    $total_amount += floatval($first_semester);
                    $accumulated_firsttotal += floatval($first_semester);
                }else{
                    $total_amount += 0;
                    $accumulated_firsttotal += 0;

    
                }
    
                if ($row["2nd_semester"] !== null) {
    
                    $total_amount += floatval($second_semester);
                    $accumulated_secondtotal += floatval($second_semester);

                }else{
                    $total_amount += 0;
                    $accumulated_secondtotal += 0;
                    
                }   
    
    
                $middle_initial = strtoupper(substr($middle_name, 0, 1));
    
                $loadinfo .= "<tr>
                    <td>$n</td>
                    <td>$award_number</td>
                    <td>$student_number</td>
                    <td>$last_name</td>
                    <td>$first_name</td>
                    <td>$middle_initial.</td>
                    <td>$program_name</td>
                    <td>$yearlevel</td>
                    <td>$academic_year</td>
                    <td>$first_semester</td>
                    <td>$second_semester</td>
                    <td>".number_format($total_amount, 2, '.', ',')."</td>
                
                </tr>";
                $accumulated_total += $total_amount;
                $n++;
            }
    
            $loadinfo .= "
            <tr>
                <td colspan='9'><b>TOTAL</b></td>
                <td ><b>".number_format($accumulated_firsttotal, 2, '.', ',')."</b></td>
                <td ><b>".number_format($accumulated_secondtotal, 2, '.', ',')."</b></td>
                <td><b>".number_format($accumulated_total, 2, '.', ',')."</b></td>
            </tr>
            </table>";
        }else{
            $fee_totals = array();
            $total_tuition = 0;
            $total_tosf = 0;

            $query = 'select tb_student.student_number, tb_studentinfo.lrn, tb_studentinfo.last_name, tb_studentinfo.first_name, tb_studentinfo.middle_name, tb_program.name as program_name, tb_yearlevel.name as yearlevel, tb_studentinfo.sex, tb_student.email,tb_student.contact, tb_studentinfo.total_units, tb_program.cost_per_unit as tuition_fee, tb_yearlevel.fees_id
            FROM tb_student, tb_studentinfo, tb_program, tb_yearlevel, tb_application
            WHERE tb_yearlevel.program_id = tb_program.id and tb_program.id = tb_studentinfo.program_id and tb_studentinfo.yearlevel_id = tb_yearlevel.id and tb_studentinfo.student_id = tb_student.id and tb_application.student_id = tb_studentinfo.student_id '.$whereClause;

            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            $loadinfo = '<table class="table table-bordered table_records"> 
                        <tr>
                            <th>Sequence #</th>
                            <th>Student Number</th>
                            <th>Learner\'s Reference Number</th>
                            <th>Last Name</th>
                            <th>Given Name</th>
                            <th>Middle Initial</th>
                            <th>Degree Program</th>
                            <th>Year Level</th>
                            <th>Sex</th>
                            <th>Email Address</th>
                            <th>Contact</th>
                            <th>Laboratory Units/Subjects</th>
                            <th>Computer Lab Units/Subjects</th>
                            <th>Academic Units Enrolled (credit and non-credit courses)</th>
                            <th>Academic Units of NSTP Enrolled (credit and non-credit courses)</th>
                            <th>Tuition Fee based on enrolled academic units (credit and non-credit courses)</th>
                            <th>NSTP Fee based on enrolled academic</th>';
                            $resultFees = $conn->query("select * from tb_fees");
                      
                            while($rowFees = $resultFees->fetch_assoc()){
                                $loadinfo .= '<th>'.openssl_decrypt($rowFees["name"], $method, $key).'</th>';
                                $fee_totals[$rowFees["id"]] = 0; 
                                
                            }
            $loadinfo .= '<th>Total TOSF</th>
                        </tr>';
            
            

            while($row = mysqli_fetch_assoc($result)){
                $total_fees = 0;
                $program_name = openssl_decrypt($row["program_name"], $method, $key);
                $tuition_fee = openssl_decrypt($row["tuition_fee"], $method, $key);
                $last_name = openssl_decrypt($row["last_name"], $method, $key);
                $first_name = openssl_decrypt($row["first_name"], $method, $key);
                $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
                $middle_initial = strtoupper(substr($middle_name, 0, 1));
                $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
                $yearnum = strtoupper(substr($yearlevel, 0, 1));
                $student_number = openssl_decrypt($row["student_number"], $method, $key);
                $email = openssl_decrypt($row["email"], $method, $key);
                $contact = openssl_decrypt($row["contact"], $method, $key);
                $sex = openssl_decrypt($row["sex"], $method, $key);
                $lrn = openssl_decrypt($row["lrn"], $method, $key);
                $fees_id = openssl_decrypt($row["fees_id"], $method, $key);
                $fees = explode(",", $fees_id);

                $loadinfo .= '<tr><td>'.$n.'</td>
                                <td>'.$student_number.'</td>
                                <td>'.$lrn.'</td>
                                <td>'.$last_name.'</td>
                                <td>'.$first_name.'</td>
                                <td>'.$middle_initial.'</td>
                                <td>'.$program_name.'</td>
                                <td>'.$yearnum.'</td>
                                <td>'.$sex.'</td>
                                <td>'.$email.'</td>
                                <td>'.$contact.'</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>'.$tuition_fee.'</td>
                                <td></td>';
                                $total_tuition += floatval($tuition_fee);

                                $resultFees = $conn->query("select * from tb_fees");
                      
                                while($rowFees = $resultFees->fetch_assoc()){
                                    $found = false;
                                    foreach ($fees as $fee_id) {
                                        if ($fee_id == $rowFees["id"]) {
                                            $found = true;
                                            $amount = floatval(openssl_decrypt($rowFees["amount"], $method, $key));
                                            $loadinfo .= '<td>' .$amount. '</td>';
                                            $total_fees += $amount;
                                            $fee_totals[$fee_id] += $amount;
                                            break; 
                                        }
                                    }
                                    if (!$found) {
                                        $loadinfo .= '<td>-</td>';
                                        $fee_totals[$fee_id] += 0;

                                    }
                                    
                                }
                                
                $loadinfo .= '<td>'.number_format($total_fees, 2, ".", ",").'</td>
                </tr>';
                $total_tosf+=$total_fees;
                $n++;
            }
            $loadinfo .= '
            <tr>
                <td colspan="2"><b>TOTAL</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>'.number_format($total_tuition, 2, ".", ",").'</b></td>
                <td>#</td>';

                foreach ($fee_totals as $fee_id => $total) {
                    if($total == 0){
                        $loadinfo .= '<td>#</td>';

                    }else{
                    $loadinfo .= '<td><b>' . number_format($total, 2, ".", ",") . '</b></td>';

                    }
                }
                
            
            $loadinfo .= '
            <td><b>'.number_format($total_tosf, 2, ".", ",").'</b></td>
            </tr>
            </table>';
            
        }
    }
    
    echo $loadinfo;
?>