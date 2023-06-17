<?php
	include_Once('../config.php');

	session_start();
	$donor_id = $_SESSION['nic'];

?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA </title>

	
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
							<li class="active"><a href="Donor_UI.php">Dashboard</a></li>
							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../About.php">About</a></li> 
							<li><a href="../logout.php">Logout</a></li>
							
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

<div  class="fh5co-section-gray"><br>
	<?php
	
		$sql = "SELECT  tblrequest.menreq,  tblrequest.category, tblrequest.fullname, tblrequest.file, tblrequester.telephone, tblrequester.address, tbldonation.Details, tbldonation.Confirmed_Date FROM tblrequest INNER JOIN tblrequester ON tblrequest.nic = tblrequester.nic INNER JOIN tbldonation ON tblrequest.Request_ID = tbldonation.Req_ID WHERE Donor_ID = '$donor_id' ";

		if ($result = mysqli_query($con,$sql)) {
			if(mysqli_num_rows($result)>0){

				echo '<div class="fh5co-hero">
						<table class="table"><caption><h3 align="center"><b>Confirmed Donations</b></h3></caption>
							  <thead>
								<tr>
								  <th scope="col"></th>
								  <th scope="col">Request Title</th>
								  <th scope="col">Category</th>
								  <th scope="col">Requester Name</th>
								  <th scope="col">Telephone</th>
								  <th scope="col">Address</th>
								  <th scope="col">Attachment</th>
								  <th scope="col">Donation Details</th>
								  <th scope="col">Donated Date</th>
							</tr></thead><tbody>';
				while ($row = $result->fetch_assoc()) {
					$req = $row["menreq"];
					$category = $row["category"];
					$attachment = $row["file"];

					$fullname = $row['fullname'];
					$telephone = $row['telephone'];
					$address = $row['address'];

					$details = $row['Details'];
					$con_date = $row['Confirmed_Date'];

					echo '<tr class="danger">
					<td> </td>  
			        <td>'.$req.'</td> 
			        <td>'.$category.'</td>
			        <td>'.$fullname.'</td> 
			        <td>'.$telephone.'</td>
			        <td>'.$address.'</td>
			        <td><a href="../upload/'.$attachment.'">'.$attachment.'</a></td>
			        <td>'.$details.'</td>
			        <td>'.$con_date.'</td>
			      </tr>';
				}
			}
			else{
				echo "</br><h3 align='center'>No Confirmed Donations</h3>";
				echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
			}
					
		}
		echo '</tbody></table></div>';
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

