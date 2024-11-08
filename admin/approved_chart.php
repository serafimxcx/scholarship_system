<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
session_start();

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

// Image dimensions
$image_width = 600;
$image_height = 600;

// Create image
$image = imagecreatetruecolor($image_width, $image_height);

// Allocate colors
$bg_color = imagecolorallocate($image, 255, 255, 255); // white background
$text_color = imagecolorallocate($image, 0, 0, 0); // black text

// Define colors for slices (example colors)
$colors = [
    imagecolorallocate($image, 225, 55, 69),  // #E13745
    imagecolorallocate($image, 101, 23, 30),  // #65171e
];

// Fill background
imagefilledrectangle($image, 0, 0, $image_width, $image_height, $bg_color);

// Total number of applicants
$total_applicants = array_sum($scholarship_data);

// Starting angle for the first slice
$start_angle = 0;

// Draw slices and text labels
$i = 0;
foreach ($scholarship_data as $label => $count) {
    // Calculate percentage
    $percentage = ($count / $total_applicants) * 360;

    // Allocate color for the slice
    $slice_color = $colors[$i % count($colors)];

    // Draw the slice
    imagefilledarc($image, $image_width / 2, $image_height / 2, $image_width, $image_height, $start_angle, $start_angle + $percentage, $slice_color, IMG_ARC_PIE);

    // Calculate coordinates for text label
    $text_radius = $image_width * 0.4;
    $text_angle = deg2rad($start_angle + $percentage / 2);
    $text_x = $image_width / 2 + cos($text_angle) * $text_radius;
    $text_y = $image_height / 2 + sin($text_angle) * $text_radius;

    // Draw text label using imagestring
    $text = "$label: $count";
    imagestring($image, 5, $text_x - (strlen($text) * 3), $text_y, $text, $text_color);

    // Prepare for the next slice
    $start_angle += $percentage;
    $i++;
}

// Output image
header('Content-type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>
