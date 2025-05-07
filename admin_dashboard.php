

<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: home.html"); // Redirect to login page if not logged in
    exit();
}

// Retriving Data - 
$admin_name = $_SESSION['admin_name'];

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "employee_mgmt_system";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error){
    die("Connection Failed. ".$conn->connect_error);
}

// $query = "SELECT * FROM employee_details ";
// $query_emp_details = "SELECT COUNT(*) FROM employee_details";
// $query_tasks = "SELECT COUNT(*) FROM task_table";

$query_emp_details = "SELECT COUNT(*) AS total_employees FROM employee_details";
$result_emp_details = $conn->query($query_emp_details);
$row_emp_details = $result_emp_details->fetch_assoc();
$total_employees = $row_emp_details['total_employees'];

$query_pending_tasks = "SELECT COUNT(*) AS pending_tasks FROM task_table WHERE status = 'Pending'";
$result_pending_tasks = $conn->query($query_pending_tasks);
$row_pending_tasks = $result_pending_tasks->fetch_assoc();
$pending_tasks = $row_pending_tasks['pending_tasks'];

$query_inprogress = "SELECT COUNT(*) AS in_Progress_tasks FROM task_table WHERE status = 'In Progress'";
$result = $conn->query($query_inprogress);
$row_prog_tasks = $result->fetch_assoc();
$in_progress_tasks = $row_prog_tasks['in_Progress_tasks'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">

    <style>
        /* h1{
    color: #2E86C1;
    font-size: 28px;
    text-align: end;
    margin-bottom: -10px;
    margin-right: 30px;

    } */
.logo h1 {
    font-size: 28px;
    text-align: right; /* Align text to the right */
    margin-top: -20px;
    margin-left: 82%;
    margin-bottom: -20px;
    background-color: rgb(164, 219, 255);
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: rgb(22, 59, 83);
    display: inline-block; /* Ensures the background wraps properly */
    border-radius: 8px; /* Adds a subtle rounded edge */
}
.logo h1:hover{
    background-color: rgb(143, 207, 250);
}

</style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <!-- <li><a href="#">Employee Management</a></li> -->
                <li><a href="add_employee.html">Add Employee</a></li>
                <li><a href="view_employee.php">View Employee</a></li>
                <li><a href="emp_task_mgmt.php">Task Management</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
        <div class="logo">
        <h1>TaskVault</h1>
        </div>
            <h1>Welcome, <?php echo htmlspecialchars($admin_name); ?></h1>
            <div class="overview">
                <div class="card">
                    <h3>Total Employees</h3>
                    <p><?php echo $total_employees; ?></p>

                </div>
                <div class="card">
                    <h3>Pending Tasks</h3>
                    <!-- <p>20</p> -->
                     <p><?php echo $pending_tasks ; ?></p>
                </div>
                <div class="card">
                    <h3>In Progress Tasks</h3>
                    <p><?php echo $in_progress_tasks; ?></p>
                </div>
            </div>

            <div class="admin_pages">
                <div>
                    <p id="first"><a href="add_employee.html">Add New Employee</a></p>
                </div>
                <div>
                    <p id="second"><a href="view_employee.php">View all Employee</a></p>
                </div>
                <div>
                    <p id="third"><a href="emp_task_mgmt.php">Assign Tasks</a></p>
                </div>
                <div>
                    <p id="fourth"><a href="reports.php">See Reports</a></p>
                </div>
            </div>

            <!-- <div class="section">
                <h2>Manage Employee Data</h2>
                <p>View and update employee details.</p>
            </div> -->

        </div>
    </div>

</body>
</html>
