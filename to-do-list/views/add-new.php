<div class="wrap">
    <h2>Submit form</h2>
    <form action="#" id="add_new_task_form" method="post">

        <div class="form-group">
            <label for="task_name">Task Name:</label>
            <input type="text" name="task_name" class="form-control" id="task_name" placeholder="Enter Task name" required>
        </div>
        <br>
        <div class="form-group">
            <label for="short_desc">Short Desc:</label>
            <input type="text" name="short_desc" class="form-control" id="short_desc" placeholder="Enter short description">
        </div>
        <br>

        <input type="submit" name="add_new_task" value="Add New Task" class="btn btn-primary">
    </form>
</div>