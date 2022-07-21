<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new Slim\App($config);


$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";

$app->post('/tasks', function (Request $request, Response $response) {
    $task_name = $request->getParsedBodyParam("TaskName");
    $skill = $request->getParsedBodyParam("Skill");
    $skill_level = $request->getParsedBodyParam("SkillLevel");
    $duration = $request->getParsedBodyParam("Duration");
    $assigned_to = $request->getParsedBodyParam("AssignedTo");
    $status = $request->getParsedBodyParam("Status");

	$skill_id = 0;
	$level_id = 0;
	$status_id = 0;
	$user_id = 0;
	$user_skill_id = 0;
	$user_skill_level_id = 0;
	$database="taskboard";

	$connection = mysqli_connect("127.0.0.1:3306", "root", "");
	if(!$connection) {
		echo"Database Connection Error...".mysqli_connect_error();
	} else {
		$sql="SELECT * FROM $database.Skills WHERE skill='$skill'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table Skills".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$skill_id = $row["id"];
			}
		}

		$sql="SELECT * FROM $database.SkillLevel WHERE skill_level='$skill_level'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table SkillLevel".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$level_id = $row["id"];
			}
		}

		$pieces = explode(" ", $assigned_to);
		$first_name = $pieces[0];
		$last_name = $pieces[1];
		var_dump($pieces);
		$sql = "SELECT * FROM $database.TeamMembers WHERE first_name='$first_name' AND last_name='$last_name'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table TeamMembers".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$user_id = $row["id"];
				$user_skill_id = $row["skill"];
				$user_skill_level_id = $row["skill_level"];
			}
		}

		if ($skill_id == $user_skill_id && $user_skill_level_id >= $level_id) {
			$sql="SELECT * FROM $database.TaskStatus WHERE task_status='$status'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo "Error access in table TaskStatus".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$status_id = $row["id"];
				}
			}
			
			$sql = "INSERT INTO Taskboard.Tasks(task_name,skill_required,level_required,duration,task_status,assigned_member) ".
					"VALUES('$task_name',$skill_id,$level_id,$duration,$status_id,$user_id)";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table TeamMembers".mysqli_error($connection);
			}
		}
		
        mysqli_close($connection);
	}
});

$app->post('/task/delete', function (Request $request, Response $response) {
    $id = $request->getParsedBodyParam("TaskId");
	$database="taskboard";
    $sql="DELETE FROM $database.Tasks WHERE id='$id'";

	$connection = mysqli_connect("127.0.0.1:3306", "root", "");
	if(!$connection) {
		echo "Database Connection Error: ".mysqli_connect_error();
	} else {
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table Skills".mysqli_error($connection);
		}
        mysqli_close($connection);
	}
});


$app->post('/tasks/edit', function (Request $request, Response $response) {
    $id = $request->getParsedBodyParam("EditTaskId");
	$task_name = $request->getParsedBodyParam("EditTaskName");
    $skill = $request->getParsedBodyParam("EditSkill");
    $skill_level = $request->getParsedBodyParam("EditSkillLevel");
    $duration = $request->getParsedBodyParam("EditDuration");
    $assigned_to = $request->getParsedBodyParam("EditAssignedTo");
    $status = $request->getParsedBodyParam("EditStatus");
	$database="taskboard";

	$skill_id = 0;
	$level_id = 0;
	$status_id = 0;

	
	$connection = mysqli_connect("127.0.0.1:3306", "root", "");
	if(!$connection) {
		echo "Database Connection Error...".mysqli_connect_error();
	} else {
		$sql="SELECT * FROM $database.Skills WHERE skill='$skill'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table Skills".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$skill_id = $row["id"];
			}
		}
		$sql="SELECT * FROM $database.SkillLevel WHERE skill_level='$skill_level'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table SkillLevel".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$level_id = $row["id"];
			}
		}
		$sql="SELECT * FROM $database.TaskStatus WHERE task_status='$status'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table TaskStatus".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$status_id = $row["id"];
			}
		}

		$pieces = explode(" ", $assigned_to);
		$first_name = $pieces[0];
		$last_name = $pieces[1];
		$sql = "SELECT * FROM $database.TeamMembers WHERE first_name='$first_name' AND last_name='$last_name'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table TeamMembers".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$user_id = $row["id"];
			}
		}

		$sql = "UPDATE Taskboard.Tasks SET task_name='$task_name',skill_required=$skill_id,level_required=$level_id,duration=$duration,".
				"task_status=$status_id,assigned_member=$user_id WHERE id=$id";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo"Error access in table TeamMembers".mysqli_error($connection);
        }
        mysqli_close($connection);
	}
});

