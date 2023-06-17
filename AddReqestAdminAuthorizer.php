<?php
	include_Once('./config.php');

	session_start();
	$logtype = $_SESSION["type"];
  	$nics = $_SESSION["nic"];
  	$usertype = $_SESSION["usertype"];

	if(isset($_POST['submit'])){

		//requester details form
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$telephone = $_POST['telephone'];
		$age = $_POST['age'];
		$gender = $_POST['gender'];
		$nic = $_POST['nic'];
		$address = $_POST['address'];
		$username = $_POST['uname'];
		$password = $_POST['psw'];
		$Cpassword = $_POST['cpsw'];
		$occupation = $_POST['occupation'];

		if($password != $Cpassword){
			//$errpw = "Password Not Matched !";
			echo '<script>alert("Password Not Matched !")</script>';
		}
		else{
			

			$insert_req_details="INSERT INTO `tblrequester` (nic,fname,lname,gender,age,occupation,telephone,email,address,username,password) VALUES ('$nic','$fname','$lname','$gender','$age','$occupation','$telephone','$email','$address','$username','$password')";

			$query = mysqli_query($con, $insert_req_details) or die(mysqli_error($con));
			if($query == 1){		

				//request details form
				$menreq = $_POST['menreq'];
				$exreq = $_POST['exreq'];
				$catogery = $_POST['catogery'];
				$lastday = $_POST['lastday'];

				$file=$_FILES["myfile"]["name"];
				$tmp_name=$_FILES["myfile"]["tmp_name"];
				$path="upload/".$file;
				$file1=explode(".",$file);
				$ext=$file1[1];
				$allowed=array("jpg","png","gif","pdf","wmv","pdf","zip");

				$fullname = $fname . " " . $lname;
		
				if(in_array($ext,$allowed)){

					move_uploaded_file($tmp_name,$path);
					$query = mysqli_query($con,"insert into tblrequest(nic,fullname,menreq,exreq,category,lastday,file,status)values('$nic','$fullname','$menreq','$exreq','$catogery','$lastday','$file','Approved')");
					if($query == 1){		
							echo '<script>alert("Request Saved!")</script>';

					}
					else{
						echo '<script>alert("Registration Unsuccessful..! !")</script>';
					}

				}
				
			}
			else{
				echo '<script>alert("Registration Unsuccessf...!")</script>';
			}

	        mysqli_close($con);

		}
			
	}


?>



<!DOCTYPE html>

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
								
								<li class="active"><a href="authorizer/Authorizer_UI.php">Dashboard</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li><a href="logout.php">Logout</a></li>

							<?php }  ?>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->

		<div id="fh5co-contact" class="fh5co-section-gray">
			<div class="container">
				<br>
				<form action="#" method="POST" enctype="multipart/form-data">
					<div class="row animate-box">
						<div class="col-md-6">
							<div class="tabulation animate-box" style="width: 550px;">
								<ul class="nav nav-tabs" role="tablist">
							      <li role="presentation" class="active">
							      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Register Requester </a>
							      </li>
							    </ul>
							    <br>
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
										<label for="date-end">Occupation:</label>
										<input type="text" class="form-control" name="occupation"/>
									</div>
								</div>
								<div class="col-xxs-12 col-xs-6 mt alternate">
									<div class="input-field">
										<label for="date-end">Telephone:</label>
										<input type="text" class="form-control" name="telephone" minlength="10" oninvalid="setCustomValidity('Please enter correct Mobile Number.')" oninput="setCustomValidity('')" maxlength="10" required/>
									</div>
								</div>
								<div class="col-xxs-12 col-xs-6 mt alternate">
									<div class="input-field">
										<label for="date-end">Email:</label>
										<input type="text" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$" oninvalid="setCustomValidity('Please enter correct email address.')" oninput="setCustomValidity('')" class="form-control" id="email" name="email" />
										<label id="error_email" style="color: red;"></label>
									</div>
								</div>
								<div class="col-xxs-12 col-xs-12 mt">
									<div class="input-field">
										<label for="from">Address:</label>
										<input type="text" class="form-control" name="address" required/>
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
							</div>
						</div>

						
						<div class="col-md-6">
							<div class="row">
								<div class="tabulation animate-box"style="width: 550px;">
									<ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Request Details</a>
								      </li>
								    </ul>
								    <br>
								
									<div class="col-xxs-12 col-xs-12 mt">
										<div class="input-field">
											<label for="from">Category:</label>
											<select class="form-control" id="catogery" name="catogery">
												<option>Health & Medical</option>
												<option>Education</option>
												<option>Human Services</option>
												<option>Animal & Humane</option>
												<option>Disaster Relief</option>
										    </select>
											
										</div>
									</div>
									<div class="col-xxs-12 col-xs-12 mt">
										<div class="input-field">
											<label for="from">Mention The Requirement:</label>
											<input type="text" class="form-control" id="menreq" name="menreq" required/>
										</div>
									</div>
									<div class="col-xxs-12 col-xs-12 mt">
										<div class="input-field">
											<label for="from">Explain Your Requirement:</label>
											<textarea type="text" id="exreq" name="exreq" class="form-control" cols="30" rows="5" required></textarea>
										</div>
									</div>
									<div class="col-xxs-12 col-xs-12 mt">
										<div class="input-field">
											<label for="from">When Is The Last Day You Need Money?:</label>
											<input type="date" class="form-control" id="lastday" name="lastday" min="<?= date('Y-m-d'); ?>" required/>
										</div>
									</div>
									<div class="col-xxs-12 col-xs-12 mt">
										
										<div class="input-field">
										 <label class="input-group-text" for="inputGroupFile02">Proof Documents ( Upload as a PDF)</label>
										 <input type="file" class="form-control"  name="myfile" required="">
										  
										</div>
									</div>
									<div class="col-xxs-12 col-xs-12 mt alternate">
										<input type="submit" class="btn btn-primary btn-block" name ="submit">
									</div>
									<div class="col-xxs-12 col-xs-12 mt alternate">
										<input type="submit" class="btn btn-primary1 btn-block" value="BACK">
									</div>
								</div>

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- END map -->

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
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

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
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>

