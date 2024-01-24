<?php
   include('includes/config.php');

     //code that will hide the warning part
	 error_reporting(E_ERROR | E_PARSE);

   session_start();
   $msg='';
   $lock = time();
   $time=time()-30;
   $ip_address=getIpAddr();

    
   if (isset($_SESSION['email'])) {
    header("location: index.php");
     }



    
   
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
   


// Getting total count of hits on the basis of IP
$sql=mysqli_query($conn,"SELECT * FROM tbl_login_logs where Trytime > $time and IpAddress='$ip_address'");
$attempts = mysqli_num_rows($sql);
//Checking if the attempt 3, or youcan set the no of attempt her. For now we taking only 3 fail attempted
    
//Getting Post Values
$email = mysqli_real_escape_string($conn,$_POST['email']);
$pword = mysqli_real_escape_string($conn,$_POST['pword']);

//To Prevent From Mysqli Injection
$email = stripcslashes($email);
$pword = stripcslashes($pword);
$email = mysqli_real_escape_string($conn, $email);
$pword = mysqli_real_escape_string($conn, $pword);

  

      $sql = mysqli_query($conn, "SELECT * FROM tbl_user WHERE email='$email' AND password='$pword' ");
      $rows = mysqli_fetch_array($sql);
      $count = mysqli_num_rows($sql);



      if($count == 1){
        $stats=$rows['stats'];
        $access=$rows['AccountType'];
        $_SESSION['email'] = $email;
        if($access=="Admin"){
          $sql = mysqli_query($conn, "INSERT INTO tbl_logs(action,user_id,updated_at) VALUES('login to $access dashboard',(SELECT ID FROM tbl_user WHERE email= '$email'),CURRENT_TIMESTAMP)");	
            header("Location: index.html");
        }
      

        else{
            if ($stats==1) {
                if ($stats == 0) {
                    $error =  "Account has been blocked temporarily. Please contact your administrator!";
                }
              
                 else {
                  $sql = mysqli_query($conn, "INSERT INTO tbl_logs(action,user_id,updated_at) VALUES('login to $access dashboard',(SELECT ID FROM tbl_user WHERE email= '$email'),CURRENT_TIMESTAMP)");	
        
                    header("Location: user_dashboard.php"); }
                   
                   
                                                         
            }
            if ($stats==2) {
                        
                  if ($stats == 2) {
                    $error =  "Wait for the admin to approve your account. Please contact your administrator!";
                }
              
                 else {
                  $sql = mysqli_query($conn, "INSERT INTO tbl_logs(action,user_id,updated_at) VALUES('login to $access dashboard',(SELECT ID FROM tbl_user WHERE email= '$email'),CURRENT_TIMESTAMP)");	
        
                    header("Location: user_dashboard.php"); }
                 
                                                       
          }
          
          
           
        }
        
     
    }else{
      $attempts++;
      $rem_attm=3-$attempts;
      if($rem_attm==0){
      $msg="To many failed login attempts. Please login after ";
      }elseif($rem_attm==1){
        $msg="Incorrect Username or Password. 1 remaining login attempt";
      }elseif($rem_attm==2){
        $msg="Incorrect Username or Password. 2 remaining login attempts";
      }
      $try_time=time();
      mysqli_query($conn,"insert into tbl_login_logs(IpAddress,Trytime) values('$ip_address','$try_time')");
      }}
      
      // Getting IP Address
      function getIpAddr(){
      if (!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
      }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
      $ipAddr=$_SERVER['REMOTE_ADDR'];
      }
      return $ipAddr;
      }

      
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - HRMS admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		<style>
	

			.circular-image {
				border-radius: 50%;
				display: block;
				align-items: center;
				justify-content: center;
				display: flex;
				flex-direction: column;
				margin: auto;
			
			}
			
			
		</style>
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<a href="job-list.html" class="btn btn-primary apply-btn">Visit Website</a>
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img class="circular-image" src="assets/img/C1.png" alt="Circular Image"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form method="post">
							<?php $sql=mysqli_query($conn,"SELECT * FROM tbl_login_logs where Trytime > $time and IpAddress='$ip_address'");
								$attempts = mysqli_num_rows($sql);
								if($attempts==0 || $attempts==1 || $attempts==2){
								echo "<center><p style='color:red;'> $msg </p></center>" ;
												}
											?> 
								<div class="form-group">
									<label>Email Address</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>												
									</div>
									<input class="form-control" name="pword" id="pword" type="password" oninput="checkInput()" placeholder="Enter Password">
								</div>
							
								<div class="form-group">
								<div style="float:left;">
								<small>
								<input type="checkbox" name="" onclick="myFunction()" id="showPasswordCheckbox" disabled>
								<label>Show password</label></small>
								</div>
								<div style="float:right;">
								<a href="forgotpass.php"><h5>Forgot Password?</h5></a>
								</div>
								</div>
								<br>
								<br>
								<?php $sql=mysqli_query($conn,"SELECT * FROM tbl_login_logs where Trytime > $time and IpAddress='$ip_address'");
									$attempts = mysqli_num_rows($sql);
									if($attempts >= 3){
									echo  "<h4 style='text-align: center;font-weight: bold;color:blue;'> To many failed login attempts. Please login after</h4>	
									<h4 style='text-align: center;font-weight: bold;color:blue;'id='status'></h4>";
										
								}
								else{?>
								
								
								
								
								

								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Login</button>
								</div>
								<?php }?>
								<?php if (isset($error)){ ?>
								<p class="err"> <a href=""><?php echo $error;?></a> </p>
								<?php }?>
								
								<div class="account-footer">
									<p>Don't have an account yet? <a href="register.html">Register</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<script>
			function myFunction() {
				var passwordField = document.getElementById('pword');
				var showCheckbox = document.getElementById('showPasswordCheckbox');
		
				if (passwordField.value.trim() !== '') {
					if (showCheckbox.checked) {
						passwordField.type = 'text';
					} else {
						passwordField.type = 'password';
					}
				} else {
					passwordField.type = 'password';
					showCheckbox.checked = false;
				}
			}
		
			function checkInput() {
				var passwordField = document.getElementById('pword');
				var showCheckbox = document.getElementById('showPasswordCheckbox');
		
				if (passwordField.value.trim() !== '') {
					showCheckbox.disabled = false;
				} else {
					showCheckbox.checked = false;
					showCheckbox.disabled = true;
				}
			}
			
			var count = new Date().getTime();


// Update the count down every 1 second
var x = setInterval(function() {

	// Get today's date and time
	var now = new Date().getTime() - 31000;
	
		
	// Find the distance between now and the count down date
	var distance = count - now;
		
	// Time calculations for days, hours, minutes and seconds
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
	// Output the result in an element with id="demo"
	document.getElementById("status").innerHTML = seconds;
		
	// If the count down is over, write some text 
	if (seconds == 0) {
		clearInterval(x);
		window.location.href = "login.php";
	}
}, 1000);
		</script>
		<!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>