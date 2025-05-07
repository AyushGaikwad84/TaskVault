<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Tasks</title>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e4f1fe;
            color: #333;
        }

        /* .atag {
            text-decoration: none;
            font-size: 18px;
            margin-left: 50px;
            margin-top: 20px;
        } */

        /* a{
        background-color:rgba(52, 73, 94, 0.24);
        text-decoration: none;
        color: #34495e;
        padding: 20px 10px;
        transition: 1s ease-in-out;
        } */
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

        table {
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 80%;
            background-color: burlywood;
            box-shadow: 0 5px 10px #333;
        }

        th {
            background-color: #34495e;
            color: white;
            padding: 15px 20px;
            border: none;
        }

        tr:hover {
            background-color: rgb(247, 216, 177);
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        td, th {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .searchemp {
            margin-top: 50px;
            text-align: center;
        }

        input {
            margin: 0 50px;
            padding: 14px 10px;
            font-size: 15px;
            border: 1px solid #34495e;
            border-radius: 18px;
            text-align: left;
        }

        input:hover {
            cursor: pointer;
        }
        input:active{
            border: 1px solid rgb(62, 134, 230);
        }
        button{
            padding: 8px 20px;
            border: 1px solid #34495e;
        }
</style>
</head>
<body>

    <div class='atag'>
        <a href='admin_dashboard.php'>/Go to Dashboard</a>
    </div>

    <form method="POST">
        <div class="searchemp">
            <input type="search" name="sr_emp" placeholder="Search Employee by ID, Name or Email">
            <button type="submit">Search</button>
            <!-- <h2>You can Assign 5 low level, 3 Medium & 1 High level Tasks in one day</h2> -->
        </div>
    </form>



<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "employee_mgmt_system"; 

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM employee_details";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["sr_emp"])) {
        // $search_employee = $conn->real_escape_string($_POST["sr_emp"]); for preventing sql attack
        $search_employee = $_POST["sr_emp"];
        $sql = "SELECT * FROM employee_details 
                WHERE `employee name` LIKE '%$search_employee%'
                OR `employee id` LIKE '%$search_employee%' 
                OR `employee email` LIKE '%$search_employee%'";
    }   
    //The LIKE pattern matching operator can also be used in the conditional selection of the where clause. 
    // Like is a very powerful operator that allows you to select only rows that are “like” what you specify. 
    // The percent sign “%” can be used as a wild card to match any possible character that might appear before 
    // or after the characters specified.

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Date of Joining</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            // explaination of below line - window.location.href='assign_task.php?id=..."
                            // window.location.href is JavaScript that redirects the browser to a new URL.
                            // 'assign_task.php?id=...' sets the destination URL, appending the employee's ID as a query parameter.
                            // " . $row['employee id'] . "

                            // Fetches the employee’s ID from the database using $row['employee id'].
                            // The . (dot) is used for string concatenation in PHP.
                            // The final URL will look something like this when an employee row is clicked:
                            // assign_task.php?id=5
            // echo "<tr onclick=\"window.location.href='assign_task.php?id=" . $row['employee id'] . "'\">
 echo "<tr onclick=\"window.location.href='http://localhost/project sem 6/assign_task.php?id=" 
 . $row['employee id'] . "&name=". urlencode($row['employee name']). "&designation=". urldecode($row['Designation']). "'\">
                    <td>" . $row['employee id'] . "</td>
                    <td>" . $row['employee name'] . "</td>
                    <td>" . $row['Designation'] . "</td>
                    <td>" . $row['employee email'] . "</td>
                    <td>" . $row['employee mobile number'] . "</td>
                    <td>" . $row['date_of_joining'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No employees found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
