<?php
	include('./config.php');
	session_start();
	$logtype = $_SESSION["type"];
  	$usertype = $_SESSION["usertype"];


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
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	

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

		<div class="fh5co-section-gray"><br>
		<table class="table" ><caption><h3 align="center"><b>Generate Reports</b></h3></caption>
			<tr>
			    <form method="POST">
				  <th >
				  	<div class="col-xxs-12 col-xs-12 mt">
						<div class="input-field">
							<select class="form-control" id="type" name="type" onchange="setVal()">
								<option>All Requests</option>
								<option value="Requests by Category">Requests by Category</option>
								<option>Group by Requesters</option>
								<option>All Donations</option>
								<option>Group by Donations</option>
						    </select>
						</div>
					</div>
				  </th>

				  <th>
				  	<div class="col-xxs-12 col-xs-12 mt">
						<div class="input-field">
							<select class="form-control" id="category" name="category" disabled="">
								
						    </select>
						</div>
					</div>
				  </th>
				  
				  <th><button type="submit" name="sby_category" class="btn btn-info">Search</button></th>
				  <th> </th>
			    </form>
			</tr>
		</table>

		<script type="text/javascript">
			
            $(document).ready(function () {
			    $("#type").change(function () {
			        var val = $(this).val();

			        if (val == "Requests by Category") {
			        	document.getElementById("category").disabled = false;
			            $("#category").html("<option>Health & Medical</option><option>Education</option><option>Human Services</option><option>Animal & Humane</option><option>Disaster Relief</option>");
			        }
			    });
			});

        </script>

		<?php
			if (isset($_POST['sby_category'])) {
				
				$search_type = $_POST['type'];

				switch ($search_type) {
					case 'All Requests':
						echo searchRequest("tblrequest", "tblrequester", " WHERE status = 'Approved'");
						break;
					case 'Requests by Category':
						$search_category = $_POST['category'];
						echo searchRequest("tblrequest", "tblrequester", "WHERE category = '$search_category' AND status = 'Approved'");
						break;
					case 'Group by Requesters':
						echo searchRequestGroups("tblrequest", "tblrequester", "WHERE status = 'Approved' GROUP By tblrequest.nic");
						break;
					case 'All Donations':
						echo searchDonation("tblrequest", "tbldonation", "tbldonor", "");
						break;
					case 'Group by Donations':
						echo searchDonationGroup("tblrequest", "tbldonation", "tbldonor", "GROUP By tbldonation.Req_ID");
						break;
					
					default:
						// code...
						break;
				}
				

			}else {
				
				echo "<h3 align='center'>Please Select Report Type</h3>";
				echo "</br></br></br></br></br></br></br></br></br></br></br>";
			}

			function searchRequest($table1, $table2, $query){

				include('./config.php');

				

					$sql = "SELECT $table1.*, $table2.* FROM $table1 INNER JOIN $table2 ON $table1.nic = $table2.nic $query";

					//$sql = "SELECT tblrequest.*, tblrequester.* FROM tblrequest INNER JOIN tblrequester ON tblrequest.nic = tblrequester.nic WHERE $column = '$value' ";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo '<div class="fh5co-hero">
								<table class="table" id="result_tbl">
									  <thead>
										<tr>
										  <th scope="col"></th>
										  <th scope="col">Name</th>
										  <th scope="col">NIC</th>
										  <th scope="col">Telephone</th>
										  <th scope="col">Request Category</th>
										  <th scope="col">Title</th>
										  <th scope="col">Details</th>
										  <th scope="col">Ending Date</th>
										  <th></th>
										</tr>
									  </thead>
									  <tbody>';
							while ($row = $result->fetch_assoc()) {
								
								$fullname = $row['fullname'];
								$req_nic = $row["nic"];
								$telephone = $row["telephone"];
								$category = $row["category"];
								$req_title = $row["menreq"];
								$req_details = $row["exreq"];
								$end_date = $row['lastday'];

								echo '<tr class="danger">
								<td> </td>  
						        <td>'.$fullname.'</td>
						        <td>'.$req_nic.'</td>
						        <td>'.$telephone.'</td> 
						        <td>'.$category.'</td>
						        <td>'.$req_title.'</td> 
						        <td>'.$req_details.'</td>
						        <td>'.$end_date.'</td>
						        <td></td>
						      </tr>';
							}
						}else{
							echo "<br><h3 align='center'>No Data</h3>";
							echo "</br></br></br></br></br></br></br></br></br>";
						}
					}
						
				echo '</tbody></table></div>';
			}

			function searchRequestGroups($table1, $table2, $query){

				include('./config.php');

					$sql = "SELECT Count($table1.nic) AS count, $table1.*, $table2.* FROM $table1 INNER JOIN $table2 ON $table1.nic = $table2.nic $query";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo '<div class="fh5co-hero">
							<table class="table" id="result_tbl">
								  <thead>
									<tr>
									  <th scope="col"></th>
									  <th scope="col">Name</th>
									  <th scope="col">NIC</th>
									  <th scope="col">Telephone</th>
									  <th scope="col">Request Count</th>
									  <th></th>
									</tr>
								  </thead>
								  <tbody>';

							while ($row = $result->fetch_assoc()) {
								
								$fullname = $row['fullname'];
								$req_nic = $row["nic"];
								$telephone = $row["telephone"];
								$count = $row["count"];

								echo '<tr class="danger">
								<td> </td>
								<td>'.$fullname.'</td>
								<td>'.$req_nic.'</td>
						        <td>'.$telephone.'</td> 
						        <td>'.$count.'</td>
						        <td><form method="POST" action="#"><input type="submit" name="req_group" class="btn btn-warning" value="View"><input type="hidden" name="hid" value="'.$req_nic.'"></form></td>
						      </tr>';
							}
						}else{
							echo "<br><h3 align='center'>No Data</h3>";
							echo "</br></br></br></br></br></br></br></br></br>";
						}
					}
						
				echo '</tbody></table></div>';
			}

			function searchDonation($table1, $table2, $table3, $query){

				include('./config.php');

				
					$sql = "SELECT $table1.*, $table2.*, $table3.* FROM $table1 INNER JOIN $table2 ON $table1.Request_ID = $table2.Req_ID INNER JOIN $table3 ON $table2.Donor_ID = $table3.nic $query";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo '<div class="fh5co-hero">
								<table class="table" id="result_tbl">
									  <thead>
										<tr>
										  <th scope="col"></th>
										  <th scope="col">Requster Name</th>
										  <th scope="col">Request Title</th>
										  <th scope="col">Request Category</th>
										  <th scope="col">Donor Name</th>
										  <th scope="col">Donation Details</th>
										  <th scope="col">Donated Date</th>
										  <th></th>
										</tr>
									  </thead>
									  <tbody>';

							while ($row = $result->fetch_assoc()) {
								
								$requester_name = $row['fullname'];
								$req_title = $row["menreq"];
								$category = $row["category"];
								$donor_fname = $row["fname"];
								$donor_lname = $row["lname"];
								$donation_details = $row['Details'];
								$confirmed_date = $row['Confirmed_Date'];

								echo '<tr class="danger">
								<td> </td>  
						        <td>'.$requester_name.'</td>
						        <td>'.$req_title.'</td>
						        <td>'.$category.'</td> 
						        <td>'.$donor_fname. " " . $donor_lname .' </td>
						        <td>'.$donation_details.'</td> 
						        <td>'.$confirmed_date.'</td>
						        <td></td>
						      </tr>';
							}
						}else{
							echo "<br><h3 align='center'>No Data</h3>";
							echo "</br></br></br></br></br></br></br></br></br>";
						}
					}
						
				echo '</tbody></table></div>';
			}

			function searchDonationGroup($table1, $table2, $table3, $query){

				include('./config.php');


					$sql = "SELECT $table1.*, $table2.*, COUNT($table2.Req_ID) AS count, $table3.* FROM $table1 INNER JOIN $table2 ON $table1.Request_ID = $table2.Req_ID INNER JOIN $table3 ON $table2.Donor_ID = $table3.nic $query ";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){


							echo '<div class="fh5co-hero">
							<table class="table" id="result_tbl">
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
							echo "<br><h3 align='center'>No Data</h3>";
							echo "</br></br></br></br></br></br></br></br></br>";

						}
					}
						
				echo '</tbody></table></div>';
			}

			if (isset($_POST['req_group'])) {

				$_SESSION['group'] = "requester_grp";
				$_SESSION['group_id'] = $_POST['hid'];
				header("Location:../DonateWebProjectPHP/ViewGroupReports.php");
				
			}

			if (isset($_POST['don_group'])) {

				$_SESSION['group'] = "donor_grp";
				$_SESSION['group_id'] = $_POST['hidd'];
				header("Location:../DonateWebProjectPHP/ViewGroupReports.php");
				
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

