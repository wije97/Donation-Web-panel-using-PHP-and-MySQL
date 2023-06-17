<?php
	include_Once('../config.php');

	session_start();
	$u_nic = $_SESSION['nic'];

	$result = mysqli_query($con, "SELECT fname FROM tblauthorizer WHERE nic= '$u_nic' AND Status='Approved'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 

    if($count == 1){
    	$approvedUser = "Y";
    }else{
    	$approvedUser = "N";
    }

	$sql = "SELECT * FROM tblrequestnotification WHERE Auth_Status ='1'";
	if ($result=mysqli_query($con,$sql)) {
	    $rowcount=mysqli_num_rows($result);
	}else{
		$rowcount=0;
	}

	$sql2 = "SELECT * FROM tblrequest WHERE status ='Pending'";
	if ($result2=mysqli_query($con,$sql2)) {
	    $rowcount2=mysqli_num_rows($result2);
	}else{
		$rowcount2=0;
	}


?>

<!DOCTYPE html>

	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Authorizer</title>

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
					<h1 id="fh5co-logo"><a <?php if($approvedUser == "Y") {?> href="../donor/DonorrequestView.php" <?php } ?>>DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">

							
							<?php if($approvedUser == "Y") { ?>

								<li><a href="../updateinfoAuthorizer.php">Update Profile</a></li>
								<li>
									<a href="#" class="fh5co-sub-ddown">Request</a>
									<ul class="fh5co-sub-menu">
										<li><a href="../AddReqestAdminAuthorizer.php">Create request</a></li>
									</ul>
								</li>
								
								<li><a href="../feedback.php">Feedbacks</a></li>
								<li><a href="../contact.php">Contact</a></li>
								<li><a href="../About.php">About</a></li> 
								<li><a href="../logout.php">Logout</a></li>

							<?php }else { ?>

								<li><a href="../logout.php">Logout</a></li>

							<?php } ?>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>
		
		<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Authorizer</h3>
						<?php if($approvedUser == "Y") {?>
							<p>Sample test Sample test Sample test Sample test Sample test Sample test Sample test Sample test</p>
						<?php }else { ?>
							<p>You have to wait until approved by the Administration. Thank You!</p>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-15.jpg" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>View Requests</h3>
								<a class="btn btn-primary btn-outline" <?php if($approvedUser == "Y") {?> href="../ViewReuest.php" <?php } ?>>See Now<i class="icon-arrow-right22"></i></a>
								
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img <?php if($rowcount2 > 0) {?> src="../images/place-14-red.jpg" <?php }else {?> src="../images/place-14-grey.jpg" <?php }  ?> class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Approve Requests</h3>
								<a class="btn btn-primary btn-outline" <?php if($approvedUser == "Y") {?> href="AuthorizerApproveRequest.php" <?php } ?>>See Now<i class="icon-arrow-right22"></i></a>
								
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img <?php if($rowcount > 0) {?> src="../images/place-17-red.jpg" <?php }else {?> src="../images/place-17-grey.jpg" <?php }  ?> class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Notification</h3>
								<a class="btn btn-primary btn-outline" <?php if($approvedUser == "Y") {?> href="../NotificationRequst.php"<?php } ?>>See Now<i class="icon-arrow-right22"></i></a>
								
							</div>
						</div>
					</div>

				</div>
				
				<div class="row">

					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-16.jpg" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Confirmed donations</h3>
								<a class="btn btn-primary btn-outline" <?php if($approvedUser == "Y") {?> href="AuthorizerConfirmedDonations.php" <?php } ?>>See Now<i class="icon-arrow-right22"></i></a>
								
							</div>
						</div>
					</div>
					
					
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-12.jpg" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>View Donor</h3>
								<a class="btn btn-primary btn-outline" <?php if($approvedUser == "Y") {?> href="AuthorizerViewDonor.php" <?php } ?>>See Now<i class="icon-arrow-right22"></i></a>
								
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-13.jpg" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Generate Reports</h3>
								<a class="btn btn-primary btn-outline" <?php if($approvedUser == "Y") {?> href="../GenerateReports.php" <?php } ?>>See Now<i class="icon-arrow-right22"></i></a>
								
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
		</div>

		
		

		
		

		<br/>
						
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
	<script src="../js/main.js"></script>

	</body>
</html>

