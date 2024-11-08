<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/pdf/config/tcpdf_config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/pdf/tcpdf.php');

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");
    
    $results_per_page = $_GET["rows"]; // Number of results per page
    
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_from = ($page-1) * $results_per_page;
    $sequence_start = $start_from + 1;
    
    $yearsem = $_GET["slct_yearsem"];
    $program = $_GET["slct_program"];
    $name = !empty($_GET["name"]) ? trim($_GET["name"]) : "";
    $yearlevel = !empty($_GET["slct_yearlevel"]) ? openssl_encrypt($_GET["slct_yearlevel"], $method, $key) : "";
    $scholarship = $_GET["slct_scholarship"];
    $status = !empty($_GET["slct_status"]) ? openssl_encrypt($_GET["slct_status"], $method, $key) : "";
    $type = !empty($_GET["slct_apptype"]) ? openssl_encrypt($_GET["slct_apptype"], $method, $key) : "";
    
    $conditions = [];
    if (!empty($yearsem)) {
        $conditions[] = "tb_application.yearsem_id LIKE '%$yearsem%'";
    }
    if (!empty($program)) {
        $conditions[] = "tb_studentinfo.program_id LIKE '%$program%'";
    }
    if (!empty($yearlevel)) {
        $conditions[] = "tb_yearlevel.name LIKE '%$yearlevel%'";
    }
    if (!empty($scholarship)) {
        $conditions[] = "tb_application.scholarship_id LIKE '%$scholarship%'";
    }
    if (!empty($status)) {
        $conditions[] = "tb_approve.scholar_status LIKE '%$status%'";
    }
    if (!empty($type)) {
        $conditions[] = "tb_application.applicant_type LIKE '%$type%'";
    }
    
    $whereClause = "";
    if (count($conditions) > 0) {
        $whereClause = "AND (" . implode(" AND ", $conditions) . ")";
    }
    
    $loadinfo = "";
    
    // Get filtered results
    $query = "SELECT tb_application.application_num, tb_application.application_date, tb_application.stats, tb_application.applicant_type, tb_application.id as application_id, tb_yearsem.academic_year, tb_yearsem.semester, tb_program.name as program_name, tb_studentinfo.last_name, tb_studentinfo.first_name, tb_studentinfo.middle_name, tb_yearlevel.name as yearlevel, tb_scholarships.name as scholarship_name, tb_approve.approved_date, tb_approve.scholar_status, tb_studentinfo.address
        FROM tb_application, tb_yearsem, tb_program, tb_studentinfo, tb_yearlevel, tb_scholarships, tb_approve
        WHERE tb_application.yearsem_id = tb_yearsem.id 
          AND tb_application.student_id = tb_studentinfo.student_id 
          AND tb_application.scholarship_id = tb_scholarships.id 
          AND tb_studentinfo.program_id = tb_program.id  
          AND tb_studentinfo.yearlevel_id = tb_yearlevel.id 
          AND tb_approve.application_id = tb_application.id 
          $whereClause ORDER BY tb_approve.scholar_status DESC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $filteredRows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $last_name = openssl_decrypt($row["last_name"], $method, $key);
        $first_name = openssl_decrypt($row["first_name"], $method, $key);
        $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
        
        $full_name1 = $last_name . ', ' . $first_name . ' ' . $middle_name;
        $full_name2 = $last_name . ' ' . $first_name . ' ' . $middle_name;
        $full_name3 = $first_name . ' ' . $middle_name . ' ' . $last_name;
        $full_name4 = $first_name . ' ' . $last_name;
        
        if (empty($name) || stripos($last_name, $name) !== false || stripos($first_name, $name) !== false || stripos($middle_name, $name) !== false || stripos($full_name1, $name) !== false || stripos($full_name2, $name) !== false || stripos($full_name3, $name) !== false || stripos($full_name4, $name) !== false) {
            $row["last_name"] = $last_name;
            $row["first_name"] = $first_name;
            $row["middle_name"] = $middle_name;
            $filteredRows[] = $row;
        }
    }
    
    // Sort the filtered rows by last name in ascending order
    usort($filteredRows, function ($a, $b) {
        return strcmp($a['last_name'], $b['last_name']);
    });
    
    // Calculate total filtered results and total pages
    $total_filtered_results = count($filteredRows);
    $total_pages = ceil($total_filtered_results / $results_per_page);
    
    // Paginate the filtered results
    $filteredRows = array_slice($filteredRows, $start_from, $results_per_page);
    $loadinfo .= '<style>
                table th { 
                    text-align: center; 
                    font-weight: bold; 
                    background-color: #E13745; 
                    color: white; 
                    border: 1px solid black;
                }
                table td {
                    border: 1px solid black;
                }
                .txt_date {
                    font-size: 10px;
                    line-height: 1.6;
                    font-weight: 100;
                }
                </style>';

$loadinfo .= '<br><h1>KOLEHIYO NG LUNGSOD NG LIPA
                <br><span class="txt_date"> As of ' . date("F j, Y") .'</span></h1><br><br>';

    $loadinfo .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th>Sequence #</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Application Date</th>
                        <th>Approved Date</th>
                        <th>Scholarship</th>
                        <th>Program</th>
                        <th>Year Level</th>
                        <th>Status</th>
                    </tr>';
    
    foreach ($filteredRows as $row) {
        $application_num = openssl_decrypt($row["application_num"], $method, $key);
        $application_date = openssl_decrypt($row["application_date"], $method, $key);
        $applydate_create = date_create($application_date);
        $format_applydate = date_format($applydate_create, "F j, Y");
    
        $approved_date = openssl_decrypt($row["approved_date"], $method, $key);
        $approvedate_create = date_create($approved_date);
        $format_approvedate = date_format($approvedate_create, "F j, Y");
    
        $scholar_status = openssl_decrypt($row["scholar_status"], $method, $key);
        $type = openssl_decrypt($row["applicant_type"], $method, $key);
        $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
        $semester = openssl_decrypt($row["semester"], $method, $key);
        $program_name = openssl_decrypt($row["program_name"], $method, $key);
        $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
        $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);
        $address = openssl_decrypt($row["address"], $method, $key);
    
    
        $loadinfo .= '<tr>
            <td>'.$sequence_start.'</td>
            <td>'.$row["last_name"].', '.$row["first_name"]. ' '.$row["middle_name"].'</td>
            <td>'.$address.'</td>
            <td>'.$format_applydate.'</td>
            <td>'.$format_approvedate.'</td>
            <td>'.$scholarship_name.'</td>
            <td>'.$program_name.'</td>
            <td>'.$yearlevel.'</td>
            <td>'.$scholar_status.'</td>
        </tr>';
    
        $sequence_start++;
    }
    
    $loadinfo .= "</table>";

    
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(5, 1, 5);

    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 8);
    $pdf->writeHTML($loadinfo);
    $filename = "scholar_records" . date("Y-m-d") . ".pdf";
    $pdf->Output($filename, 'I');
   
?>