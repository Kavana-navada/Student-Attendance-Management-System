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
    $issued=$_GET['issued'];
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
    $sdate=date('Y-m-d');
    $rollno=$row1['rollno'];
    $name=$row1['firstname'].' '.$row1['lastname'];
    $hours=$a;
    $regno=$row1['regno']; 
    if($issued=='no'){
    $query = "INSERT INTO attendance (adate, rollno, name, hours, regno, sid,tclass) VALUES ('$sdate', $rollno, '$name', $hours, $regno, '$sid', '$h')";
    if (mysqli_query($conn, $query)) {
        
      } else {
        $flag=0;
      }
    }
    else{
        $query = "SELECT * FROM attendance WHERE adate = '$sdate' and sid = '$sid' and regno = '$regno'";
        $hr=0;
        $thr=0;
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $hr=intval($row['hours'])+$hours;
        $thr=intval($row['tclass'])+$h;
        $query = "UPDATE attendance SET hours = $hr,tclass = $thr WHERE adate = '$sdate' AND sid = '$sid' and regno = '$regno' ";
        if (mysqli_query($conn, $query)) {
        
        } else {
          $flag=0;
        }
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
    echo"<script>window.location.href='todaysattendance.php';</script>";
}
?>