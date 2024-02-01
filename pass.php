<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Verify Account</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/grouplogo.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
        <script type="text/javascript">
		function preback() {window.history.forward();}
		setTimeout ("preback()",0);
		window.onunload=function(){null};
		</script>
    </head>
<body class="hold-transition login-page">
 
            <!-- Main Wrapper -->
            <div class="main-wrapper">
                    
                   

                        <br> <br> <br> <br> <br> <br> <br>
            <div class="container">

                         <div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Account Verification</h3>
							<p class="account-subtitle">Enter the valid verification code sent in your email address to get verified.</p>
							
							<!-- Account Form -->
							<form class="user" method="POST">
                            <div class="form-group">
									<label>Verification Code</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Code" name="code">                             
                          </div>
                             <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control form-control-user" id="newPassword" placeholder="Enter new password" name="newpword" required>
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control form-control-user" id="confirmPassword" placeholder="Confirm new password" name="confirmpword" required>
                                <p id="error-message" style="color: red;"></p>
                            </div>
								<div class="form-group text-center">
									<button type="submit" class="btn btn-primary account-btn" type="submit" name="recover">Verify Password</button>
								</div>
								<!-- <div class="account-footer">
									<p>Remember your password? <a href="login.php">Login</a></p>
								</div> -->
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
  <!-- /.login-box-body -->
</div>
                  
            </div>
<!-- /.login-box -->
   <!-- modal for invalid code -->
   <div id="invalid" class="modal"  role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm"  >
                <div class="modal-content text-center" >
                    <div class="modal-body">
                        <h5>Please enter a valid code!</h5>   
                    </div>
                    <div class="modal-footer center">
                        <button class="btn-sm btn-primary" data-dismiss="modal">Ok</button>
                    </div>                 
                </div>
            </div>
        </div>

          <!-- modal for success -->
            <div id="done" class="modal"  role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md"  >
                    <div class="modal-content text-center" >
                        <div class="modal-body">
                             <p class="text-center" style="font-size:20px">
                            You have successfully verified your account! <br> Please log in to continue.</p>  
                        </div>
                        <div class="modal-footer center">
                           <button class="btn-sm btn-primary"><a href="login.php" style="color: #fff">LOG IN</a></button>
                        </div>
                    </div>
                </div>
            </div>

<!-- jQuery 3 -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
		
<!-- Bootstrap Core JS -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/app.js"></script>
<script>
    var confirmPasswordInput = document.getElementById("confirmPassword");
    var errorMessage = document.getElementById("error-message");

    confirmPasswordInput.addEventListener("input", function () {
        validatePassword();
    });

    function validatePassword() {
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = confirmPasswordInput.value;

        if (confirmPassword !== "") {
            if (newPassword !== confirmPassword) {
                errorMessage.textContent = "Passwords do not match!";
            } else {
                errorMessage.textContent = "";
            }
        } else {
            errorMessage.textContent = "";
        }
    }
</script>

<?php 
            if(isset($_POST["recover"])){
                include('includes/config.php');
                $code = $_POST["code"];

             $newpword= ($_POST['newpword']); 
            


             $sql = mysqli_query($conn, "SELECT * FROM tbl_user WHERE ResetCode='$code' and AccountType='Student'");
                $rowcheck = mysqli_fetch_array($sql);
                $query = mysqli_num_rows($sql);
          

                if(mysqli_num_rows($sql) <= 0){
                    ?>
                   <script>
                    $("#invalid").show();
                    $('#invalid').modal();  
               </script>

                    <?php
                
                }else{ 
                       
                    $sqlu = mysqli_query($conn, "UPDATE tbl_user SET password='$newpword' WHERE ResetCode='$code'");
                ?>
                

                 <script>
                    $("#done").show();
                    $('#done').modal();  
               </script>
                <?php    
            }
        }   

?>
</body>
</html>
