<?php
// This below line includes functions or code to run here whenever we runs this file
// include('task_completed_at.php');

session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: home.html"); // Redirect to login page if not logged in
    exit();
}

// Retrieve employee details from session
$employee_name = $_SESSION['employee_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="employee.css">
    <title>Employee Dashboard</title>

<style>
        /* h1{
    color: #2E86C1;
    font-size: 28px;
    text-align: end;
    margin-bottom: -10px;
    margin-right: 30px;

    } */
    h1 {
        font-size: 28px;
        text-align: end;
        margin-bottom: -10px;
        margin-right: 30px;
        cursor: pointer;
        font-weight: bold;
        /* color: #3282b8; */
        color: #bbe1fa;
    }
</style>

</head>
<body>

    <div class="nav-menu">
        <h1>TaskVault</h1>
        <h2 class="role">Hi, <?php echo htmlspecialchars($employee_name); ?></h2>
        <a href="#">My Tasks</a>
        <a href="employee_profile.php">Profile</a>
        <a href="employee_logout.php">Logout</a> <!-- Updated to PHP logout -->
        
    </div>

    <!-- Sections -->
    <div id="tasks" class="section active">
        <h2>My Tasks</h2>
        <!-- <p>You have 1 new task, 2 completed tasks, and 1 remaining.</p> -->

        <table>
            <tr>
                <th>Sr no</th>
                <th>Title</th>
                <th>Task Description</th>
                <th>Given Date</th>
                <th>Deadline Date</th>
                <th>Priority Level</th>
                <th>Task Status</th>
            </tr>
            <?php
            // Connect to database
            $conn = mysqli_connect("localhost", "root", "", "Employee_Mgmt_System");

            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            // Fetch tasks assigned to the logged-in employee
            $emp_id = $_SESSION['employee_id'];
            $task_query = "SELECT * FROM task_table WHERE `employee id` = '$emp_id'";
            $task_result = mysqli_query($conn, $task_query);

            if (!$task_result) {
                die("Query Failed: " . mysqli_error($conn)); // Display MySQL error
            }

            if (mysqli_num_rows($task_result) > 0) {
                $count = 1;
                while ($row = mysqli_fetch_assoc($task_result)) {
                    echo "<tr>
                        <td>$count</td>
                        <td>" . htmlspecialchars($row['Task Title']) . "</td>
                        <td>" . htmlspecialchars($row['Task Description']) . "</td>
                        <td>" . htmlspecialchars($row['Task Given Time']) . "</td>
                        <td>" . htmlspecialchars($row['Task Deadline Time']) . "</td>
                        <td>" . htmlspecialchars($row['Priority']) . "</td>
                        <td>
                        <form method='POST' action='update_task_status.php'>
                            <select name='task_status'> 
                                <option value='Pending' " . ($row['Status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                <option value='In Progress' " . ($row['Status'] == 'In Progress' ? 'selected' : '') . ">In Progress</option>
                                <option value='Completed' " . ($row['Status'] == 'Completed' ? 'selected' : '') . ">Completed</option>
                            </select>
                            <input type='hidden' name='task_id' value='" . $row['Task id'] . "'>
                            <button type='submit'>Update</button>
                        </form>
                        </td>
                    </tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='7'>No tasks assigned yet.</td></tr>";
            }


            mysqli_close($conn);
            ?>
        </table>
    </div>


</body>
</html>


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


mysqli_close($connection);

?>
