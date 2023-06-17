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
					<h1 id="fh5co-logo"><a href="../donor/DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="Authorizer_UI.php">Dashboard</a></li>
							<li><a href="#" class="fh5co-sub-ddown">Donations</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../ViewReuest.php">View Requests</a></li>
									<li><a href="AuthorizerConfirmedDonations.php">Confirmed Donations</a></li>
								</ul>
							</li>
							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../About.php">About</a></li> 
							<li><a href="../logout.php">Logout</a></li>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<div  class="fh5co-section-gray"><br>
		<table class="table" style="width: 700px; margin-left: auto; margin-right: auto;"><caption><h3 align="center"><b>Search Donor</b></h3></caption>
			<tr>
				<form method="POST">
				  <th></th>
				  <th> <input style="width: 160px; background: #ffffff; border: none;" type="text" class="form-control" value="Search by NIC:" readonly> </th>
				  <th >
				  	<div class="col-md-12">
						<div class="form-group">
							<input type="text" class="form-control" name="Donor_NIC" id="Donor_NIC" placeholder="Enter Requester's NIC" required="">
						</div>
					</div>				  
				  </th>
				  
				  <th><button type="submit" name="sby_nic" class="btn btn-info">Search</button></th>
				  <th> </th>
			    </form>
			</tr>

		</table>
		
		<?php
			
			if (isset($_POST['sby_nic'])) {
				
				$search_nic = $_POST['Donor_NIC'];
				echo search("SELECT * FROM tbldonor WHERE nic = '$search_nic' ");
			
			}else{
				
				echo search("SELECT * FROM tbldonor");
				
			}

			function search($query){

				include_Once('../config.php');

				
					$sql = $query;

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo '<div class="fh5co-hero">
								<table class="table" id="result_tbl">
									  <thead>
										<tr>
										  <th scope="col"></th>
										  <th scope="col">Full Name</th>
										  <th scope="col">Gender</th>
										  <th scope="col">Age</th>
										  <th scope="col">Telephone</th>
										  <th scope="col">Email</th>
										  <th scope="col">Address</th>
										  <th scope="col">Occupation</th>
										</tr>
									  </thead>
									  <tbody>';
							while ($row = $result->fetch_assoc()) {
								$fname = $row['fname'];
								$lname = $row['lname'];
								$gender = $row["gender"];
								$age = $row["age"];
								$telephone = $row['telephone'];
								$email = $row["email"];
								$address = $row["address"];
								$occupation = $row['occupation'];

								echo '<tr class="danger">
								<td> </td>  
						        <td>'.$fname." ". $lname .'</td>
						        <td>'.$gender.'</td> 
						        <td>'.$age.'</td>
						        <td>'.$telephone.'</td>
						        <td>'.$email.'</td>
						        <td>'.$address.'</td> 
						        <td>'.$occupation.'</td>
						      </tr>';
							}
						}else{
							echo "<br><h3 align='center'>No Donors</h3>";
							echo "<br><br><br><br><br><br><br><br><br>";

						}
					}
					
				echo '</tbody></table></div>';
			}

		?>
	</div>
		<footer>
			<div id="footer2" >
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
</html>

