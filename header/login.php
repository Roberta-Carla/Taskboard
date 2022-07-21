<?php
include "../db_connection.php";
$login_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	$username = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM $database.TeamMembers WHERE email = '$username' and password = '$password'";
	$connection = mysqli_connect($db_hostname, $db_username, $db_password);
	if(!$connection) {
		echo "Database Connection Error...".mysqli_connect_error();
	} else {
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table TeamMembers1: ".mysqli_error($connection);
		}
		$count = mysqli_num_rows($retval);
		echo "count: $count";
		if($count == 1) {
			$user_id = 0;
			while($row = mysqli_fetch_assoc($retval)) {
				$user_id = $row["id"];
			}
			$_SESSION['user_id'] = $user_id;
			mysqli_close($connection);
			// Redirect to Home page
			header("location: http://localhost/taskboard");
		} else {
			$login_err = "The username or password is not correct!";
		}
		if (!$connection)
			mysqli_close($connection);
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="login.css">
	<script type="text/javascript" src="login.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="login-form">
		<form method="post" class="needs-validation" action="" novalidate>
		<h2 class="text-center">Sign in</h2>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="usernamePrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="email" placeholder="Username"
						id="username" aria-describedby="usernamePrepend" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				Please enter a proper email address!
      				</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="passwordPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-lock"></i></span>
        			</div>
					<input type="password" class="form-control" name="password" placeholder="Password"
						aria-describedby="passwordPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The password must contain at least a lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters!
      				</div>
				</div>
			</div>
			<?php
				if(!empty($login_err)) {
					echo "<div style=\"width: 100%; margin-top: .25rem; margin-bottom: .25rem; font-size: 80%; color: #dc3545;\">$login_err</div>";
				}
			?>
			<div class="form-group">
				<button type="submit" class="btn btn-primary login-btn btn-block">Sign in</button>
			</div>
			<div class="clearfix">
				<label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
				<a href="#" class="pull-right">Forgot Password?</a>
			</div>
		</form>
		<p class="text-center text-muted small">Don't have an account? <a href="http://localhost/Taskboard/header/register.php">Sign up here!</a></p>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
