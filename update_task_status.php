<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "employee_mgmt_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_SESSION['employee_id'];
    $task_id = $_POST['task_id'];
    $status = $_POST['task_status'];

    // If status is "Completed", ask for confirmation
    if ($status === 'Completed' && !isset($_POST['confirm_complete'])) {
        echo "<form method='POST' action='update_task_status.php'>
                <input type='hidden' name='task_id' value='$task_id'>
                <input type='hidden' name='task_status' value='$status'>
                <input type='hidden' name='confirm_complete' value='yes'>
                <p>Are you sure you want to mark this task as <b>Completed</b>?</p>
                <button type='submit'>Yes</button>
                <a href='employee.php'><button type='button'>Cancel</button></a>
              </form>";
        exit(); // Stop further execution until confirmation
    }

    // Update query with proper column and table names
    $update_query = "UPDATE task_table 
                     SET status = '$status' 
                     WHERE `employee id` = '$employee_id' 
                     AND `Task id` = '$task_id'";

    if (mysqli_query($conn, $update_query)) {
        // Success message only for Pending and In Progress
        if ($status === 'Pending' || $status === 'In Progress') {
            echo "<script>alert('Task updated successfully'); window.location='employee.php';</script>";
        } elseif ($status === 'Completed' && isset($_POST['confirm_complete'])) {
            echo "<script>alert('Task marked as Completed'); window.location='employee.php';</script>";
        }
    } else {
        echo "Error while updating task: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
