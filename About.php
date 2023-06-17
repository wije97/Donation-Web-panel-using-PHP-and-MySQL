<?php
	include_Once('./config.php');

	session_start();

	if(empty($_SESSION)){
		$usertype = "user";
	}else{
		$logtype = $_SESSION["type"];
	  	$nics = $_SESSION["nic"];
	  	$usertype = $_SESSION["usertype"];
	}


?>
<!DOCTYPE html>

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
							<?php if($usertype == "donor") {?> 
								
								<li class="active"><a href="donor/Donor_UI.php">Dashboard</a></li>
								<li><a href="donor/DonorSearchRequests.php">Search Request</a></li>
								<li><a href="donor/DonorConfirmedDonations.php">Confirmed Donations</a></li>
								<li><a href="logout.php">Logout</a></li>
							
							<?php }else if($usertype == "authorizer") {?> 
								
								<li class="active"><a href="authorizer/Authorizer_UI.php">Dashboard</a></li>
								<li><a href="ViewReuest.php">View Requests</a></li>
								<li><a href="GenerateReports.php">Generate Reports</a></li> 
								<li><a href="logout.php">Logout</a></li>

							<?php } else if($usertype == "requester"){?> 
								
								<li class="active"><a href="requester/Requester_UI.php">Dashboard</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="logout.php">Logout</a></li>

							<?php }else{ ?>
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
							<?php }  ?>

						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->
	
		
		<div id="fh5co-contact" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>About Us</h3>
						<h4>We need your financial support.</h4>
						<p>Our extent of the support we provide to victims of stalking is limited by the the amount of funding we receive. A donation from you, no matter how small, can make a significant contribution to our vital work. </p>
					</div>
				</div>
				
					<div class="row animate-box">
						<div class="col-md-6">
							<h3 class="section-title">Ways You Can Donate</h3>
							<p>In the past 12 months, we have provided support to over 500 stalking victims and their families. Your donation makes a real difference in the lives of stalking victims, their friends, and families who can all be affected by this crime. Your generosity will support our wide-ranging work which provides both emotional and practical support to victims of stalking and continue our campaigning. </p>
							<ul class="contact-info">
								<li><i class="icon-dribbble2"></i>Donate Online</li>
								<li><i class="icon-dribbble2"></i>Donate by Text</li>
							</ul>
						</div>
						<div class="col-md-6">
							<h3 class="section-title">Our Address</h3>
							<p>We’d love to hear from you! Send us your questions or comments and someone from our team will be in touch shortly.</p>
							<ul class="contact-info">
								<li><i class="icon-location-pin"></i>198 West 21th Street, Ragama, Srilanaka</li>
								<li><i class="icon-phone2"></i>+ 9775 2355 98</li>
								<li><i class="icon-mail"></i><a href="#">info@yoursite.com</a></li>
								<li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
							</ul>
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

