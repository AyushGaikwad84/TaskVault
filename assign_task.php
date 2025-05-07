<?php
// Ensure error reporting is enabled for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get employee details from URL parameters
$employee_id = isset($_GET['id']) ? $_GET['id'] : "Not Found (Check URL)";
$employee_name = isset($_GET['name']) ? $_GET['name'] : "Not Provided";
$employee_designation = isset($_GET['designation']) ? $_GET['designation'] : "Not Provided";

// Defult use this time zone
date_default_timezone_set('Asia/Kolkata');

// Get today's date in YYYY-MM-DD format
$today = date('Y-m-d h:i');
// Calculate max date (5 days from today)
// $max_date = date('Y-m-d', strtotime('+5 days'));
// $max_date_deadline = date('Y-m-d', strtotime('+20 days'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Task</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cfe2e1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
            width: 450px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: 600;
            color: #34495e;
            display: block;
            margin-top: 15px;
        }

        input[type="text"],
        textarea,
        input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 15px;
            border: 1px solid #5a6a8d;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
            height: 80px;
            font-size: 15px;
        }

        .radio-group {
            margin-top: 5px;
        }

        .radio-group label {
            display: inline-block;
            margin-right: 15px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #34495e;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
</style>
</head>
<body>

<!--  a tag is not written here bez it mismatches the design of form if u want u can try and manage it. -->

<div class="form-container">
    <h1>Assign Task</h1>
    <p>Employee ID: <b><?= htmlspecialchars($employee_id) ?></b></p>
    <p>Employee Name: <b><?= htmlspecialchars($employee_name) ?></b></p>
    <p>Employee Designation: <b><?= htmlspecialchars($employee_designation) ?></b></p>
    <hr>

    <form action="save_task.php" method="post">
        <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee_id) ?>">
        <input type="hidden" name="employee_name" value="<?= htmlspecialchars($employee_name) ?>">
        <input type="hidden" name="employee_designation" value="<?= htmlspecialchars($employee_designation) ?>">

        <label for="title">Task Title:</label>
        <input type="text" name="task_title" placeholder="Add Task Title" required>

        <label for="task">Task Description:</label>
        <textarea name="task_description" placeholder="Enter Task details" required></textarea>

        <label for="given_date">Task Given Date and Time:</label>
        <?php 
        $current_date = date('Y-m-d\TH:i'); // Current date and time in HTML format
        $min_date = date('Y-m-d\TH:i', strtotime('-1 days'));
        $max_date = date('Y-m-d\TH:i', strtotime('+1 day'));
        ?>
        <input type="datetime-local" name="given_date" value="<?php echo $current_date; ?>" 
            min="<?php echo $min_date; ?>" max="<?php echo $max_date; ?>" required><br>

        <label for="deadline">Task Deadline Date and Time:</label>
        <?php
        // $min_deadline_date = date('Y-m-d\TH:i', strtotime('0 days'));
        $max_deadline_date = date('Y-m-d\TH:i', strtotime('15 days'));
        ?>
        <input type="datetime-local" id="deadline_date" name="deadline_date"
        required min="<?= $current_date ?>" max="<?= $max_deadline_date ?>">

        <label>Priority Level:</label>
        <div class="radio-group">
            <label><input type="radio" name="priority" value="high" required> High</label>
            <label><input type="radio" name="priority" value="medium"> Medium</label>
            <label><input type="radio" name="priority" value="low"> Low</label>
        </div>

        <input type="submit" value="Assign Task">
    </form>
</div>

</body>
</html>
