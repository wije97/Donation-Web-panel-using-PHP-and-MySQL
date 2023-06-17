<?php
	include_Once('../config.php');

	session_start();

	if(empty($_SESSION)){
		$usertype = "user";
	}else{
		$logtype = $_SESSION["type"];
	  	$nics = $_SESSION["nic"];
	  	$usertype = $_SESSION["usertype"];
	}

	if($usertype == "user"){
		echo '<script>document.location.href="../index.php";</script>';
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
								<li><a href="DonorSearchRequests.php">Search Request</a></li>
								<li><a href="DonorConfirmedDonations.php">Confirmed Donations</a></li>
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

							<?php } ?>

						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->
	

		<div id="fh5co-contact" class="fh5co-section-gray">
			<div class="container">
				<div class="row animate-box" >

					<?php

						$sql = "SELECT * FROM tblrequest WHERE status = 'Approved'";
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){
								while ($row = $result->fetch_assoc()) {
									echo '<div class="col-md-6">
											<div class="row">
												<div style="background-color:#fadab1; width: 95%; height: 340px; padding: 20px;  float:left;">
													<div class="col-md-12">
														<div class="form-group">
															<label class="form-control" ><a href="#" id="' . $row["Request_ID"] . '" onclick="passData(this.id)">' . $row["menreq"] . '</a>
															</label>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<textarea name="" class="form-control" id="" cols="20" rows="5" maxlength = "50" wrap="hard" placeholder="Req details" readonly="">' . $row["exreq"] . '</textarea>
														</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group">
															<label type="text" class="form-control"><a>' . $row["fullname"] . '</a></label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label type="text" class="form-control"><a>' . $row["lastday"] . '</a></label>
														</div>
													</div>
												</div>
											</div>
											<br>
										</div>';
								}
							}else {
								echo "<br><h3 align='center'>No Requests</h3>";
								echo "</br></br></br></br></br></br></br>";
							}
						}	
					?>
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

	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.easing.1.3.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.waypoints.min.js"></script>
	<script src="../js/sticky.js"></script>
	<script src="../js/jquery.stellar.min.js"></script>
	<script src="../js/hoverIntent.js"></script>
	<script src="../js/superfish.js"></script>
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<script src="../js/bootstrap-datepicker.min.js"></script>
	<script src="../js/classie.js"></script>
	<script src="../js/selectFx.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="../js/google_map.js"></script>
	<script src="../js/main.js"></script>

	</body>

	<script type="text/javascript">
		function passData(clicked_id){

			document.cookie='Req_ID='+clicked_id; 
			document.location.href='DonationView.php';
		}
	</script>

</html>

