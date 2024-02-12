<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'attendance';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(isset($_POST['submitAttendance']))
    {
        $course= $_GET['course'];
        $class= $_GET['class'];
        $sub=$_GET['sub'];
        $sem=$_GET['sem']; 
        $sid=$_GET['sid'];
        $student=[];
        $h=$_POST['hours'];
        $date=$_POST['date'];
        $query = "SELECT * FROM studinfo WHERE course = '$course' and clas = '$class' and sem = '$sem'";
        $result = mysqli_query($conn, $query);
        $rowCount = $result->num_rows;
        for ($i = 0; $i < $rowCount; $i++) {
            $row = mysqli_fetch_assoc($result);
            $name=$row['rollno'];
            if (isset($_POST[$name])){
            $student[$i]=$h;
            }
            else{
                $student[$i]=0;
            }
        }
        $query1 = "SELECT * FROM studinfo WHERE course = '$course' and clas = '$class' and sem = '$sem'";
        $result1 = mysqli_query($conn, $query1);
        $flag=1;
    foreach($student as $a){       
        $row1 = mysqli_fetch_assoc($result1);
        $sdate=$date;
        $rollno=$row1['rollno'];
        $name=$row1['firstname'].' '.$row1['lastname'];
        $hours=$a;
        $regno=$row1['regno'];
        $query = "INSERT INTO attendance (adate, rollno, name, hours, regno, sid,tclass) VALUES ('$sdate', $rollno, '$name', $hours, $regno, '$sid', '$h')";
        if (mysqli_query($conn, $query)) {
            
        } else {
            $flag=0;
        }
    }
    if($flag==1){
        echo"<script>alert('Attendance submission successfull');</script>";
        echo"<script>window.location.href='todaysattendance.php';</script>";
    }
    else{
        echo"<script>alert('Attendance submission failed');</script>";
        echo"<script>window.location.href='tattendance.php';</script>";
    }
    }
    elseif(isset($_POST['backbtn'])){
        echo"<script>window.location.href='updateattendance.php';</script>";
    }
    elseif (isset($_POST['updateAttendance'])) {
        $course = $_GET['course'];
        $class = $_GET['class'];
        $sem = $_GET['sem'];
        $sub = $_GET['sub'];
        $sid = $_GET['sid'];
        $cDate=$_GET['cDate'];
        foreach ($_POST as $key => $value) {
            if ($key != 'updateAttendance' && $key != 'backbtn'&& $key != 'deleteAttendance') {
                $rollno = mysqli_real_escape_string($conn, $key);
                $hours = mysqli_real_escape_string($conn, $value);
                $query = "UPDATE attendance SET hours = '$hours' WHERE adate = '$cDate' AND sid = '$sid' AND rollno = '$rollno'";
                if (mysqli_query($conn, $query)) {
                    echo"<script>alert('Attendance updated successfully');</script>";
                    echo"<script>window.location.href='updateattendance.php';</script>";
                } else {
                    echo"<script>alert('Failed!');</script>";
                    echo"<script>window.location.href='upattendance.php';</script>";
                }
            }
        }
    }

    elseif(isset($_POST['deleteAttendance']))
    {       
    $sid=$_GET['sid'];
        $date=$_POST['date'];
        $query = "DELETE FROM attendance WHERE sid = '$sid' AND adate = '$date' ";
        if (mysqli_query($conn, $query)) {
            echo"<script>alert('Attendance deleted successfully');</script>";
            echo"<script>window.location.href='updateattendance.php';</script>";
        } else {
            echo"<script>alert('Failed!');</script>";
            echo"<script>window.location.href='upattendance.php';</script>";
        }
    }
    mysqli_close($conn);


?>