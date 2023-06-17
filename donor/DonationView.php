<?php
	include_Once('../config.php');

	session_start();
	$donor_id = $_SESSION['nic'];
	$logtype = $_SESSION["type"];
	$usertype = $_SESSION["usertype"];
	$request_id = $_COOKIE["Req_ID"]; 

	if(isset($request_id)){

		$sql = "SELECT tblrequest.fullname, tblrequest.menreq, tblrequest.exreq, tblrequest.category, tblrequest.lastday, tblrequest.file, tblrequester.telephone, tblrequester.email, tblrequester.address FROM tblrequest INNER JOIN tblrequester ON tblrequest.nic = tblrequester.nic WHERE Request_ID = '$request_id' ";

		if ($result = mysqli_query($con,$sql)) {
			while ($row = $result->fetch_assoc()){

				$req_title = $row["menreq"];
				$req_details = $row["exreq"];
				$req_cat = $row["category"];
				$req_date = $row["lastday"];
				$attachment = $row["file"];

				$full_name = $row["fullname"];
				$telephone = $row["telephone"];
				$email = $row["email"];
				$address = $row["address"];
			}
		}
	}


	if(isset($_POST['submit'])){

		$sql = "SELECT nic FROM tblrequest WHERE Request_ID = '$request_id' ";
		$result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $requester_id = $row['nic'];

		$donation_details = $_POST['Donate_details'];
		
		$con_date =date('Y-m-d');

		$insert="INSERT INTO `tblDonation` (Req_ID, Requester_ID, Details, Donor_ID, Confirmed_Date) VALUES ( '$request_id', '$requester_id', '$donation_details', '$donor_id', '$con_date')";

		$query = mysqli_query($con, $insert) or die(mysqli_error($con));
		if($query == 1){
				echo '<script>alert("Donation Successful !")</script>';
		}
		else{
			echo '<script>alert("Donation Unsuccessful !")</script>';
		}

        mysqli_close($con);
	}
?>



<!DOCTYPE html>

	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA</title>
	
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="../css/animate.css">

	<link rel="stylesheet" href="../css/icomoon.css">

	<link rel="stylesheet" href="../css/bootstrap.css">
	
	<link rel="stylesheet" href="../css/superfish.css">
	
	<link rel="stylesheet" href="../css/magnific-popup.css">
	
	<link rel="stylesheet" href="../css/bootstrap-datepicker.min.css">

	<link rel="stylesheet" href="../css/cs-select.css">
	<link rel="stylesheet" href="../css/cs-skin-border.css">
	
	<link rel="stylesheet" href="../css/style.css">

	<script src="../js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">

							<?php if($usertype == "donor") {?> 
								
								<li class="active"><a href="Donor_UI.php">Dashboard</a></li>
							<li><a href="#" class="fh5co-sub-ddown">Donations</a>
								<ul class="fh5co-sub-menu">
									<li><a href="DonorrequestView.php">View Requests</a></li>
									<li><a href="DonorConfirmedDonations.php">Confirmed Donations</a></li>
								</ul>
							</li>
							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../About.php">About</a></li> 
							<li><a href="../logout.php">Logout</a></li>
							
							<?php }else if($usertype == "authorizer") {?> 
								
								<li class="active"><a href="../authorizer/Authorizer_UI.php">Dashboard</a></li>
								<li><a href="../ViewReuest.php">View Requests</a></li>
								<li><a href="../GenerateReports.php">Generate Reports</a></li> 
								<li><a href="../logout.php">Logout</a></li>

							<?php } else if($usertype == "requester"){?> 
								
								<li class="active"><a href="../requester/Requester_UI.php">Dashboard</a></li>
								<li class="active"><a href="../requester/requestForm.php">Add Request</a></li>
								<li><a href="../ViewReuest.php">View Requests</a></li>
								<li><a href="../About.php">About</a></li> 
								<li><a href="../logout.php">Logout</a></li>

							<?php }else if($usertype == "admin"){ ?>

								<li class="active"><a href="../admin/Admin_UI.php">Dashboard</a></li>
								<li><a href="../admin/AdminManageUser.php">Manage Users</a></li>
								<li><a href="../logout.php">Logout</a></li>

							<?php }  ?>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->
	
		<div id="fh5co-contact" class="fh5co-section-gray">
			<div class="container">
				
				<form action="#" method="POST"  onsubmit="return confirm('Please Confirm Your Donation!');">
					<div class="row animate-box">
						
						<div class="col-md-6">
							<div class="row">
							
							<div class="col-md-12">
							<H4><B>Request Details</B></H4>
							</div>
							
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Title:</label>
										<input type="text" class="form-control" name="Req_Title" id="Req_Title" placeholder="Requester title" value="<?php echo (isset($req_title))?$req_title:'';?>" readonly="" >
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Details:</label>
										<textarea class="form-control" name="Req_Details" id="Req_Details" cols="30" rows="7" placeholder="Req details" readonly="" ><?php echo (isset($req_details))?$req_details:'';?></textarea>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="from">Category:</label>
										<input type="text" class="form-control" name="Req_Cat" id="Req_Cat" placeholder="Category" value="<?php echo (isset($req_cat))?$req_cat:'';?>" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="from">Attachments:</label>
										<button type="button"  style="width:60%" class="btn btn-info" name="download" id="download" onclick="document.getElementById('link').click()">
										<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
										DOWNLOAD</button>
									</div>
									<a  href="file.doc" download hidden></a>
									<?php echo '<a id="link" href="../upload/'.$attachment.'" download hidden></a>' ?>

								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Ending Date:</label>
										<input type="text"  name="Req_Date" id="Req_Date"  class="form-control" placeholder="Date" value="<?php echo (isset($req_date))?$req_date:'';?>" readonly>
									</div>
								</div>

								<?php if($usertype == "donor") {?> 

								<div style="background-color:#fae9cd; width: 95%; height: 250px; padding: 20px;  float:left;">
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="from">What can you Donate:</label>
											
											<textarea class="form-control" name="Donate_details" id="Donate_details" cols="20" rows="3" placeholder="Details" required=""></textarea>
										</div>
									</div>

									<div class="col-md-12">
										
										<button type="submit" name="submit" class="btn btn-warning">DONATE</button>
									</div>
								</div>

								<?php } ?>
								
							</div>
								
						</div>
						
						<div class="col-md-6">
							<div class="row">
							
							<div class="col-md-12">
							<H4><B>Requester's Details</B></H4>
							</div>
							
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Name:</label>
										<input type="text" class="form-control" placeholder="Full name" value="<?php echo (isset($full_name))?$full_name:'';?>" readonly="">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Telephone No:</label>
										<input type="text" class="form-control" placeholder="Telephone" value="<?php echo (isset($telephone))?$telephone:'';?>" readonly="">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Email:</label>
										<input type="text" class="form-control" placeholder="Email" value="<?php echo (isset($email))?$email:'';?>" readonly="">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="from">Address:</label>
										<input type="text" class="form-control" placeholder="Address" value="<?php echo (isset($address))?$address:'';?>" readonly="">
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


	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<script src="../js/sticky.js"></script>

	<!-- Stellar -->
	<script src="../js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="../js/hoverIntent.js"></script>
	<script src="../js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="../js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="../js/classie.js"></script>
	<script src="../js/selectFx.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="../js/google_map.js"></script>
	
	<!-- Main JS -->
	<script src="../js/main.js"></script>

	</body>
</html>

