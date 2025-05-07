<?php 

$connection = mysqli_connect("localhost", "root", "", "employee_mgmt_system");
if (!$connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Delete tasks that are marked as "Completed" for more than 2 days
$delete_completed_tasks = "DELETE FROM task_table WHERE `Status` = 'Completed' AND `Completed_At` <= NOW() - INTERVAL 2 DAY";
mysqli_query($connection, $delete_completed_tasks);

// Delete tasks where the deadline has already passed
$delete_overdue_tasks = "DELETE FROM task_table WHERE `Task Deadline Time` < NOW()";
mysqli_query($connection, $delete_overdue_tasks);

echo "Cleanup done! Deleted completed and overdue tasks.";

mysqli_close($connection);

?>
