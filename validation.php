<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Verify- Account</title>
		
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
    </head>
<body class="hold-transition login-page">
 
            <!-- Main Wrapper -->
            <div class="main-wrapper">
                    
                   

                        <br> <br> <br> <br> <br> <br> <br>
            <div class="container">

                         <div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Email Verification</h3>
							<p class="account-subtitle">Enter your email to get a verfication code</p>
							
							<!-- Account Form -->
							<form class="user" method="POST">
								<div class="form-group">
									<label>Email Address</label>
									<input class="form-control" type="email" name="email" placeholder="Please enter your Email Address" name="email">
								</div>
								<div class="form-group text-center">
									<button type="submit" class="btn btn-primary account-btn" type="submit" name="newpword">Verify Email</button>
								</div>
								<div class="account-footer">
									<p>Remember your verification code? <a href="register.php">Register</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
  <!-- /.login-box-body -->
</div>
                  
            </div>
<!-- /.login-box -->
<!-- modal for invalid input -->




<div id="invalidacc" class="modal"  role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm"  >
                    <div class="modal-content text-center" >
                        <div class="modal-body">
                            <h5>The Email Address you entered does not exist</h5>  
                        </div>
                        <div class="modal-footer center">
                           <button class="btn-sm btn-primary" data-dismiss="modal">Ok</button>
                        </div>
                   
                    </div>
                </div>
            </div>


             <!-- modal for account not verified -->
            <div id="verify" class="modal"  role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm"  >
                    <div class="modal-content text-center" >
                        <div class="modal-body">
                            <h5>Sorry, your account must verify first, before you verify your account!</h5>  
                        </div>
                        <div class="modal-footer center">
                           <button class="btn-sm btn-primary"><a href="register.php" style="color: #fff">Ok</a></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal for error sending -->
            <div id="errorsending" class="modal"  role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm"  >
                    <div class="modal-content text-center" >
                        <div class="modal-body">
                            <h5>An error occurred. Please try again.</h5>  
                        </div>
                        <div class="modal-footer center">
                           <button class="btn-sm btn-primary" data-dismiss="modal">Ok</button>
                        </div>                 
                    </div>
                </div>
            </div>
  <!-- Login Content -->

<!-- jQuery -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>

        <?php
    if (isset($_POST["newpword"])) {
        include('includes/config.php');
        $email = $_POST['email'];

        $sql = mysqli_query($conn, "SELECT * FROM tbl_user WHERE email='$email' and AccountType='Student'");
        $rowcheck = mysqli_fetch_array($sql);
        $query = mysqli_num_rows($sql);

		?>

        <!-- modal for sent email -->
        <div id="sentemail" class="modal"  role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md"  >
                <div class="modal-content text-center" >
                    <div class="modal-body">
                        <h5>A verification code has been sent to your email <br><br>
                            <b><?php echo $rowcheck['email']; ?></b></h5>
                            <br>  
                        <h5>Please CONTINUE to verify your account.</h5>
                    </div>
                    <div class="modal-footer center">
                        <button class="btn-sm btn-primary"><a href="pass.php" style="color: #fff">Continue</a></button>
                    </div>                 
                </div>
            </div>
        </div>

        <?php
        if (mysqli_num_rows($sql) <= 0) {
            ?>
            <script>
                $("#invalidacc").modal();
            </script>
            <?php
        } else if ($rowcheck["stats"] == 0) {
            ?>
            <script>
                $("#verify").modal();
            </script>
            <?php
        } else {
            // Generate token by binaryhexa
            // Code for sending the email
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            require "Mail/phpmailer/PHPMailerAutoload.php";

            $mail = new PHPMailer();

            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->Username = "talaydrin22@gmail.com";
            $mail->Password = "olejoujzgeazupwh";

            // Email settings
            $mail->isHTML(true);
            $mail->setFrom($email, 'OTP Code');
            $mail->addAddress($rowcheck['email']);
            $mail->Subject = "CSU CARIG CAMPUS PROCESS REQUEST";
			 // Insert the image banner here
			 $imageBanner = '<img src="https://tse2.mm.bing.net/th?id=OIP.vjVzhyXrZO4bBjtl5YHJMAHaB2&pid=Api&P=0&h=180" alt="Banner" style="max-width: 100%;">';

            $mail->Body = "	 $imageBanner
				<b>Dear User,</b>
                <h4>We received a request for OTP of your account.</h4>
                <h3>Your OTP code is $otp <br></h3><p>Make sure to enter the OTP code you have received in your email.<p/>
                <br><br>
                <b>CAGAYAN STATE UNIVERSITY CARIG CAMPUS</b>";

            if (!$mail->send()) {
                ?>
                <script>
                    $("#errorsending").modal();
                </script>
                <?php
            } else {
                ?>
                <script>
                    $("#sentemail").modal();
                </script>
                <?php

                $sqlu = mysqli_query($conn, "UPDATE tbl_user SET ResetCode='$otp' WHERE email='$email'");
            }
        }
    }
    ?>




</body>
</html>
