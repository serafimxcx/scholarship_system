<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="/scholarship_system/style.css">

</head>
<body class="login_body">
    <div class="modal" style="display:flex;">
        <div id="login_div">
            <table width="100%">
                <tr>
                    <td>
                        <h2><b>ADMIN LOGIN</b></h2>
                        <h5>KLL Scholarship System</h5>
                    </td>
                    <td style="text-align: right;">
                        <img src="/scholarship_system/kll_logo.jpg" alt="kll_logo" class="img_logo" style="border-radius: 5px; border: 1px solid gray">
                        <img src="/scholarship_system/lipa_logo.jpg" alt="lipa_logo" class="img_logo">
                    </td>
                </tr>
            </table>
            
        
            <hr>
            <div class="row">
                <div class="col-lg-5" style="transform: translateY(25%);">
                    <label for=""><b><i class="bi bi-person-fill"></i>&nbsp; Username</b></label>
                </div>
                <div class="col-lg-7">
                    <input type="text" id="txt_username" class="form-control">
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-5" style="transform: translateY(25%);">
                    <label for=""><b><i class="bi bi-key-fill"></i>&nbsp; Password</b></label>
                </div>
                <div class="col-lg-7">
                    <input type="password" id="txt_pass" class="form-control">
                </div>
            </div>
            <br>
            <button type="button" id="btn_login" class="btn btn-danger">Login</button>
            
        </div>
    </div>
</body>

<div class="message_div">
    
</div>

<script>
    $(function(){
        $("#btn_login").click(function(){
            var cParam = "";

            cParam = "txt_username="+$('#txt_username').val();
            cParam += "&txt_pass="+$('#txt_pass').val();
        
            $.ajax({
            "type": 'POST',
            "url": 'login.php',
            "data": cParam,
            "dataType": 'json',
            "success": function (response) {
                if(response.success){
                    $(".message_div").text(response.message);
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        window.location.href = '/scholarship_system/admin/dashboard.php';
                    }, 2000);
                    
                }else{
                    
                    $(".message_div").text(response.message);
                    $(".message_div").fadeIn("fast");
                    setTimeout(function() {
                        $('.message_div').fadeOut('slow');
                    }, 2000);
                }
                
                }
            });
        });
    });
</script>
</html>