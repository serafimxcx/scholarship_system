<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/Exception.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/PHPMailer.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/SMTP.php");
    
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    $student_no = openssl_encrypt($_POST["studentno"], $method, $key);

    $email = "";
    $verification_code = md5(uniqid(rand(), true));

    $checkUser = $conn->query("select * from tb_student where student_number = '$student_no'");

    if(mysqli_num_rows($checkUser) == 0){
        echo "No student found. Please check your student number";
    }else{
        while($row=$checkUser->fetch_assoc()){
            $email = openssl_decrypt($row["email"], $method, $key);
        }

        $e_verification_code =  openssl_encrypt($verification_code, $method, $key);

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
                $mail->Subject = "iApply Forgot Password - Verification Code";

                $mail->Body = "Here is your verification code for changing password <b>$verification_code</b>. Don't share this information to other people.";
                
                // Send the email
                $mail->send();


                $conn->query("update tb_student set verification_code ='$e_verification_code' where student_number='$student_no'");

                echo "";
    }

?>