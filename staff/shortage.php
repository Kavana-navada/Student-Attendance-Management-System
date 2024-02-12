<?php
    $course = $_GET['course'];
    $class = $_GET['class'];
    $sub = $_GET['sub'];
    $sem = $_GET['sem'];
    $sid = $_GET['sid'];
    $today=date('Y-m-d');
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
    <link rel="stylesheet" type="text/css" href="reportcss.css">
</head>
<style>
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
    .export{
        background:linear-gradient(to right,rgb(232, 217, 245),rgb(234, 230, 230));
        color: rgb(8, 8, 8);
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        font-size: 18px;
        border:2px solid purple;
        
    
    }
    .export:hover {
        background:linear-gradient(to right,rgb(210, 180, 239),rgb(234, 230, 230),rgb(210, 180, 239));
    }
    a{
        color:black;
        text-decoration:none;
    }
   
    </style>
<body>
    <h2>Attendance Report</h2>
    <form method="POST" action="">
   
        <label for="firstDate">Starting Date:
        <input type="date" id="firstDate" max="<?php echo date('Y-m-d'); ?>" name="firstDate" value="<?php if(isset($_POST["firstDate"])){ echo $_POST["firstDate"]; } ?>"></label>

        <label for="secondDate">Ending Date:
        <input type="date" id="secondDate"  max="<?php echo date('Y-m-d'); ?>" name="secondDate" value="<?php if(isset($_POST["secondDate"])){ echo $_POST["secondDate"]; } ?>"></label>

        <button type="submit" name="filter">Filter Student</button>
        <button type="submit" name="backbtn" value="Back">Back</button>
    </form>
</body>
</html>
<?php
if (isset($_POST['filter'])) {
    $start_date = new DateTime($_POST['firstDate']);
    $end_date = new DateTime($_POST['secondDate']);
    if (empty($_POST['firstDate']) || empty($_POST['secondDate']))  {
        echo "<script>alert('Please select two dates.');</script>";
    } else{
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
            $sql = "SELECT name, rollno, adate, hours FROM attendance WHERE adate BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "' AND sid='".$sid."'";
            $result = $conn->query($sql);
            $attendance = array();
            $student_totals = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $student_name = $row['name'];
                    $roll_no = $row['rollno'];
                    $date = $row['adate'];
                    $attendedclass = $row['hours'];

                    $attendance[$student_name][$roll_no][$date] = $attendedclass;

                    if (!isset($student_totals[$student_name][$roll_no])) {
                        $student_totals[$student_name][$roll_no] = array(
                            'attended' => 0,
                            'total' => 0
                        );
                    }
                    $student_totals[$student_name][$roll_no]['attended'] += $attendedclass;
                    $student_totals[$student_name][$roll_no]['total'] += 1;
                }
            } 
            $start = new DateTime($start_date->format('Y-m-d'));
            $end = new DateTime($end_date->format('Y-m-d'));
            $end->add(new DateInterval('P1D')); 
            $interval = new DateInterval('P1D');
            $date_range = new DatePeriod($start, $interval, $end);

            echo "<div class='container' style='height: 550px; width:98%; overflow-y: auto; position:absolute;'>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Roll No</th>";

            foreach ($date_range as $date) {
                $formatted_date = $date->format('Y-m-d');
                $sql = "SELECT tclass FROM attendance WHERE adate = '". $formatted_date."'AND sid='".$sid."'";
                $formatted_date1 = $date->format('d-m-Y');
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<th >".$formatted_date1 ."<br><span id='tbheading'>Total class : ".$row['tclass']."</span></th>";
                }
                else{
                    echo "<th >".$formatted_date1 ."<br><span id='tbheading'>Attendance not recorded</span></th>";                 
                }
            }
            echo "<th>Present/Total Class</th>";
            echo "<th>Percentage</th>";
            echo "</tr>";

            $sql = "SELECT rollno FROM attendance where sid=".$sid."";
                $result = $conn->query($sql);
            foreach ($attendance as $student_name => $roll_nos) {

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
                    if($per<75){


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
                    
                    echo "<td>".$hours."/".$tclass."</td>";
                    echo "<td>$per %</td>";
                    }
                    echo "</tr>";
                }
            }

            echo "</table>";
            echo'<button id="thirdbutton" style="position:sticky;left: 650px;z-index: 1;" class="export"><a href="new1.php">Export to Excel</a></button><br><br>';

            echo"</div>";
            $table = "<tr><th>Name</th><th>Roll No</th>";

foreach ($date_range as $date) {
    $formatted_date = $date->format('Y-m-d');
    $sql = "SELECT tclass FROM attendance WHERE adate = '". $formatted_date."' AND sid='".$sid."'";
    $formatted_date1 = $date->format('d-m-Y');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $table .= "<th >".$formatted_date1 ."<br><span id='tbheading'>Total class : ".$row['tclass']."</span></th>";
    } else {
        $table .= "<th >".$formatted_date1 ."<br><span id='tbheading'>Attendance not recorded</span></th>";                 
    }
}

$table .= "<th>(Present/Total Class)</th>";
$table .= "<th>Percentage</th>";
$table .= "</tr>";

$sql = "SELECT rollno FROM attendance where sid=".$sid."";
$result = $conn->query($sql);
foreach ($attendance as $student_name => $roll_nos) {

    if ($result->num_rows > 0) {
        $hours = 0;
        $tclass = 0;
        $per = 0.00; 
        $row = $result->fetch_assoc();
        $sql1= "SELECT tclass,hours FROM attendance where rollno=".$row['rollno']." AND adate BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "' AND sid='".$sid."'";
        $result1= $conn->query($sql1);
        while ($row1 = $result1->fetch_assoc()){
            $hours = $hours + $row1['hours'];
            $tclass = $tclass + $row1['tclass'];
            $per = number_format(($hours / $tclass * 100), 2);
        }
        if ($per < 75) {
            $num_roll_nos = count($roll_nos);
            $rowspan = $num_roll_nos > 1 ? "rowspan=\"$num_roll_nos\"" : "";

            foreach ($roll_nos as $roll_no => $student_attendance) {
                $table .= "<tr><td $rowspan>$student_name</td><td $rowspan>$roll_no</td>";

                // Display attendance for each date
                foreach ($date_range as $date) {
                    $formatted_date = $date->format('Y-m-d');
                    $attendedclass = isset($student_attendance[$formatted_date]) ? $student_attendance[$formatted_date] : 'N/A';
                    $table .= "<td>$attendedclass</td>";
                }
            }

            $table .= "<td>(".$hours."/".$tclass.")</td>";
            $table .= "<td>$per %</td>";
        }
        $table .= "</tr>";
    }
}
$table .= "</table>";

$_SESSION['exportedTable'] = $table;
            $conn->close();
        }
    }
} elseif (isset($_POST['backbtn'])) {
    echo "<script>window.location.href='staffreport.php';</script>";
}
?>