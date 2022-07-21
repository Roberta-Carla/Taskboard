


<div class="modal fade" id="DeleteTask" tabindex="-1" role="dialog" aria-labelledby="DeleteTaskLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="DeleteTaskLabel" style="font-size: 20px;">Delete Task Dialog</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" class="TaskForm" action="../api.php/task/delete"  novalidate>
					<span id="task-name"></span>
					<input style="visibility: hidden;" type="number" name="TaskId" id="TaskIdInput">
					<div class="form-group">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Yes</button>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

