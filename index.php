<html>
<head>
	<title>TaskBoard</title>
	<?php
		session_start();
		include 'db_connection.php';
		initializeDatabase();
		if (!isset($_SESSION['user_id'])) {
			header("location: http://localhost/taskboard/header/login.php");
		}
	?>
<script> 
    function start_task(id) {
        var construction_url = "rest.php/startTask/" + id;

        $.ajax({
            type:'put',
            url: construction_url,
            dataType:'text',
            cache: false,
            success: function (response) {
                console.log(response);
            },
            error: function (request, status, error) {
                alert(request.responseText);
                console.log(request.statusCode);
                console.log(error);
            }
        });
    }

    function end_task(id) {
        var construction_url = "rest.php/finishTask/" + id;

        $.ajax({
            type:'put',
            url: construction_url,
            dataType:'text',
            cache: false,
            success: function (response) {
                console.log(response);
            },
            error: function (request, status, error) {
                alert(request.responseText);
                console.log(request.statusCode);
                console.log(error);
            }
        });
    }

    function assign_task(user_id, task_id) {
        var construction_url = "rest.php/addTask/" + user_id;

        $.ajax({
            type:'post',
            url: construction_url,
            dataType:'text',
            cache: false,
            data: {
                task_id: task_id
            },
            success: function (response) {
                console.log(response);
            },
            error: function (request, status, error) {
                alert(request.responseText);
                console.log(request.statusCode);
                console.log(error);
            }
        });
    }
</script>

</head>
	<frameset rows="50px,*" border="0">
		<frame name="header" src="header/header.php"> </frame>
		<frame name="content" src="content.php"> </frame>
	</frameset>
	<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</html>
