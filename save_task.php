<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'employee_mgmt_system');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $employee_desig = $_POST['employee_designation'];
    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];
    $given_date = $_POST['given_date'];
    $deadline_date = $_POST['deadline_date'];
    $priority = trim($_POST['priority']);

    if ($employee_id && $task_title && $given_date && $deadline_date && $priority) {
        // Check if the same task already exists for the same employee
        $sql_check = "SELECT * FROM task_table 
                      WHERE `employee id` = '$employee_id' 
                      AND `task title` = '$task_title'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<b>Error: </b>This task is already assigned to this employee.";
            echo "<h3>Change the Title, priority, or Date to assign Task</h3>";
        } else {
            // Insert task into table
            $sql = "INSERT INTO task_table (`employee id`, `employee name`, `employee desig`,`task title`, `task description`, `task given time`, `task deadline time`, priority, status) 
                    VALUES ('$employee_id', '$employee_name', '$employee_desig', '$task_title', '$task_description', '$given_date', '$deadline_date', '$priority', 'Pending')";

            if (mysqli_query($conn, $sql)) {
                echo "<h3>Task assigned successfully!</h3>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error: Please fill all required fields.";
    }
}

mysqli_close($conn);
