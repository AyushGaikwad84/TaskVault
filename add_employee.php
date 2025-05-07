<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "Employee_Mgmt_System";

$conn = mysqli_connect($host, $username, $password, $dbname);

if($conn -> connect_error)
{
    die("connection failed");
}
else
{
    echo "Database connected<br>";
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $empname = $_POST["empname"];
    $empemail = $_POST["empemail"];
    $empdesig = $_POST['empdesig'];
    $empgender = $_POST['empgender'];
    $empaddress = $_POST['empaddress'];
    $empmobno = $_POST['empmobno'];
    $emergencycontact = $_POST['emergencycontact'];
    $empsalary = $_POST['empsalary'];
    $emppassword = $_POST["emppassword"];
    $emp_confirm_password = $_POST["confirmemppassword"];
    $emp_date_of_joining = $_POST["date_of_joining"];


    if($emppassword === $emp_confirm_password)
    {
        // selecting details from employee_details to check values are already exists or not
        $checkQuery = "SELECT * FROM employee_details WHERE `employee email` = '$empemail' AND `employee mobile number` = '$empmobno'";
        $result = mysqli_query($conn, $checkQuery);

        // if exist then below msg will displayed.
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result); // Fetch the existing row

            // checking email and password bez they are unique identifiers
            if ($row['employee email'] === $empemail) {
                echo "<br>The email '$empemail' is already registered!";
            }
            if ($row['employee mobile number'] === $empmobno) {
                echo "<br>The mobile number '$empmobno' is already registered!";
            }
        }


        else{

        // $check = "INSERT into employee_details values '$empid','$empname','$empemail','$emppassword','$empdateofjoinig'";
        $check = "INSERT INTO employee_details (`employee name`, `employee email`, `Designation`,`gender`,`address`,`employee mobile number`, `emergency contact`, `salary`, `employee password`, `date_of_joining`) 
                VALUES ('$empname', '$empemail', '$empdesig', '$empgender', '$empaddress', '$empmobno', '$emergencycontact', '$empsalary','$emppassword', '$emp_date_of_joining')";
        
        
        if(mysqli_query($conn,$check)){
            echo "<br> $empname Employee data inserted successfully";
            header("refresh:3; url:admin_dashboard.php");
            echo "<br>Thank you";
        }
        else{
            // echo "password doesn't match";
            echo "error during inserting data into database". mysqli_error($conn);
        }

        }
    }
    else{
        echo "Password Doesnt match";
    }
}

?>

