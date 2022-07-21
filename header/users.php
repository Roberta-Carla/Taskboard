<?php
    include "../db_connection.php";

    class User {
        
    }

    $connection = mysqli_connect($db_hostname, $db_username, $db_password);
    if(!$connection) {
        echo "Database Connection Error: ".mysqli_connect_error();
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

            $user = new User;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->skill = $skill;
            $user->level = $skill_level;
            array_push($users, $user);
        }
        mysqli_close($connection);

        $usersJSON = json_encode($users);
        echo $usersJSON;
    }
?>