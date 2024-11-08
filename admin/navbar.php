<?php 
    
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $admin_name="";
    $admin_type="";
    if(!isset($_SESSION["kll_admin_id"])){
        echo "<script>alert('Please login your account.');
                    window.location.href='/scholarship_system/admin/admin_login.php'</script>";
    }else{
        $result=$conn->query("select * from tb_admin where id='$_SESSION[kll_admin_id]'");

        while($row=$result->fetch_assoc()){
            $admin_type = openssl_decrypt($row["admin_type"], $method, $key);
            $name = openssl_decrypt($row["name"], $method, $key);
        }

        $admin_name = explode(" ", $name);
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
    <div class="header">
    <table width="100%">
        <tr>
            <td><span class="navbar-btn" onclick="openNav()">&#9776;</span></td>
            <td style='text-align:right'><h2><b>KLL SCHOLARSHIP SYSTEM</b></h2></td>
        </tr>
    </table>
    </div>


<div id="mySidenav" class="sidenav">
    <span class="user_name"><b><?php echo "Hello, " . $admin_name[0] ; ?></b></span>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <br>
    <ul>
        
        <li><a href="/scholarship_system/admin/dashboard.php"><i class="bi bi-house-door-fill"></i> &nbsp;Dashboard</a></li>
        <li><a href="/scholarship_system/admin/manage_applications/applications.php"><i class="bi bi-file-earmark-arrow-up-fill"></i> &nbsp;Applications</a></li>
        <li><a href="/scholarship_system/admin/manage_scholars/scholars.php"><i class="bi bi-award-fill"></i> &nbsp;Scholars</a></li>


        <li><a href="/scholarship_system/admin/payroll_billing/payroll_billing.php"><i class="bi bi-wallet-fill"></i> &nbsp;Payroll & Billing</a></li>

        <!-- <li id="m_reports"><span id="a_reports"><i class="bi bi-file-earmark-text-fill"></i> &nbsp;View Reports &nbsp;<span class="glyphicon glyphicon-triangle-bottom"></span></span></li>
            <li class="reports"><a href="">Students</a></li>
            <li class="reports"><a href="/scholarship_system/admin/payroll_billing/payroll_billing.php">Payroll & Billing</a></li> -->

        <li><a href="/scholarship_system/admin/manage_announcement/announcement.php"><i class="bi bi-megaphone-fill"></i> &nbsp;Announcement</a></li>
        <li id="m_academic"><span id="a_academic"><i class="bi bi-pencil-fill"></i> &nbsp;Academic Administration &nbsp;<span class="glyphicon glyphicon-triangle-bottom"></span></span></li>
            <li class="academic"><a href="/scholarship_system/admin/manage_scholarship/scholarship.php">Scholarship</a></li>
            <li class="academic"><a href="/scholarship_system/admin/manage_fees/fees.php">School Fees</a></li>
            <li class="academic"><a href="/scholarship_system/admin/manage_program/program.php">Programs & Tuition Fees</a></li>
            <li class="academic"><a href="/scholarship_system/admin/manage_yearsem/yearsem.php">Academic Year & Semester</a></li>

        <?php 
            if($admin_type == "Head Admin"){
                echo "<li><a href='/scholarship_system/admin/manage_admin/admin.php'><i class='bi bi-person-fill-gear'></i> &nbsp;User Admin</a></li>";
            }
        ?>

        
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
            window.location.href="/scholarship_system/admin/logout.php";
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