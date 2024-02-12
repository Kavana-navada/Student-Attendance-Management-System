<?php
$course = $_GET['course'];
$class = $_GET['class'];
$sub = $_GET['sub'];
$sem = $_GET['sem'];
$sid = $_GET['sid'];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

$email = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
</head>
<body>
    <h2>Reports</h2>
    <?php
    
    ?>
</body>
</html>

<?php
// Assuming you have a database connection established

// Check if the "Filter Student" button is clicked
echo'<form method="POST" action="">
        <label for="firstDate">Starting Date:</label>
        <input type="date" id="firstDate" value="'.$start_date.'" name="firstDate">

        <label for="secondDate">Ending Date:</label>
        <input type="date" id="secondDate" value="'.$end_date.'" name="secondDate">

        <button type="submit" name="filter">Filter Student</button>
        <button type="submit" name="backbtn" value="Back">Back</button>
    </form>';
if (isset($_POST['filter'])) {
    $start_date = new DateTime($_POST['firstDate']);
    $end_date = new DateTime($_POST['secondDate']);

    // Check if two dates are selected
    if (empty($start_date) || empty($end_date)) {
        echo "<script>alert('Please select two dates.');</script>";
    } else {
        // Check if first date is greater than second date
        if ($start_date > $end_date) {
            echo "<script>alert('Invalid date range. First date should be less than or equal to the second date.');</script>";
        } else {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "attendance";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // $sql = "SELECT DISTINCT rollno, name, adate FROM attendance WHERE adate >= '" . $start_date->format('Y-m-d') . "' AND adate <= '" . $end_date->format('Y-m-d') . "'";

            // Query to fetch attendance data within the specified date range
            $sql = "SELECT DISTINCT adate FROM attendance WHERE adate BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "'";
            $result = $conn->query($sql);

            // Array to store unique dates
            $dates = array();

            // Fetch and store the unique dates in the array
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dates[] = $row['adate'];
                }
            }

            // Query to fetch attendance data for each student within the specified date range
            $sql = "SELECT name, adate, hours FROM attendance WHERE adate BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "' AND sid='".$sid."'";
            $result = $conn->query($sql);

            // Array to store attendance data
            $attendance = array();

            // Fetch and store the attendance data in the array
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $student_name = $row['name'];
                    $date = $row['adate'];
                    $attendedclass = $row['hours'];

                    $attendance[$student_name][$date] = $attendedclass;
                }
            }

            // Display the attendance report
            echo "<table>";
            echo "<tr><th>Student Name</th>";

            // Display the date headings
            foreach ($dates as $date) {
                echo "<th>$date</th>";
            }
            echo "</tr>";

            // Display the attendance data for each student
            foreach ($attendance as $student_name => $student_attendance) {
                echo "<tr><td>$student_name</td>";

                // Display attendance for each date
                foreach ($dates as $date) {
                    $attendedclass = isset($student_attendance[$date]) ? $student_attendance[$date] : '-';
                    echo "<td>$attendedclass</td>";
                }

                echo "</tr>";
            }

            echo "</table>";

            // Close the database connection
            $conn->close();
        }
    }
} elseif (isset($_POST['backbtn'])) {
    echo "<script>window.location.href='staffreport.php';</script>";
}
?>
