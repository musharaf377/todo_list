<h1 class="test">All items</h1>

<table>
    <thead>
        <tr>
            <th>Task name</th>
            <th>Short description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php

        if (!empty($all_tasks)) {
            foreach ($all_tasks as $task) {
        ?>
                <tr>
                    <td><?php echo $task->task_name; ?></td>
                    <td><?php echo $task->short_desc; ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=todo_list&action=edit&id=' . $task->id); ?>">Edit</a>
                        <a href="<?php echo admin_url('admin.php?page=todo_list&action=delete&id=' . $task->id); ?>">Delete</a>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>