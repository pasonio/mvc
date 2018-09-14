<?php
use Models\Tasks;
?>
<div class="container">
    <div class="row">
        <h1>Tasks List</h1>
        <div class="col-sm-6">
            <div class="row">
                <a class="btn btn-info" href="tasks/add">Add new task</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <table class="table">
            <thead>
                <tr>
                    <th><a href="<?= \App\Router::generateSortHtml() ?>sort=username">Username</a></th>
                    <th><a href="<?= \App\Router::generateSortHtml() ?>sort=email">Email</a></th>
                    <th>Task description</th>
                    <th>Image</th>
                    <th><a href="<?= \App\Router::generateSortHtml() ?>sort=status">Status</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tasks_list as $list): ?>
                    <tr>
                        <td><?= $list['username']?></td>
                        <td><?= $list['email'] ?></td>
                        <td><?= $list['task_description']?></td>
                        <td><img src="<?= $list['image'] ?>"</td>
                        <td><?= Tasks::statusName()[$list['status']] ?></td>
                        <?php if(isset($_SESSION['admin'])): ?>
                            <td><a href="tasks/update?id=<?= $list['id'] ?>">edit task</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
		<?= $pagination->get() ?>
    </div>
</div>