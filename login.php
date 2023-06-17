<?php      
    include_Once('./config.php');

    session_start();

    if(isset($_POST['submit'])){ 
     	$uname = $_POST['username'];  
    	$password = $_POST['password'];
    	$logtype = $_POST['usertype']; 

        $uname = stripcslashes($uname);  
        $password = stripcslashes($password);  
        $uname = mysqli_real_escape_string($con, $uname);  
        $password = mysqli_real_escape_string($con,$password);

        if ($logtype == "admin"){
        	$sql = "select nic, username, password from tbladmin where username = '$uname' and password = '$password'";
        }
        elseif ($logtype == "authorizer") {
        	$sql = "select nic, username, password from tblauthorizer where username = '$uname' and password = '$password' ";
        }
        elseif ($logtype == "donor") {
        	$sql = "select nic, username, password from tbldonor where username = '$uname' and password = '$password'";
        }
        elseif ($logtype == "requester") {
        	$sql = "select nic, username, password from tblrequester where username = '$uname' and password = '$password'";
        }

        //$sql = "select *from tblrequester where username = '$uname' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result); 

		if($count == 1){

	        if ($logtype == "admin"){

  				$_SESSION["type"] = $logtype;
  				$_SESSION["nic"] = $row['nic'];
  				$_SESSION["usertype"] = $logtype;

				echo '<script>alert("Login Successful !")</script>';
		        header("Location:../DonateWebProjectPHP/admin/Admin_UI.php");
	        }
	        elseif ($logtype == "authorizer") {

  				$_SESSION["type"] = $logtype;
  				$_SESSION["nic"] = $row['nic'];
  				$_SESSION["usertype"] = $logtype;
  				$_SESSION['user_id'] = $row['nic'];
  				$_SESSION['username'] = $row['username'];
  				include_Once('./chat/database_connection.php');
  				$sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['nic']."')";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();

				echo '<script>alert("Login Successful !")</script>';
		        header("Location:../DonateWebProjectPHP/authorizer/Authorizer_UI.php");
	        }
	        elseif ($logtype == "donor") {

  				$_SESSION['type'] = $logtype;
  				$_SESSION['nic'] = $row['nic'];
  				$_SESSION["usertype"] = $logtype;
  				$_SESSION['user_id'] = $row['nic'];
  				$_SESSION['username'] = $row['username'];
  				include_Once('./chat/database_connection.php');
  				$sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['nic']."')";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();

				echo '<script>alert("Login Successful !")</script>';
		        header("Location:../DonateWebProjectPHP/donor/Donor_UI.php");

	        }
	        elseif ($logtype == "requester") {

  				$_SESSION["type"] = $logtype;
  				$_SESSION["nic"] = $row['nic'];
  				$_SESSION["usertype"] = $logtype;
  				$_SESSION['user_id'] = $row['nic'];
  				$_SESSION['username'] = $row['username'];
  				include_Once('./chat/database_connection.php');
  				$sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['nic']."')";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();

				echo '<script>alert("Login Successful !")</script>';
		        header("Location:../DonateWebProjectPHP/requester/Requester_UI.php");
	        }
		}
		else
		{
			echo '<script>alert("Login Faild !")</script>';	 
		}   		         
  	}
 
?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA</title>


	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/superfish.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">	
	<link rel="stylesheet" href="css/style.css">

	<script src="js/modernizr-2.6.2.min.js"></script>	
	

	</head>
	
	
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="index.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="index.php">Home</a></li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Register</a>
								<ul class="fh5co-sub-menu">
									<li><a href="registrationRequester.php">Requester</a></li>
									<li><a href="registrationDonor.php">Donor</a></li>
									<li><a href="registrationAuthorizer.php">Authorizer</a></li>
								</ul>
							</li>
							<li><a href="contact.php">Contact</a></li>
							<li><a href="About.php">About</a></li> 
							
							
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<div class="fh5co-hero1">
			<div class="fh5co-overlay1"></div>
			<div class="fh5co-cover1" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-7">
								<div class="tabulation animate-box">

								
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">LOGIN</a>
								      </li>
								      
								   </ul>
								   <form action="" method="POST">
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">User Type:</label>
													<select class="form-control" id="usertype" name="usertype">
														<option value="admin">Admin</option>
														<option value="authorizer">Authorizer</option>
														<option value="donor">Donor</option>
														<option value="requester">Requester</option>
													</select>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">User Name:</label>
													<input type="text" class="form-control" id="username" name="username" required="" />
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Password:</label>
													<input type="password" minlength="8" class="form-control" id="password" name="password" required="" />
												</div>
											</div>
																						
											<div class="col-xxs-12 col-xs-4 mt alternate">
												<input type="submit" class="btn btn-primary1 btn-block" name="submit">
											</div>
											</form>		
										</div>
									 </div>
									</div>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>

		</div>
				
		<footer>
			<div id="footer2">
				<div class="container">
					<div class="row row-bottom-padded-md">
						
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>