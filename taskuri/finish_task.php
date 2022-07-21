<?php
    include "../db_connection.php";
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET["id"];
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
    }
?>
