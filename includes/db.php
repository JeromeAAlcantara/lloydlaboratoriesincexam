<?php
	$conn = mysqli_connect("localhost","root","","exam_db");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	date_default_timezone_set("Asia/Hong_Kong");
?>		
