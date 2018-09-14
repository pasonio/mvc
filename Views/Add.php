<div class="container">
	<div class="row">
		<form action="add" id="add_task" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <br/>
                <input type="text" name="Task[username]" id="username" />
            </div>
            <div class="form-group">
                <label for="email">User email</label>
                <br/>
                <input type="email" name="Task[email]" id="email" />
            </div>
            <div class="form-group">
                <label for="task_description">Task description</label>
                <br/>
                <textarea id="task_description" name="Task[task_description]"></textarea>
            </div>
            <div class="form-group">
                <label for="task_image">Task image</label>
                <br/>
                <input type="file" id="task_image" name="Task[task_image]" />
            </div>
            <div class="form-group">
                <button type="submit" id="submit_form">Create new task</button>
            </div>
		</form>
        <div id="preview_data" title="Preview Form Data" class="form" style="display:none;"></div>
    </div>
</div>