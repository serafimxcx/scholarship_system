<?php 
    
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $student_id="";
    $user_name="";
    $student_no="";
    $email="";
    $contact="";

    $student_name="";


    $haveInfo = false;
    $profile_pic = "";
    $lrn = "";
    $school_attended = "";
    $school_id_num = "";
    $school_address = "";
    $school_sector = "";
    $disability = "";
    $tribal_membership = "";
    $program_id = "";
    $yearlevel_id = "";
    $total_units = "";
    $last_name = "";
    $first_name = "";
    $middle_name = "";
    $birthdate = "";
    $birthplace = "";
    $sex = "";
    $civil_status = "";
    $religion = "";
    $citizenship = "";
    $address = "";
    $postal_code = "";

    $father_name = "";
    $father_occupation = "";
    $father_address = "";
    $father_status = "";
    $mother_name = "";
    $mother_occupation = "";
    $mother_address = "";
    $mother_status = "";
    $no_of_siblings = "";
    $gross_income = "";


    if(!isset($_SESSION["kll_user_id"])){
        echo "<script>alert('Please login your account.');
                    window.location.href='/scholarship_system/user/register_login/user_login.php'</script>";
    }else{
        $result=$conn->query("select * from tb_student where id='$_SESSION[kll_user_id]'");

        while($row=$result->fetch_assoc()){
            $student_no = openssl_decrypt($row["student_number"], $method, $key);
            $email = openssl_decrypt($row["email"], $method, $key);
            $contact = openssl_decrypt($row["contact"], $method, $key);
            $student_id = $row["id"];
        }

        $studentinfo =$conn->query("select * from tb_studentinfo where student_id='$_SESSION[kll_user_id]'");
        $familyinfo =$conn->query("select * from tb_familyinfo where student_id='$_SESSION[kll_user_id]'");

        if(mysqli_num_rows($studentinfo) != 0 && mysqli_num_rows($familyinfo) != 0){
            $haveInfo = true;

            while($row = $studentinfo->fetch_assoc()){
                $profile_pic = openssl_decrypt($row["profile_pic"], $method, $key);
                $lrn = openssl_decrypt($row["lrn"], $method, $key);
                $school_attended = openssl_decrypt($row["school_attended"], $method, $key);
                $school_id_num = openssl_decrypt($row["school_id_num"], $method, $key);
                $school_address = openssl_decrypt($row["school_address"], $method, $key);
                $school_sector = openssl_decrypt($row["school_sector"], $method, $key);
                $disability = openssl_decrypt($row["disability"], $method, $key);
                $tribal_membership = openssl_decrypt($row["tribal_membership"], $method, $key);
                $program_id = $row["program_id"];
                $yearlevel_id = $row["yearlevel_id"];
                $total_units = openssl_decrypt($row["total_units"], $method, $key);
                $last_name = openssl_decrypt($row["last_name"], $method, $key);
                $first_name = openssl_decrypt($row["first_name"], $method, $key);
                $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
                $birthdate = openssl_decrypt($row["birthdate"], $method, $key);
                $birthplace = openssl_decrypt($row["birthplace"], $method, $key);
                $sex = openssl_decrypt($row["sex"], $method, $key);
                $civil_status = openssl_decrypt($row["civil_status"], $method, $key);
                $religion = openssl_decrypt($row["religion"], $method, $key);
                $citizenship = openssl_decrypt($row["citizenship"], $method, $key);
                $address = openssl_decrypt($row["address"], $method, $key);
                $postal_code = openssl_decrypt($row["postal_code"], $method, $key);
            }

            while($row = $familyinfo->fetch_assoc()){
                $father_name = openssl_decrypt($row["father_name"], $method, $key);
                $father_occupation = openssl_decrypt($row["father_occupation"], $method, $key);
                $father_address = openssl_decrypt($row["father_address"], $method, $key);
                $father_status = openssl_decrypt($row["father_status"], $method, $key);
                $mother_name = openssl_decrypt($row["mother_name"], $method, $key);
                $mother_occupation = openssl_decrypt($row["mother_occupation"], $method, $key);
                $mother_address = openssl_decrypt($row["mother_address"], $method, $key);
                $mother_status = openssl_decrypt($row["mother_status"], $method, $key);
                $no_of_siblings = openssl_decrypt($row["no_of_siblings"], $method, $key);
                $gross_income = openssl_decrypt($row["gross_income"], $method, $key);
            }

            $student_name = explode(' ', $first_name);
        }else{
            $haveInfo = false;

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="/scholarship_system/style.css">
</head>
<body>
    

<div id="mySidenav" class="sidenav user_sidenav">
    <span class="user_name"><table>
        <tr>
            <td class="profile-container">
            <img src='
                    <?php 
                        if($profile_pic == ""){
                            echo "/scholarship_system/user/profile/profilepic/default.png";
                        }else{
                            echo "/scholarship_system/user/profile/profilepic/".$profile_pic;
                        }
                    
                    ?>
                    ' class='nav_profile_img'>
            </td>
            <td><span class="student_name"><b><?php echo 'Hello, Student ';

            if($haveInfo == true){
                echo '<br>'. $first_name;
            }else{
                echo '<br>#' . $student_no; 
            }
            
            
            ?>
            </b></span></td>
        </tr>
    </table></span>
    <a href="javascript:void(0)" class="closebtn user_closebtn" onclick="closeNav()">&times;</a>
    <br><br><br>
    <ul class="ul_user_nav">
        <li><a href="/scholarship_system/user/profile/profile.php"><i class="bi bi-file-person-fill"></i> &nbsp;Profile</a></li>

        <?php 
            if($haveInfo == true){
                echo "<li><a href='/scholarship_system/user/apply/applynow.php'><i class='bi bi-pencil-fill'></i> &nbsp;Apply Scholarship</a></li>";
            }
        
        ?>
        <li><a href="/scholarship_system/user/profile/changepass.php"><i class="bi bi-person-fill-lock"></i> &nbsp;Change Password</a></li>

        <li id="btn_logout"><i class="bi bi-door-open-fill"></i> &nbsp;Logout</li>

    </ul>
     
    
</div>

<div class="modal" id="logout_modal">
    <div id="logout_div">
        <center>
        <h3><b>Do you want to logout?</b></h3><br>
        <button type="button" class="btn btn-default" id="btn_no_logout">No</button>
        <button type="button" class="btn btn-danger" id="btn_yes_logout">Yes</button>
            
        </center>
        
    </div>
</div>

<div class="message_div">
    
</div>

<script>
    $(function(){
        $("#m_reports").click(function(){
            if($(".reports").css("display") == "none"){
                $(".reports").css({"display":"block"});
                $("#a_reports").html("<i class='bi bi-file-earmark-text-fill'></i> &nbsp;View Reports &nbsp;<span class='glyphicon glyphicon-triangle-top'></span>");
            }else{
                $(".reports").css({"display":"none"});
                $("#a_reports").html("<i class='bi bi-file-earmark-text-fill'></i> &nbsp;View Reports &nbsp;<span class='glyphicon glyphicon-triangle-bottom'></span>");
            }
        });

        $("#m_academic").click(function(){
            if($(".academic").css("display") == "none"){
                $(".academic").css({"display":"block"});
                $("#a_academic").html("<i class='bi bi-pencil-fill'></i> &nbsp;Academic Administration &nbsp;<span class='glyphicon glyphicon-triangle-top'></span>");
            }else{
                $(".academic").css({"display":"none"});
                $("#a_academic").html("<i class='bi bi-pencil-fill'></i> &nbsp;Academic Administration &nbsp;<span class='glyphicon glyphicon-triangle-bottom'></span>");
            }
        });

        $("#btn_logout").click(function(){
            $("#logout_modal").css("display", "flex");
        });

        $("#btn_no_logout").click(function(){
            $("#logout_modal").css("display", "none");
        });

        $("#btn_yes_logout").click(function(){
            window.location.href="/scholarship_system/user/logout.php";
        });
    });
    
    function openNav() {
        $("#mySidenav").css("display", "block");
    }

    function closeNav() {
        $("#mySidenav").css("display", "none");
    }
</script>

</body>
</html>