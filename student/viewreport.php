<?php
$sid = $_GET['sid'];
$sname=$_GET['sname'];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

$email = $_SESSION['user'];

$query = "SELECT * FROM studinfo WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row1 = mysqli_fetch_assoc($result);
$clas=$row1['clas'];
$sem=$row1['sem'];
$course=$row1['course'];
$regno=$row1['regno'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Attendance Report</title>
    <link rel="stylesheet" type="text/css" href="../staff/reportcss.css">
    <style>
        th {
            background-color:rgb(158, 157, 250);
        }
        h2{
            background:linear-gradient(45deg,rgb(158, 157, 250),rgba(243, 232, 232, 1),rgb(158, 157, 250),rgba(245, 242, 242, 1),rgb(158, 157, 250),rgba(249, 244, 244, 1),rgb(158, 157, 250),rgba(240, 236, 236, 1),rgb(158, 157, 250));
        }
        th:nth-child(1), /* Select the first column header */
        td:nth-child(1) { /* Select the first column cells */
        position: sticky;
        left: 0;
        z-index: 1; /* Ensure the sticky column appears above the rest of the table */
        
        }
        

        tr:nth-child(even) td:first-child {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) td:first-child {
            background-color:white;
        }
        tr:nth-child(even)  td:nth-child(2) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) td:nth-child(2) {
            background-color:white;
        }

        th:nth-child(2), /* Select the second column header */
        td:nth-child(2) { /* Select the second column cells */
        position: sticky;
        left: 200px; /* Adjust the left value to align the columns correctly */
        z-index: 1;
        
        }
        </style>
</head>
<body>
    <h2>ATTENDANCE REPORT</h2>
    <form method="POST" action="">
        <label for="firstDate">Starting Date:
        <input type="date" id="firstDate"  max="<?php echo date('Y-m-d'); ?>" name="firstDate" value="<?php if(isset($_POST["firstDate"])){ echo $_POST["firstDate"]; } ?>"></label>

        <label for="secondDate">Ending Date:
        <input type="date" id="secondDate" max="<?php echo date('Y-m-d'); ?>" name="secondDate" value="<?php if(isset($_POST["secondDate"])){ echo $_POST["secondDate"]; } ?>"></label>

        <button type="submit" name="filter">Filter</button>
        <button type="submit" name="backbtn" value="Back">Back</button>
    </form>
</body>
</html>
<?php
if (isset($_POST['filter'])) {
    $start_date = new DateTime($_POST['firstDate']);
    $end_date = new DateTime($_POST['secondDate']);

    // Check if two dates are selected
    if (empty($_POST['firstDate']) || empty($_POST['secondDate']))  {
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

            // Query to fetch attendance data within the specified date range
            $sql = "SELECT name, rollno, adate, hours FROM attendance WHERE adate BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "' AND sid='".$sid."' AND regno='".$regno."'";
            $result = $conn->query($sql);

            // Array to store attendance data
            $attendance = array();
            $student_totals = array();

            // Fetch and store the attendance data in the array
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $student_name = $row['name'];
                    $roll_no = $row['rollno'];
                    $date = $row['adate'];
                    $attendedclass = $row['hours'];

                    $attendance[$student_name][$roll_no][$date] = $attendedclass;

                    // Calculate student totals
                    if (!isset($student_totals[$student_name][$roll_no])) {
                        $student_totals[$student_name][$roll_no] = array(
                            'attended' => 0,
                            'total' => 0
                        );
                    }
                    $student_totals[$student_name][$roll_no]['attended'] += $attendedclass;
                    $student_totals[$student_name][$roll_no]['total'] += 1; // Increment total by 1 for each attendance record
                }
            }

            // Generate an array of all dates within the range
            $start = new DateTime($start_date->format('Y-m-d'));
            $end = new DateTime($end_date->format('Y-m-d'));
            $end->add(new DateInterval('P1D')); // Add one day to the end date
            $interval = new DateInterval('P1D');
            $date_range = new DatePeriod($start, $interval, $end);

            // Display the attendance report
            echo "<div class='container'>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Roll No</th>";

            // Display the date headings
            foreach ($date_range as $date) {
                $formatted_date = $date->format('Y-m-d');
                $sql = "SELECT tclass FROM attendance WHERE adate = '". $formatted_date."' AND sid='".$sid."' AND regno='".$regno."'";
                $formatted_date1 = $date->format('d-m-Y');
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                echo "<th >".$formatted_date1 ."<br><span id='tbheading'>Total class : ".$row['tclass']."</span></th>";                }
                else{
                    echo "<th >".$formatted_date1 ."<br><span id='tbheading'>Attendance not recorded</span></th>";
                }
            }
            echo "<th>Present/Total Class</th>";
            echo "<th>Percentage</th>";
            echo "</tr>";

            $sql = "SELECT rollno FROM attendance where sid='".$sid."' AND regno='".$regno."'";
                $result = $conn->query($sql);
            // Display the attendance data for each student
            foreach ($attendance as $student_name => $roll_nos) {
                $num_roll_nos = count($roll_nos);
                $rowspan = $num_roll_nos > 1 ? "rowspan=\"$num_roll_nos\"" : "";

                foreach ($roll_nos as $roll_no => $student_attendance) {
                    echo "<tr><td $rowspan>$student_name</td><td $rowspan>$roll_no</td>";

                    // Display attendance for each date
                    foreach ($date_range as $date) {
                        $formatted_date = $date->format('Y-m-d');
                        $attendedclass = isset($student_attendance[$formatted_date]) ? $student_attendance[$formatted_date] : 'N/A';
                        echo "<td>$attendedclass</td>";
                    }
                }
                
                    if ($result->num_rows > 0) {
                    $hours=0;
                    $tclass=0;
                    $per=0.00; 
                    $row = $result->fetch_assoc();
                    $sql1= "SELECT tclass,hours FROM attendance where rollno=".$row['rollno']." AND adate BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "' AND sid='".$sid."'";
                    $result1= $conn->query($sql1);
                    while ($row1 = $result1->fetch_assoc()){
                        $hours=$hours+$row1['hours'];
                        $tclass=$tclass+$row1['tclass'];
                        $per=number_format(($hours/$tclass*100), 2);
                    }
                    echo "<td>".$hours."/".$tclass."</td>";
                    if($per<75){
                        echo "<td style='color:red;font-weight:bold;'>$per %</td>";
                    }
                    else{
                        echo "<td >$per %</td>";
                    }
                    
                    

                    }
                    echo "</tr>";
                
            }
            echo "</table>";
            echo"</div>";
            $conn->close();
        }
    }
} elseif (isset($_POST['backbtn'])) {
    echo "<script>window.location.href='viewattendance.php';</script>";
}
?>