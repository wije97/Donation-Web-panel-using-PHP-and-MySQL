<?php
	include_Once('./config.php');
	$errpw = "";

	session_start();

	if(empty($_SESSION)){
		$usertype = "user";
	}else{
		$logtype = $_SESSION["type"];
	  	$nics = $_SESSION["nic"];
	  	$usertype = $_SESSION["usertype"];
	}

if(isset($_POST['submit'])){

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$telephone_mobile = $_POST['telephone_mobile'];
	$telephone_home = $_POST['telephone_home'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$nic = $_POST['nic'];
	$address_residential = $_POST['address_residential'];
	$address_official = $_POST['address_official'];
	$username = $_POST['uname'];
	$password = $_POST['psw'];
	$Cpassword = $_POST['cpsw'];
	$occupation = $_POST['occupation'];

	if($password != $Cpassword){
		//$errpw = "Password Not Matched !";
		echo '<script>alert("Password Not Matched !")</script>';
	}
	else{
		

		$insert1="INSERT INTO `tblauthorizer` (nic, fname, lname, gender, age,  email, telephone_mobile, telephone_home, occupation, address_residential, address_official, username,password, Status) VALUES ('$nic','$fname','$lname','$gender','$age','$email','$telephone_mobile', '$telephone_home', '$occupation','$address_residential','$address_official','$username','$password', 'Pending')";

		$query = mysqli_query($con, $insert1) or die(mysqli_error($con));
		if($query == 1){		
				echo '<script>alert("Registration Successful !")</script>';
		}
		else{
			echo '<script>alert("Registration Unsuccessful !")</script>';
		}

        mysqli_close($con);

	}

}

?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA</title>
	
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	
	<!-- CS Select -->
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">
	
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	</head>
	
	
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="donor/DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">

							<?php if($usertype == "admin") {?> 
								
								<li class="active"><a href="admin/Admin_UI.php">Dashboard</a></li>
								<li><a href="admin/AdminManageUser.php">Manage Users</a></li>
								<li><a href="logout.php">Logout</a></li>
							
							<?php }else {?> 
								
								<li class="active"><a href="index.php">Home</a></li>
								<li>
									<a href="#" class="fh5co-sub-ddown">Register</a>
									<ul class="fh5co-sub-menu">
										<li><a href="registrationRequester.php">Requester</a></li>
										<li><a href="registrationDonor.php">Donor</a></li>
										<li><a href="registrationAuthorizer.php">Authorizer</a></li>
									</ul>
								</li>
								<li><a href="login.php">Login</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 

							<?php }  ?>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		
	
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-7">
								<div class="tabulation animate-box">

									<form action="" method="POST">
								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Authorizer Registration</a>
								      </li>
								      
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">First Name:</label>
													<input type="text" class="form-control" name="fname" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Last Name:</label>
													<input type="text" class="form-control" name="lname" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Gender:</label>
													<div>
													<input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
													<label class="form-check-label" >
														Male &nbsp;&nbsp;&nbsp;
													</label>
													
													<input class="form-check-input" type="radio" name="gender" id="female" value="female">
													<label class="form-check-label">
														Female
													</label>
													</div>
												</div>
											</div>	
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">NIC:</label>
													<input type="text" class="form-control" name="nic" maxlength="10" minlength="10" oninvalid="setCustomValidity('Please enter correct NIC Number.')" oninput="setCustomValidity('')" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Age:</label>
													<input type="text" class="form-control" name="age" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Email:</label>
													<input type="text" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$" oninvalid="setCustomValidity('Please enter correct email address.')" oninput="setCustomValidity('')"  class="form-control" name="email" id="email" required />
													<label id="error_email" style="color: red;"></label>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Telephone (Mobile):</label>
													<input type="text" class="form-control" name="telephone_mobile" required maxlength="10" minlength="10" oninvalid="setCustomValidity('Please enter correct Mobile Number.')" oninput="setCustomValidity('')"/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Telephone (Home):</label>
													<input type="text" class="form-control" name="telephone_home" required required maxlength="10" minlength="10" oninvalid="setCustomValidity('Please enter correct Phone Number.')" oninput="setCustomValidity('')"/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="date-end">Occupation:</label>
													<input type="text" class="form-control" name="occupation"/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Residential Address:</label>
													<input type="text" class="form-control" name="address_residential" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Official Address:</label>
													<input type="text" class="form-control" name="address_official" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">User Name:</label>
													<input type="text" class="form-control" name="uname" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Password:</label>
													<input type="password" class="form-control" minlength="8" name="psw" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Confirm Password:</label>
													<input type="password" class="form-control" minlength="8" name="cpsw" required/>
												</div>
											</div>
											
											
											
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<input type="submit" class="btn btn-primary btn-block" name ="submit" value="Create Account">
											</div>
										</div>
									 </div>

									</div>
								</form>

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


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>

