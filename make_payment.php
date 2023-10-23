<?php
session_start();

// Database connection parameters
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'student_database';

// Create a database connection
$connection = mysqli_connect($db_host, $db_username, $db_password);
$db = mysqli_select_db($connection, $db_name);

// Function to fetch and update the student's dues and fines
function updateStudentDuesAndFines($roll_no, $payment_amount, $payment_type, $payment_date, $connection) {
    $dues_and_fines = array();

    // Fetch the student's dues and fines
    $query = "SELECT roll_no, mess_dues, fees_due, fines_due FROM DUES_INFORMATION WHERE roll_no = $roll_no";
    $query_run = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($query_run)) {
        $mess_dues = $row['mess_dues'];
        $fees_due = $row['fees_due'];
        $fines_due = $row['fines_due'];

        // Calculate the updated dues and fines based on payment type
        $updated_mess_dues = ($payment_type === 'Mess') ? max(0, $mess_dues - $payment_amount) : $mess_dues;
        $updated_fees_due = ($payment_type === 'Fees') ? max(0, $fees_due - $payment_amount) : $fees_due;
        $updated_fines_due = ($payment_type === 'Fines') ? max(0, $fines_due - $payment_amount) : $fines_due;

        // Update the student's dues and fines in the database
        $update_query = "UPDATE DUES_INFORMATION SET mess_dues = $updated_mess_dues, fees_due = $updated_fees_due, fines_due = $updated_fines_due WHERE roll_no = $roll_no";
        $update_query_run = mysqli_query($connection, $update_query);

        if ($update_query_run) {
            return array(
                'mess_dues' => $updated_mess_dues,
                'fees_due' => $updated_fees_due,
                'fines_due' => $updated_fines_due,
                'payment_date' => $payment_date
            );
        } else {
            return null;
        }
    } else {
        return null;
    }
}

// Function to get student dues and fines
function getStudentDuesAndFines($roll_no, $connection) {
    $dues_and_fines = array();

    // Fetch the student's dues and fines
    $query = "SELECT roll_no, mess_dues, fees_due, fines_due FROM DUES_INFORMATION WHERE roll_no = $roll_no";
    $query_run = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($query_run)) {
        $dues_and_fines = array(
            'mess_dues' => $row['mess_dues'],
            'fees_due' => $row['fees_due'],
            'fines_due' => $row['fines_due'],
        );
    }

    return $dues_and_fines;
}

// Initialize variables
$roll_no = '';
$amount = '';
$pay_type = '';

$dues_and_fines = array();

// Check if the form is submitted
if (isset($_POST['record_payment'])) {
    $roll_no = $_POST['roll_no'];
    $amount = $_POST['amount'];
    $pay_type = $_POST['pay_type'];
    $payment_date = $_POST['payment_date'];

    // Get student dues and fines
    $dues_and_fines = getStudentDuesAndFines($roll_no, $connection);

    // Check if the roll number exists
    $check_roll_query = "SELECT roll_no FROM STUDENT_MAIN_INFORMATION WHERE roll_no = $roll_no";
    $check_roll_query_run = mysqli_query($connection, $check_roll_query);

    if (mysqli_num_rows($check_roll_query_run) > 0) {
        // Insert payment record
        $insert_payment_query = "INSERT INTO PAYMENT_RECORDS (pay_type, pay_name, roll_no, date, amount)
                                VALUES ('$pay_type', '', $roll_no, '$payment_date', $amount)";
        $insert_payment_query_run = mysqli_query($connection, $insert_payment_query);

        if ($insert_payment_query_run) {
            // Update the student's dues and fines
            $updated_dues_and_fines = updateStudentDuesAndFines($roll_no, $amount, $pay_type, $payment_date, $connection);

            if ($updated_dues_and_fines) {
                // Display an alert with the updated dues and fines and the payment date
                $message = "Payment recorded successfully.\nUpdated Dues and Fines:\n";
                $message .= "Mess Dues: " . $updated_dues_and_fines['mess_dues'] . "\n";
                $message .= "Fees Due: " . $updated_dues_and_fines['fees_due'] . "\n";
                $message .= "Fines Due: " . $updated_dues_and_fines['fines_due'] . "\n";
                $message .= "Payment Date: " . $updated_dues_and_fines['payment_date'];

                echo "<script>alert('$message');</script>";
            } else {
                echo "Error updating dues and fines.";
            }
        } else {
            echo "Error recording payment: " . mysqli_error($connection);
        }
    } else {
        echo "Roll number does not exist in the STUDENT_MAIN_INFORMATION table.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Make Payment</title>
    <script type="text/javascript">
        function updateDuesAndFines() {
            var roll_no = document.getElementById("roll_no").value;
            window.location.href = "make_payment.php?roll_no=" + roll_no;
        }
        
        function recordPaymentAndDues() {
            document.getElementById("updateDuesBtn").click();
            document.getElementById("recordPaymentBtn").click();
        }
    </script>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php">HOSTEL DATABASE</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="view_profile.php">View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class a class="dropdown-item" href="change_password.php">Change Password</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
        </div>
    </nav><br><br>
    <center><h4>Make Payment</h4><br></center>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="roll_no">Student Roll Number:</label>
                    <input type="text" name="roll_no" id="roll_no" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pay_type">Payment Type:</label>
                    <select name="pay_type" class="form-control" required>
                        <?php
                        $dues_types = array('Mess', 'Fees', 'Fines');
                        foreach ($dues_types as $type) {
                            echo "<option value='$type'>$type</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Payment Amount:</label>
                    <input type="text" name="amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="payment_date">Payment Date:</label>
                    <input type="date" name="payment_date" class="form-control" required>
                </div>
                <button type="button" onclick="recordPaymentAndDues()" class="btn btn-primary">Record Payment & Update Dues</button>
                <button type="submit" name="update_dues" id="updateDuesBtn" style="display: none;"></button>
                <button type="submit" name="record_payment" id="recordPaymentBtn" style="display: none;"></button>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</body>
</html>

