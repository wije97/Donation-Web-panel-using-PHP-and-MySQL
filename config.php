
<?php
// Opens a connection to a MySQL server.
$con=mysqli_connect ("localhost", 'root', '','dbdonate');
if (!$con) {
		die('Not connected : ' . mysqli_connect_error());
}

?>