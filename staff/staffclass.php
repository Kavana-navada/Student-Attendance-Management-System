<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

$email=$_SESSION['user'];


$query = "SELECT staffid FROM staffinfo WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row1 = mysqli_fetch_assoc($result);
$teacher=$row1['staffid'];

$query1 = "SELECT * FROM subinfo WHERE staffid = '$teacher'";
$result1 = mysqli_query($conn, $query1);
while ($row = mysqli_fetch_assoc($result1))
{
    echo'
    <div>
    <label>'.$row["course"].'</label><br>
    <label>'.$row["clas"].'</label><br>
    <label>'.$row["sem"].'</label><br>
    <label>'.$row["sname"].'</label><br>
    <a href="tattendance.php?course=' . $row["course"] . '&class=' . $row["clas"] . '&sem=' . $row["sem"] . '&sub=' . $row["sname"] . '"><button>mark attendance</button></a>
    </div>';
}
?>