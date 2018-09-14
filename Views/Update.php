<div class="container">
	<div class="row">
		<form action="update?id=<?= $model['id'] ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="username">Username</label>
				<br/>
				<input type="text" name="Task[username]" id="username" value="<?= $model['username'] ?>" />
			</div>
			<div class="form-group">
				<label for="email">User email</label>
				<br/>
				<input type="email" name="Task[email]" id="email" value="<?= $model['email'] ?>" />
			</div>
			<div class="form-group">
				<label for="task_description">Task description</label>
				<br/>
				<textarea id="task_description" name="Task[task_description]"><?= $model['task_description'] ?></textarea>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<br/>
				<input type="checkbox" id="status" name="Task[status]" <?= $model['status'] ? 'checked' : '' ?> />
			</div>
			<div class="form-group">
				<button type="submit" id="submit_update_form">Update task</button>
			</div>
		</form>
	</div>
</div>