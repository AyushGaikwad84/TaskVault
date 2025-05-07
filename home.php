<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "root";
$password = "";
$dbname = "Employee_Mgmt_System";

$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
} else {
    echo "<b>Database Connected</b><br>";
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['username'];
    $passw = $_POST['passw'];

    var_dump($_POST); // This will print the contents of the $_POST array
    
    // Check Admin First -----------
    $admin_check = "SELECT * FROM admin_table WHERE ad_name = '$name' AND ad_pass = '$passw'";
    $admin_result = mysqli_query($conn, $admin_check);

    if (!$admin_result) {
        die("Admin query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($admin_result) > 0) {
        // echo "Welcome Admin! Redirecting to admin page...<br>";
        $_SESSION['admin_name'] = $name; // Store admin session
        header("Location: admin_dashboard.php");
        exit;
    }
    
    // --------------
    
    
    // If not admin, proceed to employee logic--------------
    // $data = "INSERT INTO emp_login (emp_name, emp_passw) VALUES ('$name','$passw')";
    
    // here is a twist or magic, bez once you login in one tab and another different login in second tab, 
    //  if you again in first one and refresh it it will replace with second one, bez sessions are storeed in
    // browsers. to avoid or remove it simply for second login use different browser or create (add) session id code.
    
    $emp_check = "SELECT * FROM employee_details WHERE `employee name` = '$name' AND `employee password` = '$passw'";
    $emp_result = mysqli_query($conn, $emp_check);

    // Check if the query executed successfully
    if (!$emp_result) {
        die("Query Failed: " . mysqli_error($conn)); // Show the exact MySQL error
    }

    if (mysqli_num_rows($emp_result) > 0) {
        $emp_row = mysqli_fetch_assoc($emp_result); // Fetch the row

        $_SESSION['employee_id'] = $emp_row['employee id'];
        $_SESSION['employee_name'] = $emp_row['employee name'];

        echo "Hello $name, redirecting to employee page...<br>";
        header("Location: employee.php");
        exit;
    } else {
        die("You are not an Employee or your details are incorrect.");
    }
}
else {
    echo "Form not submitted";
}

// Close the database connection
$conn->close();
?>

<!-- 
Working of php and mysql - 
    1. it checks connection is made or not.
    2. if server method is post then next step will happern otherwise "form not submitted".
    3. first admin_check selects row from admin_table where $name and $passw are exists or not.
        1) if not goes to employee logic.
        2) else it checks mysqli_num_rows find atleast 1 rows if true admin page displayed.
    4. emp_check selects $name and $passw are exists are not. emp_result selects query - $conn and $emp_check.
        1) if emp_result is false/null then die("error while inserting...)
        2) now it goes to next if and checks emp_result have > 0  then employee page is displayed.
        3) else die and you are not employee msg is displayed. 
-->
