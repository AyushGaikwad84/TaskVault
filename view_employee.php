<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "employee_mgmt_system"; 

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee data
$sql = "SELECT * FROM employee_details";
$result = $conn->query($sql);

echo "<div class='atag'><a href ='admin_dashboard.php'>/Go to Dashboard</a></div>";
// <th>Password</th>
// <td>" . $row['employee password'] . "</td>

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Emergency Contact</th>
                <th>Salary</th>
                <th>Date of Joining</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['employee id'] . "</td>
                <td>" . $row['employee name'] . "</td>
                <td>" . $row['Designation'] . "</td>
                <td>" . $row['employee email'] . "</td>
                <td>" . $row['employee mobile number'] . "</td>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['address'] . "</td>
                <td>" . $row['emergency contact'] . "</td>
                <td>" . $row['salary'] . "</td>
                <td>" . $row['date_of_joining'] . "</td>
            </tr>";
    }
    echo "</table>";
}

else {
    echo "No employees found.";
}

$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    /* background-color: #f4f6f9; */
    background-color: #e4f1fe;
    color: #333;
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

    table{
        margin-top: 50px;
        margin-left: 50px;
        margin-right: 50px;
        margin-bottom: 20px;
        border: none;
        background-color: burlywood;
        box-shadow: 0 5px 10px #333;
    }
    th{
        background-color: #34495e;
        color: white;
        padding: 15px 20px;
        border: none;
    }
    tr{
        border: none;
        padding: 10px;
    }
    tr:hover{
        background-color:rgb(247, 216, 177);
        cursor: pointer;
        transform:scale(1.01);
        transition: 0.3 ease-in-out;
    }
    td{
        padding: 12px;
        border: none;
        border-left: 1px solid;
        border-right: 1px solid;
    }
</style>


</head>
<body>
    
</body>
</html>