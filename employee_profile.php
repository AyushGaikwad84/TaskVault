<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "Employee_Mgmt_System");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$employee_id = $_SESSION['employee_id'];

$query = "SELECT * FROM employee_details WHERE `employee id` = '$employee_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$is_editing = false; // Flag to track editing state

// If user clicks "Edit"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_profile'])) {
    $is_editing = true;
}

// If user clicks "Update"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $new_phone = $_POST['phone'];
    $new_address = $_POST['address'];
    $new_emergency_contact = $_POST['emergency_contact'];


    $update_query = "INSERT INTO employee_updates (employee_id, phone, address, emergency_contact) 
              VALUES ('$employee_id', '$new_phone', '$new_address', '$new_emergency_contact')";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profile updated successfully!'); window.location='employee_profile.php';</script>";
    } else {
        echo "Error while updating record: " . mysqli_error($conn);
    }
}

$updated_query = "SELECT * FROM employee_updates WHERE employee_id = '$employee_id' ORDER BY updated_at DESC LIMIT 1";
$updated_result = mysqli_query($conn, $updated_query);
if ($updated_row = mysqli_fetch_assoc($updated_result)) {
    $row['employee mobile number'] = $updated_row['phone'];
    $row['address'] = $updated_row['address'];
    $row['emergency contact'] = $updated_row['emergency_contact'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="employee.css" />
    <title>Employee Profile</title>
</head>
<body>

<div class="nav-menu">
    <h1>TaskVault</h1>
    <h2 class="role">Hi, <?php echo htmlspecialchars($row['employee name']); ?></h2>
    <a href="employee.php">My Tasks</a>
    <a href="employee_profile.php">Profile</a>
    <a href="employee_logout.php">Logout</a>
</div>

<h2>Profile</h2>
<div class="profile-container">
    <form method="POST">
        <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($row['employee id']); ?></p>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($row['employee name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($row['employee email']); ?></p>

        <p>
            <strong>Phone:</strong> 
            <input type="text" name="phone" value="<?php echo htmlspecialchars($row['employee mobile number']); ?>" 
                <?php echo $is_editing ? '' : 'readonly'; ?>>
        </p>

        <p>
            <strong>Address:</strong>
            <input type="text" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>" 
                <?php echo $is_editing ? '' : 'readonly'; ?>>
        </p>

        <p>
            <strong>Emergency Contact:</strong>
            <input type="text" name="emergency_contact" value="<?php echo htmlspecialchars($row['emergency contact'] ?? ''); ?>" 
                <?php echo $is_editing ? '' : 'readonly'; ?>>
        </p>

        <p><strong>Designation:</strong> <?php echo htmlspecialchars($row['Designation']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender'] ?? ''); ?></p>
        <p><strong>Joining Date:</strong> <?php echo htmlspecialchars($row['date_of_joining']); ?></p>

        <!-- Display buttons based on state -->
        <?php if ($is_editing): ?>
            <button type="submit" name="update_profile">Update</button>
        <?php else: ?>
            <button type="submit" name="edit_profile">Edit</button>
        <?php endif; ?>
    </form>
</div>

</body>
</html>

