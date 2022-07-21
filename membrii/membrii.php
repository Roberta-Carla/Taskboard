<html>
<head>

<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="membrii.css">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
</head>
<body style="weight: lightgrey;">
<div class="page-wrapper chiller-theme toggled">
	<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Navigation</a>
                    <div id="close-sidebar">
                    </div>
                </div>
				
                <div class="sidebar-header">
                    <div class="user-pic">
                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                        alt="User picture">
                    </div>
                    <div class="user-info">
						<?php
							// Get logged user from database
							include "../db_connection.php";
							session_start();
							if (isset($_SESSION['user_id'])) {
								$connection = mysqli_connect($db_hostname, $db_username, $db_password);
								$userId = $_SESSION['user_id'];
								$sql = "SELECT * FROM $database.TeamMembers WHERE id = '$userId'";
								$retval = mysqli_query( $connection, $sql );
								if(! $retval ) {
									echo "Error accessing table TeamMembers0: ".mysqli_error($connection);
								}
								while($row = mysqli_fetch_assoc($retval)) {
									$firstName = $row["first_name"];
									$lastName = $row["last_name"];
									echo "<span class=\"user-name\">$firstName <strong>$lastName</strong></span>";
								}
								mysqli_close($connection);
							}
						?>
						<span class="user-role">Operator</span>
						<span class="user-status">
							<i class="fa fa-circle"></i>
							<span>Online</span>
						</span>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
						<li class="header-menu">
                            <span>Team Members</span>
                        </li>
						<?php
							$connection = mysqli_connect($db_hostname, $db_username, $db_password);
							if(!$connection) {
								echo "Database Connection Error...".mysqli_connect_error();
							} else {
								$sql="SELECT * FROM $database.TeamMembers";
								$retval = mysqli_query( $connection, $sql );
								$users = [];
								while($row = mysqli_fetch_assoc($retval)) {
									$first_name = $row["first_name"];
									$last_name = $row["last_name"];
									$work_hours = $row["work_hours"];
									$skill_id = $row["skill"];
									$skill_level_id = $row["skill_level"];

									$sql="SELECT * FROM $database.Skills WHERE id=$skill_id";
									$retval1 = mysqli_query( $connection, $sql );
									$skill = "";
									while($row1 = mysqli_fetch_assoc($retval1)){
										$skill = $row1["skill"];
									}

									$sql = "SELECT * FROM $database.SkillLevel WHERE id=$skill_level_id";
									$retval1 = mysqli_query( $connection, $sql );
									$skill_level="";
									while($row1 = mysqli_fetch_assoc($retval1)){
										$skill_level = $row1["skill_level"];
									}

									$sql = "SELECT * FROM $database.WorkingHours WHERE id=$work_hours";
									$retval1 = mysqli_query( $connection, $sql );
									$hours = "";
									while($row1 = mysqli_fetch_assoc($retval1)){
										$hours = $row1["hour"];
									}

									$hours_short = str_replace("/day", "", $hours);

									echo "".
											"<li class=\"sidebar-dropdown\">".
												'<a href="#">'.
													'<i class="fa fa-tachometer-alt"></i>'.
													"<span>$first_name $last_name</span>".
													"<span class=\"badge badge-pill badge-warning\">$hours_short</span>".
												'</a>'.
												'<div class="sidebar-submenu">'.
													'<ul>'.
														'<li>'.
															"<a href=\"#\">Skill: <span style=\"float: none; font-size: 1em;\" class=\"badge badge-pill badge-info\">$skill</span></a>".
														'</li>'.
														'<li>'.
															"<a href=\"#\">Level: <span style=\"float: none; font-size: 1em;\" class=\"badge badge-pill badge-info\">$skill_level</span></a>".
														'</li>'.
														'<li>'.
															"<a href=\"#\">Working hours: <span style=\"float: none; font-size: 1em;\" class=\"badge badge-pill badge-warning\">$hours</span></a>".
														'</li>'.
													'</ul>'.
												'</div>'.
											'</li>';
								}
								mysqli_close($connection);
							}
						?>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#">
                    
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
	</div>

	<!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../membrii.js"></script>
	<
</body>
</html>
