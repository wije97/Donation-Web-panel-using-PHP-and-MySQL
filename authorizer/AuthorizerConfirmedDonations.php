<?php
	include_Once('../config.php');
	session_start();
?>

<!DOCTYPE html>

<html class="no-js"> 
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
					<h1 id="fh5co-logo"><a href="../donor/DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="Authorizer_UI.php">Dashboard</a></li>
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
		
			$sql = "SELECT tblrequest.*, tbldonation.*, COUNT(tbldonation.Req_ID) AS count, tbldonor.* FROM tblrequest INNER JOIN tbldonation ON tblrequest.Request_ID = tbldonation.Req_ID INNER JOIN tbldonor ON tbldonation.Donor_ID = tbldonor.nic GROUP By tbldonation.Req_ID ";

			if ($result = mysqli_query($con,$sql)) {
				if(mysqli_num_rows($result)>0){
					echo '<div class="fh5co-hero">
							<table class="table" id="result_tbl"><caption><h3 align="center"><b>View Donations</b></h3></caption>
								  <thead>
									<tr>
									  <th scope="col"></th>
									  <th scope="col">Request ID</th>
									  <th scope="col">Requster Name</th>
									  <th scope="col">Request Title</th>
									  <th scope="col">Request Category</th>
									  <th scope="col">Donation Count</th>
									  <th></th>
									</tr>
								  </thead>
								  <tbody>';
					while ($row = $result->fetch_assoc()) {

						$requester_name = $row['fullname'];
						$req_title = $row["menreq"];
						$category = $row["category"];
						$request_id = $row["Req_ID"];
						$donation_count = $row["count"];

						echo '<tr class="danger">
						<td> </td>  
						<td>'.$request_id.'</td>
						<td>'.$requester_name.'</td>
				        <td>'.$req_title.'</td>
				        <td>'.$category.'</td> 
				        <td>'.$donation_count.'</td>
				        <td><form method="POST" action="#"><input type="submit"  name="don_group" class="btn btn-warning" value="View"><input type="hidden" name="hidd" value="'.$request_id.'"></form></td>
				      </tr>';
					}
				}else{
					echo "<h3 align='center'>No Donations to View</h3>";
					echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
				}
			}
				
			echo '</tbody></table></div>';
			

			if (isset($_POST['don_group'])) {

				$_SESSION['group'] = "donor_grp";
				$_SESSION['group_id'] = $_POST['hidd'];
				header("Location:../requester/ViewGroupDonations.php");
				
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

