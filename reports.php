<?php


$conn = mysqli_connect('localhost', 'root', '', 'employee_mgmt_system');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get filter values - this is used to get values using GET method bez get is used to display and fetching data.
// if we dont use this we cannot get values
// Get filter values
$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$priority = isset($_GET['priority']) ? $_GET['priority'] : '';


// Task counts for quick stats
// you can also write this like -
//  $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM task_table");
// $data = mysqli_fetch_assoc($result);
// $total_tasks = $data['total'];  this is for 

$total_tasks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM task_table"))['total'];
//  It creates array like this - 
//  $total_tasks = [
// 'total' => 5
// ];
$completed_tasks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM task_table WHERE status = 'Completed'"))['total'];
$pending_tasks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM task_table WHERE status = 'Pending'"))['total'];
$in_progress_tasks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM task_table WHERE status = 'In Progress'"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Reports</title>
<style>
    body {
        font-family: Arial, sans-serif;
        /* background-color: #f4f4f9; */
        background-color: #cfe2e1;
        color: #333;
        margin: 20px;
    }

    .atag {
            margin-left: 50px;
            margin-top: 20px;
        }

        a {
            background-color: rgba(52, 73, 94, 0.24);
            text-decoration: none;
            color: #34495e;
            padding: 10px;
            display: inline-block;
            border-radius: 5px;
            transition: 0.3s;
        }

        a:hover {
            background-color: #34495e;
            color: #b0e6ff;
            transition: background-color 0.3s;
        }

    h2 {
        color: #2e7d32;
        text-align: center;
        margin-bottom: 20px;
        margin-top: 0;
    }

    /* Filter Form Styling */
    form {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        margin-top: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color:#34495e;
        color: #ffffff;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f8e9;
    }

</style>

</head>
<body>

<div class='atag'>
        <a href='admin_dashboard.php'>/Go to Dashboard</a>
    </div>

    <h2>Task Reports</h2>

    <div>
        <p>Total Tasks: <?= $total_tasks ?></p>
        <p>Completed: <?= $completed_tasks ?></p>
        <p>Pending: <?= $pending_tasks ?></p>
        <p>In Progress: <?= $in_progress_tasks ?></p>
    </div>

    <table border="1">
        <tr>
            <th>Sr No</th>
            <th>Employee</th>
            <th>Task Title</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Given Date</th>
            <th>Deadline</th>
            <!-- <th>Completion Date</th> -->
        </tr>

        <?php
        $query = "SELECT * FROM task_table WHERE 1";

        $result = mysqli_query($conn, $query);
        $sr = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$sr}</td>
                    <td>{$row['employee name']}</td>
                    <td>{$row['Task Title']}</td>
                    <td>{$row['Priority']}</td>
                    <td>{$row['Status']}</td>
                    <td>{$row['Task Given Time']}</td>
                    <td>{$row['Task Deadline Time']}</td>
                  </tr>";
            $sr++;
        }
        ?>

        <!-- <td>" . ($row['Status'] === 'Completed' ? $row['completion_time'] : '-') . "</td> -->
    </table>
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


<?php mysqli_close($conn); ?>

