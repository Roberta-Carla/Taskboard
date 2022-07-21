
<!-- Add Task Modal -->
<div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="AddTaskLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddTaskLabel" style="font-size: 20px;">Add Task Dialog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" class="TaskForm" action="../api.php/tasks" novalidate>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-list"></i> Task name</span>
					</span>
					<input type="text" class="form-control" name="TaskName" placeholder="Task name" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-cogs"></i> Skill</span>
					</span>
					<select class="form-control" id="add_task_skill" name="Skill">
						<option>C</option>
						<option>C++</option>
						<option>Java</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-arrow-up"></i> Skill Level</span>
					</span>
					<select class="form-control" id="add_task_skill_level" name="SkillLevel">
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
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-clock-o"></i> Duration</span>
					</span>
					<input type="number" class="form-control" name="Duration" placeholder="Duration" min="0" max="1000" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-user"></i> Assigned To</span>
					</span>
					<select class="form-control" name="AssignedTo" id="add_task_user">
						<?php
							$connection = mysqli_connect($db_hostname, $db_username, $db_password);
							if(!$connection) {
								echo "Database Connection Error...".mysqli_connect_error();
							} else {
								$sql="SELECT * FROM $database.TeamMembers";
								$retval = mysqli_query( $connection, $sql );
								while($row = mysqli_fetch_assoc($retval)) {
									$first_name=$row["first_name"];
									$last_name=$row["last_name"];
									echo "<option>$first_name $last_name</option>";
								}
								mysqli_close($connection);
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-check"></i> Status</span>
					</span>
					<select class="form-control" name="Status">
						<option>Todo</option>
						<option>In progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			<div id="add_task_error" style="width: 100%; margin-top: .25rem; margin-bottom: .25rem; font-size: 80%; color: #dc3545;"></div>
			<div class="form-group">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Add Task</button>
			</div>
		</form>
      </div>
    </div>
  </div>
  </div>