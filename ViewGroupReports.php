<?php
	include_Once('./config.php');

	session_start();
	$req_nic = $_SESSION['nic'];
	$usertype = $_SESSION['usertype'];
	$group = $_SESSION['group'];
	$group_id = $_SESSION['group_id'];

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
					<h1 id="fh5co-logo"><a href="donor/DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<?php if($usertype == "admin") {?> 
								
								<li class="active"><a href="admin/Admin_UI.php">Dashboard</a></li>
								<li><a href="admin/AdminManageUser.php">Manage Users</a></li>
								<li><a href="GenerateReports.php">Generate Reports</a></li>
								<li><a href="logout.php">Logout</a></li>
							
							<?php }else {?> 
								
								<li class="active"><a href="authorizer/Authorizer_UI.php">Dashboard</a></li>
								<li><a href="GenerateReports.php">Generate Reports</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li><a href="logout.php">Logout</a></li>

							<?php }  ?>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>
	<div class="fh5co-section-gray"><br>
	<?php

		if ($group == "requester_grp") {


			echo '<div class="fh5co-hero">
				<table class="table" id="result_tbl"><caption><h3 align="center"><b>Generate Reports</b></h3></caption>
					  <thead>
						<tr>
						  <th scope="col"></th>
						  <th scope="col">Name</th>
						  <th scope="col">Telephone</th>
						  <th scope="col">Address</th>
						  <th scope="col">Request Category</th>
						  <th scope="col">Title</th>
						  <th scope="col">Details</th>
						  <th scope="col">End Date</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>';

					$sql = "SELECT  tblrequester.*, tblrequest.* FROM tblrequester INNER JOIN tblrequest ON tblrequester.nic = tblrequest.nic WHERE tblrequest.nic = '$group_id' AND Status='Approved'";

					if ($result = mysqli_query($con,$sql)) {
						while ($row = $result->fetch_assoc()) {
							
							$fullname = $row["fullname"];
							$telephone = $row["telephone"];
							$address = $row["address"];
							$category = $row["category"];
							$title = $row["menreq"];
							$details = $row["exreq"];
							$lastday = $row["lastday"];

							echo '<tr class="danger">
							<td> </td>
							<td>'.$fullname.'</td>
					        <td>'.$telephone.'</td> 
					        <td>'.$address.'</td>
							<td>'.$category.'</td>
					        <td>'.$title.'</td> 
					        <td>'.$details.'</td>
					        <td>'.$lastday.'</td>
					        <td> </td>
					      </tr>';
						}
						
					}
			echo '</tbody></table></div>';
		}
		else if ($group == "donor_grp") {

			echo '<div class="fh5co-hero">
				<table class="table" id="result_tbl"><caption><h3 align="center"><b>Generate Reports</b></h3></caption>
			  <thead>
				<tr>
				  <th scope="col"></th>
				  <th scope="col">Requster Name</th>
				  <th scope="col">Request Title</th>
				  <th scope="col">Request Category</th>
				  <th scope="col">Donor Name</th>
				  <th scope="col">Telephone</th>
				  <th scope="col">Donation Details</th>
				  <th scope="col">Donated Date</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>';

			//$sql = "SELECT tblrequest.*, tbldonation.*, tbldonor.* FROM tblrequest INNER JOIN tbldonation ON tblrequest.Request_ID = tbldonation.Req_ID INNER JOIN tbldonor ON tbldonation.Donor_ID = tbldonor.nic WHERE tbldonation.Req_ID = '$group_id' ";

			 $sql = "SELECT tblrequest.*, tbldonation.*, tbldonor.* FROM tblrequest INNER JOIN tbldonation ON tblrequest.Request_ID = tbldonation.Req_ID INNER JOIN tbldonor ON tbldonation.Donor_ID = tbldonor.nic WHERE tbldonation.Req_ID = '$group_id' ";

			if ($result = mysqli_query($con,$sql)) {
				while ($row = $result->fetch_assoc()) {
					
					$requester_name = $row['fullname'];
					$req_title = $row['menreq'];
					$category = $row['category'];
					$donor_fname = $row['fname'];
					$donor_lname = $row['lname'];
					$telephone = $row['telephone'];
					$donation_details = $row['Details'];
					$confirmed_date = $row['Confirmed_Date'];

					echo '<tr class="danger">
					<td> </td>
			        <td>'.$requester_name.'</td>
			        <td>'.$req_title.'</td>
			        <td>'.$category.'</td> 
			        <td>'.$donor_fname. " " . $donor_lname .' </td>
			        <td>'.$telephone.'</td> 
			        <td>'.$donation_details.'</td> 
			        <td>'.$confirmed_date.'</td>
			        <td></td>
			      </tr>';
				}
			
			}
						
			echo '</tbody></table></div>';
		}
		
	?>
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

