<?php
require ('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Insurance Renewal System</title>
 	<link rel="icon" type="image/x-icon" href="Images/Titlebar/logo.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="scss/login.scss" rel="stylesheet">
</head>
<body>

<!-- LOGIN START -->
<div class="login-box">
<h2>LOGIN</h2>
<form action="" method="POST">
<div class="user-box">
	<input type="text" name="username" required="">
	<label>Username</label>
</div>
<div class="user-box">
	<input type="password" name="password" required="">
	<label>Password</label>
</div>
<center>
	<button type="submit" name="login" class="btnt">
	<span></span>
	<span></span>
	<span></span>
	<span></span>
	Submit
	</button>
</center>
</form>
</div>
<!-- LOGIN END -->


<!-- FUNCTIONS START-->

	<!-- LOGIN START-->
	<?php
		session_start();
		if(isset($_POST['login']))
		{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		$query = "SELECT * FROM users_tbl WHERE username='$username' and password = '$password'";
		$result = mysqli_query($conn, $query) or die(mysqli_error());
		$rows = mysqli_num_rows($result);

		if($rows==1)
		{
			while($row = mysqli_fetch_array($result))
			{
			$sessionid = $row['id'];
			$sessionfullname = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
			$sessionuserlevel = $row['user_level'];
			}
			$_SESSION['id'] = $sessionid;
			$_SESSION['fullname'] = $sessionfullname;
			$_SESSION['user_level'] = $sessionuserlevel;

			echo "<script>location.href='main.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Login failed!');</script>";
			echo "<script>location.href='login.php'</script>";
		}

		}
	?>
	<!-- LOGIN END-->

<!-- FUNCTIONS END-->

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/login.js"></script>