$app->patch('/tasks/finish', function (Request $request, Response $response) {
    $id = $request->getParsedBodyParam("id");
    $connection = mysqli_connect($db_hostname, $db_username, $db_password);
    if(!$connection) {
        echo "Database Connection Error: ".mysqli_connect_error();
    } else {
        $sql = "UPDATE Taskboard.Tasks SET duration=0,task_status=3 WHERE id=$id";
        $retval = mysqli_query( $connection, $sql );
        if(! $retval ) {
            echo "Error access in table TeamMembers: ".mysqli_error($connection);
        }
        mysqli_close($connection);
    }
});

$app->get('/memberberries', function($requst, $response, $args) {
    $firstName = "";
    $lastName = "";
    $members = [];

    $db_hostname = "127.0.0.1:3306";
    $db_username = "root";
    $db_password = "";
    $database = "taskboard";
	$connection = mysqli_connect($db_hostname, $db_username, $db_password);
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $sql = "SELECT * FROM $database.TeamMembers WHERE id = '$userId'";
        $retval = mysqli_query( $connection, $sql );
        if(! $retval ) {
            echo "Error accessing table TeamMembers0: ".mysqli_error($connection);
        }
        while($row = mysqli_fetch_assoc($retval)) {
            $firstName = $row["first_name"];
            $lastName = $row["last_name"];
        }
        mysqli_close($connection);
    }
    $sql="SELECT * FROM $database.TeamMembers";
    $retval = mysqli_query( $connection, $sql );
    $users = [];
    while($row = mysqli_fetch_assoc($retval)) {
        $member = [];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $work_hours = $row["work_hours"];
        $skill_id = $row["skill"];
        $skill_level_id = $row["skill_level"];

        $member["name"] = $first_name." ".$last_name;
        
        $sql="SELECT * FROM $database.Skills WHERE id=$skill_id";
        $retval1 = mysqli_query( $connection, $sql );
        $skill = "";
        while($row1 = mysqli_fetch_assoc($retval1)){
            $skill = $row1["skill"];
        }
        $member["skill"] = $skill;

        $sql = "SELECT * FROM $database.SkillLevel WHERE id=$skill_level_id";
        $retval1 = mysqli_query( $connection, $sql );
        $skill_level="";
        while($row1 = mysqli_fetch_assoc($retval1)){
            $skill_level = $row1["skill_level"];
        }
        $member["skill_level"] = $skill_level;

        $sql = "SELECT * FROM $database.WorkingHours WHERE id=$work_hours";
        $retval1 = mysqli_query( $connection, $sql );
        $hours = "";
        while($row1 = mysqli_fetch_assoc($retval1)){
            $hours = $row1["hour"];
        }
        $member["hours"] = $hours;

        $hours_short = str_replace("/day", "", $hours);
        $member["hours_short"] = $hours_short;

        array_push($members, $member);
    }

    $loader = new \Twig\Loader\FilesystemLoader('./membrii');

    $twig = new \Twig\Environment($loader, [
        'debug' => true,
    ]);
    $response->getBody()->write($twig->render('membrii.html', ['first_name' => $first_name, 'last_name' => $last_name, 'members' => $members]));
    return $response;
});



$app->run();

?>