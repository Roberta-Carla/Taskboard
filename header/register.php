<?php
	include "../db_connection.php";
	$register_err = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		session_start();
		$first_name = $_POST['First_Name'];
		$last_name = $_POST['Last_Name'];
		$password = $_POST['Password'];
		$email= $_POST['Email'];
		$skill = $_POST['Skill'];
		$skill_level = $_POST['SkillLevel'];
		$work_hours = $_POST['WorkingHours'];

		$skill_id = 0;
		$skill_level_id = 0;
		$work_hours_id = 0;

		$connection = mysqli_connect($db_hostname, $db_username, $db_password);
		if(!$connection) {
			echo"Database Connection Error...".mysqli_connect_error();
		} else {
			$sql="SELECT * FROM Taskboard.Skills WHERE skill='$skill'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table Skills".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$skill_id=$row["id"];
				}
			}
			$sql="SELECT * FROM Taskboard.SkillLevel WHERE skill_level='$skill_level'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table SkillLevel".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$skill_level_id=$row["id"];
				}
			}
			$sql="SELECT * FROM Taskboard.WorkingHours WHERE hour='$work_hours'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table WorkingHours".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$work_hours_id=$row["id"];
				}
			}
		
			$sql= "SELECT * FROM Taskboard.TeamMembers WHERE email= '$email'";
			$retval= mysqli_query($connection, $sql);
			if(! $retval ) {
				echo"Error access in table TeamMembers2: ".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 0) {
				$sql= "INSERT INTO Taskboard.TeamMembers (first_name,last_name,email,password,skill,skill_level,work_hours) ".
				"VALUES ('$first_name','$last_name','$email','$password',$skill_id,$skill_level_id,$work_hours_id)";
				$retval= mysqli_query($connection, $sql);
				if(!$retval ) {
					echo "Error access in table TeamMembers: ".mysqli_error($connection);
				} else {
					// Redirect to Login page
					header("location: http://localhost/taskboard/header/login.php");
				}
			} else {
				$register_err = "User already exists";
			}
		}
		mysqli_close($connection);
	}
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="register.css">
	<script type="text/javascript" src="register.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="signup-form">
		<form method="post" class="needs-validation" action="" novalidate>
		<h2 class="text-center">Sign Up</h2>
			<!-- First name -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="firstnamePrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="First_Name" placeholder="First name..."
						id="username" aria-describedby="firstnamePrepend" minlength="3" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The minimum length of First name must be 3!
      				</div>
				</div>
			</div>
			<!-- Last name -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="lastnamePrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="Last_Name" placeholder="Last name..."
						id="username" aria-describedby="lastnamePrepend" minlength="3" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The minimum length of Last name must be 3!
      				</div>
				</div>
			</div>
			<!-- Email address -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="emailPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="Email" placeholder="Email.."
						id="username" aria-describedby="emailPrepend" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				Please enter a proper email address!
      				</div>
				</div>
			</div>
			<!-- Password -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="passwordPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-lock"></i></span>
        			</div>
					<input type="password" class="form-control" name="Password" placeholder="Password.."
						aria-describedby="passwordPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The password must contain at least a lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters!
      				</div>
				</div>
			</div>
			<!-- Confirm Password -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="confirmpasswordPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-lock"></i></span>
        			</div>
					<input type="password" class="form-control" name="Confirm_Password" placeholder="Confirm password.."
						aria-describedby="confirmpasswordPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The password must contain at least a lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters!
      				</div>
				</div>
			</div>
			<!-- Skill -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="confirmpasswordPrepend" style="width: 9em;"><i class="fa fa-cogs"> Skill</i></span>
        			</div>
					<select class="form-control" name="Skill">
						<option>C</option>
						<option>C++</option>
						<option>Java</option>
					</select>
				</div>
			</div>
			<!-- Nivel Skill -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="confirmpasswordPrepend" style="width: 9em;"><i class="fa fa-arrow-up"> Skill Level</i></span>
        			</div>
					<select class="form-control" name="SkillLevel">
						<option>Level 1</option>
						<option>Level 2</option>
						<option>Level 3</option>
						<option>Level 4</option>
						<option>Level 5</option>
						<option>Level 6</option>
						<option>Level 7</option>
						<option>Level 8</option>
						<option>Level 9</option>
						<option>Level 10</option>
					</select>
				</div>
			</div>
			<!-- Working Hours -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="confirmpasswordPrepend" style="width: 9em;"><i class="fa fa-clock-o"> Working Hours</i></span>
        			</div>
					<select class="form-control" name="WorkingHours">
						<option>4h/day</option>
						<option>6h/day</option>
						<option>8h/day</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary login-btn btn-block">Sign Up</button>
			</div>
		</form>
		<p class="text-center text-muted small">Already have an account? <a href="http://localhost/Taskboard/header/login.php">Sign in here!</a></p>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
