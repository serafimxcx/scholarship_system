<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

date_default_timezone_set('Asia/Manila');
$dateNow = date("Y-m-d");

$results_per_page = $_POST["rows"]; // Number of results per page

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$start_from = ($page-1) * $results_per_page;
$sequence_start = $start_from + 1;

$yearsem = $_POST["slct_yearsem"];
$program = $_POST["slct_program"];
$name = !empty($_POST["name"]) ? trim($_POST["name"]) : "";
$yearlevel = !empty($_POST["slct_yearlevel"]) ? openssl_encrypt($_POST["slct_yearlevel"], $method, $key) : "";
$scholarship = $_POST["slct_scholarship"];
$status = !empty($_POST["slct_status"]) ? openssl_encrypt($_POST["slct_status"], $method, $key) : "";
$type = !empty($_POST["slct_apptype"]) ? openssl_encrypt($_POST["slct_apptype"], $method, $key) : "";

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
    $conditions[] = "tb_application.stats LIKE '%$status%'";
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
$query = "SELECT tb_application.application_num, tb_application.application_date, tb_application.stats, tb_application.applicant_type, tb_application.id as application_id, tb_yearsem.academic_year, tb_yearsem.semester, tb_program.name as program_name, tb_studentinfo.last_name, tb_studentinfo.first_name, tb_studentinfo.middle_name, tb_yearlevel.name as yearlevel, tb_scholarships.name as scholarship_name
    FROM tb_application, tb_yearsem, tb_program, tb_studentinfo, tb_yearlevel, tb_scholarships
    WHERE tb_application.yearsem_id = tb_yearsem.id 
      AND tb_application.student_id = tb_studentinfo.student_id 
      AND tb_application.scholarship_id = tb_scholarships.id 
      AND tb_studentinfo.program_id = tb_program.id  
      AND tb_studentinfo.yearlevel_id = tb_yearlevel.id 
      $whereClause";
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

// Calculate total filtered results and total pages
$total_filtered_results = count($filteredRows);
$total_pages = ceil($total_filtered_results / $results_per_page);

// Paginate the filtered results
$filteredRows = array_slice($filteredRows, $start_from, $results_per_page);

$loadinfo = "<table class='table table-bordered table_records'>
                <tr>
                    <th>Sequence #</th>
                    <th>Application #</th>
                    <th>Date</th>
                    <th>Scholarship</th>
                    <th>Name</th>
                    <th>Academic Year - Semester</th>
                    <th>Program</th>
                    <th>Year Level</th>
                    <th>Applicant Type</th>
                    <th>Status</th>
                    <th></th>
                </tr>";

foreach ($filteredRows as $row) {
    $application_num = openssl_decrypt($row["application_num"], $method, $key);
    $application_date = openssl_decrypt($row["application_date"], $method, $key);
    $applydate_create = date_create($application_date);
    $format_applydate = date_format($applydate_create, "F j, Y");
    $status = openssl_decrypt($row["stats"], $method, $key);
    $type = openssl_decrypt($row["applicant_type"], $method, $key);
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);
    $program_name = openssl_decrypt($row["program_name"], $method, $key);
    $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
    $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);

    $loadinfo .= "<tr>
        <td>$sequence_start</td>
        <td>$application_num</td>
        <td>$format_applydate</td>
        <td>$scholarship_name</td>
        <td>{$row['last_name']}, {$row['first_name']} {$row['middle_name']}</td>
        <td>$academic_year $semester</td>
        <td>$program_name</td>
        <td>$yearlevel</td>
        <td>$type</td>
        <td>$status</td>
        <td><button type='button' class='btn btn-default btn_viewinfo' application_id='{$row['application_id']}'>View Info</button></td>
    </tr>";

    $sequence_start++;
}

$loadinfo .= "</table>
<div class='pagination'><table style='float: right;'><tr>";

$loadinfo .= "<td><label class='btn_pagination page-link' data-page='" . max(1, $page - 1) . "'>Prev</label></td><td>";

$max_visible_pages = 5;
$start_page = max(1, $page - floor($max_visible_pages / 2));
$end_page = min($total_pages, $start_page + $max_visible_pages - 1);

if ($end_page - $start_page < $max_visible_pages - 1) {
    $start_page = max(1, $end_page - $max_visible_pages + 1);
}

for ($i = $start_page; $i <= $end_page; $i++) {
    $loadinfo .= "<label class='page-link' data-page='".$i."' style='";
    if ($i == $page) {
        $loadinfo .= "color: #b02732; font-weight: bold;";
    }
    $loadinfo .= "'>".$i."</label> ";
}

$loadinfo .= "</td><td><label class='btn_pagination page-link' data-page='" . min($total_pages, $page + 1) . "'>Next</label></td>";
$loadinfo .= "</tr></table></div>";

echo $loadinfo;
?>
