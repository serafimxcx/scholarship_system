<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/Exception.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/PHPMailer.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/SMTP.php");
   

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    
    $status = $_POST["status"];
    $application_id = $_POST["application_id"];
    $scholarship_name = $_POST["scholarship_name"];
    $student_name = $_POST["student_name"];
    $yearsem = $_POST["yearsem"];
    $email = $_POST["email"];
    $award_number = $_POST["award_number"];
    $allowance = $_POST["allowance"];
    $contact = $_POST["contact"];

    $e_status = openssl_encrypt($status, $method, $key);
    $e_allowance = openssl_encrypt($allowance, $method, $key);
    $e_award_number = openssl_encrypt($award_number, $method, $key);
    $e_approved_date = openssl_encrypt($dateNow, $method, $key);
    $scholar_status = openssl_encrypt("Ongoing", $method, $key);

    $api_key = '3cfcf39d0e39ae1e958a9f9c90d01ae2';

    $recipient = $contact;

    $url = 'https://api.semaphore.co/api/v4/messages';


    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
        //server setting
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iapply.kll@gmail.com'; // Your Gmail email address
        $mail->Password = 'cujqsnpojlcawtbm'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //sender and recipient
        $mail->setFrom('iapply.kll@gmail.com', 'Admin-KLL-Scholarship');
        $mail->addAddress($email);

        //email content
        $mail->isHTML(true);
        $mail->Subject = "KLL Scholarship Update - $scholarship_name";

        $acceptMessage = "
                (This is only a test message for a website testing. Please Ignore.)<br><br>
                Dear $student_name, <br><br>

                I am delighted to inform you that you have been <b>accepted</b> as a recipient of the $scholarship_name for the $yearsem. Congratulations on this significant achievement! <br><br>

                Your dedication to academic excellence, leadership qualities, and commitment to making a positive impact have truly set you apart. We are confident that you will continue to excel and make the most of the opportunities this scholarship provides.<br><br>

                Best regards,<br><br>
                Kolehiyo ng Lungsod ng Lipa<br>
                Lipa City, Batangas
            ";

        $rejectMessage = "
                (This is only a test message for a website testing. Please Ignore.)<br><br>

                Dear $student_name,<br><br>

                Thank you for applying for the $scholarship_name. After careful review, we regret to inform you that we are unable to offer you a scholarship this $yearsem since you were unable to meet all the requirements.<br><br>

                We appreciate your efforts and encourage you to continue striving towards your academic goals. We hope you will consider applying again in the future.<br><br>

                Best regards,<br><br>
                Kolehiyo ng Lungsod ng Lipa<br>
                Lipa City, Batangas
            ";

        if($status == "Accepted"){
            $mail->Body = $acceptMessage;

            $message = <<<EOT
            (This is only a test message for a website testing. Please Ignore.)
            Dear $student_name,
            I am delighted to inform you that you have been accepted as a recipient of the $scholarship_name for the $yearsem. Congratulations on this significant achievement!
            Best regards,
            Kolehiyo ng Lungsod ng Lipa
            Lipa City, Batangas
            EOT;

        }else{
            $mail->Body = $rejectMessage;

            $message = <<<EOT
                (This is only a test message for a website testing. Please Ignore.)
                Dear $student_name,
                Thank you for applying for the $scholarship_name. After careful review, we regret to inform you that we are unable to offer you a scholarship this $yearsem since you were unable to meet all the requirements.
                Best regards,
                Kolehiyo ng Lungsod ng Lipa
                Lipa City, Batangas
                EOT;
        }
        
        // Send the email
        $mail->send();


        $conn->query("update tb_application set stats ='$e_status' where id='$application_id'");

        


        // Semaphore API URL

        // Data to be sent
        $data = [
            'apikey' => $api_key,
            'number' => $recipient,
            'message' => $message,
            'sendername' => 'iApplyKLL'
        ];

        // Initialize cURL
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);


        if($status == "Accepted"){
            $conn->query("insert into tb_approve(application_id, award_number, approved_date, allowance, scholar_status) values('$application_id', '$e_award_number', '$e_approved_date', '$e_allowance', '$scholar_status')");
        }else{
            $conn->query("delete from tb_approve where application_id='$application_id'");
        }

        echo "Application Updated Successfully.";
            

        

    
    $conn->close();

?>