

<!-- Edit Task Modal -->
<div class="modal fade" id="EditTask" tabindex="-1" role="dialog" aria-labelledby="EditTaskLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditTaskLabel" style="font-size: 20px;">Edit Task Dialog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" class="TaskForm" action="../api.php/tasks/edit" novalidate>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-list"></i> Task name</span>
					</span>
					<input type="text" id="edit-task-name" class="form-control" name="EditTaskName" placeholder="Task name" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-cogs"></i> Skill</span>
					</span>
					<select id="edit-skill" class="form-control" name="EditSkill">
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
					<select id="edit-level" class="form-control" name="EditSkillLevel">
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
					<input type="number" id="edit-duration" class="form-control" name="EditDuration" placeholder="Duration" min="0" max="1000" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-user"></i> Assigned To</span>
					</span>
					<select id="edit-assigned-to" class="form-control" name="EditAssignedTo" onclick="changed();">
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
					<select id="edit-status" class="form-control" name="EditStatus">
						<option>Todo</option>
						<option>In progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			<input style="visibility: hidden;" type="number" name="EditTaskId" id="edit-task-id">
			<div class="form-group">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Edit Task</button>
			</div>
		</form>
      </div>
    </div>
  </div>
  </div>