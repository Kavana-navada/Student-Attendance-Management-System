<!-- Delete student record through view button-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete record</title>
</head>
<style>
            
        body{
        background: #f2f5f7;
        }
        h3{
            background: rgb(224, 204, 243);
            height: 30px;
            padding: 20px 20px;
            font-size: 25px;
            align-items: center;
            text-align: center;
            position:fixed;
            right: 0%;
            left: 0%;
            top:0%;
            border:2px solid rgb(202, 148, 253);
            cursor: default;
        }
        table{
            cursor: default;
            table-layout: fixed;
            min-width: 800px;
        margin-left: -0.5%;
            border-collapse: collapse;
            margin-top: 10%;
            background-color: #e9f1f5;
            
        
        }
        th{
            position: sticky;
            top:0;
            background-color: #67a8ea;
            color: rgb(8, 27, 80);
            font-size: 20px;
            text-align: center;
            font-weight: 700;
            height: 40px;
        }
        td{
            background-color: #cfe6fd;
            padding: 5px 20px;
            font-size:20px ;
            word-break:keep-all;
            text-align: center;
            min-width: 180px;
        }
        button{
            height:40px;
            font-size:20px; 
            margin-top: 50px;
            width:230px;
            text-align: center;
            background: #acb1e6;
            color: rgb(3, 57, 88);
            display: inline-block;
            outline: none;
            border: 4px solid rgb(14, 61, 90);
            padding: 3px 10px 5px 10px;
            font-weight: 700;
            cursor: default;
        }
        #sdelete{
            height:60px;
            font-size:20px; 
            margin-top: 50px;
            width:230px;
            text-align: center;
            background: #acb1e6;
            color: rgb(3, 57, 88);
            display: inline-block;
            outline: none;
            border: 4px solid rgb(14, 61, 90);
            padding: 3px 10px 5px 10px;
            font-weight: 700;
            cursor: default;

        }
        a{
            text-decoration: none;
            color:  rgb(3, 57, 88);
            cursor: default;
            
        }
        .sdelete{
            margin-left: 28%;
            margin-right: 200px;
            
        }
        .sdelete:hover{
                background-color: rgb(202, 148, 253);
            }
            #cancelbtn:hover{
                background-color: rgb(202, 148, 253);
            }
        /* #cancelbtn:before{
            content:"";
            position:absolute;
            height: 10px;
            width:230px;
            background-color: #acb1e6;
            left: 453px;
            right: 0;
            bottom: 414px;
            transition: width 0.5s,
                        height 0.5s,0.5s;
            margin: auto;
        }
        #cancelbtn:after{
            content:"";
            position: absolute;
            height: 10px;
            width:230px;
            background-color: #acb1e6;
            left: 453px;
            right: 0;
            top: 273px;
            transition: width 0.5s,
                        height 0.5s,0.5s;
            margin: auto;
            
        }
        #cancelbtn:hover:before,
        #cancelbtn:hover:after{
            width: 0;
            height: 5px;
            transition: height 0.5s,
                        width 0.5s 0.5s;
                        
        }

        .sdelete:before{
            content:"";
            position:absolute;
            height: 10px;
            width:230px;
            background-color: #acb1e6;
            left: -415px;
            right: 0;
            bottom: 414px;
            transition: width 0.5s,
                        height 0.5s,0.5s;
            margin: auto;
        }
        .sdelete:after{
            content:"";
            position: absolute;
            height: 10px;
            width:230px;
            background-color: #acb1e6;
            left: -415px;
            right: 0;
            top: 273px;
            transition: width 0.5s,
                        height 0.5s,0.5s;
            margin: auto;
            
        }
        .sdelete:hover:before,
        .sdelete:hover:after{
            width: 0;
            height: 5px;
            transition: height 0.5s,
                        width 0.5s 0.5s;
                        
        } */
    </style>
<body>
    
</body>
</html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        if(isset($_GET['deleteregno']))
        {
            $regno=$_GET['deleteregno'];
            $qry="DELETE FROM studinfo WHERE regno='$regno'";
            $result=mysqli_query($conn,$qry);
            if($result)
            {
                echo"<script>alert('Student record with registration number $regno deleted successfully');</script>";
                echo"<script>window.location.href='studmanagementphp.php';</script>";
                exit();

            }
        }
    } 
?>
<!-- Delete student record through delete button-->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        if (isset($_POST['deletestudbtn']))
        {
            $delreg = $_POST['deletestud_reg'];
            $qry = "SELECT * FROM studinfo WHERE regno='$delreg'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h3>Are you sure you want to delete the following record?</h3>";
                echo'
                <div class="table">
                <table border="1">
                    <tr id="header">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll Number</th>
                        <th>Register Number</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Contact Number</th>
                        <th>Parent Contact</th>
                        <th>Email Id</th>
                        <th>Password</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Course</th>
                        
                    </tr>';echo"
                    
                    <tr>
                        <td>".$row['firstname']."</td>
                        <td>".$row['lastname']."</td>
                        <td>".$row['rollno']."</td>
                        <td>".$row['regno']."</td>
                        <td>".$row['fathername']."</td>
                        <td>".$row['mothername']."</td>
                        <td>".$row['contact']."</td>
                        <td>".$row['pcontact']."</td>
                        <td>".$row['email']."</td> 
                        <td>".$row['password']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['gender']."</td>
                        <td>".$row['dob']."</td>
                        <td>".$row['clas']."</td>
                        <td>".$row['sem']."</td>
                        <td>".$row['course']."</td>

                    </tr>
                                        
                </table>
                </div>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='deletestud_reg' value='$delreg'>";
                echo "<button type='submit' class='sdelete' name='confirmdelete' value='Yes, delete record'>Yes, delete record</button>
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='cancelbtn'>Cancel</button>";
                echo "</form>";
            } else {
                echo"<script>alert('No student record found with registration number $delreg');</script>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";
            }
        } 
        elseif (isset($_POST['confirmdelete'])) {
            $delreg = $_POST['deletestud_reg'];
            $qry = "DELETE FROM studinfo WHERE regno='$delreg'";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                echo "<script>alert('Student record of registration number $delreg deleted successfully');</script>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";
            } else {
                echo "<script>alert('failed to delete student record');</script>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";
            }
        }
        elseif(isset($_POST['cancelbtn'])){
            echo "<script>window.location.href='studmanagementphp.php';</script>";
        }
    }
?>
<!-- Delete staff record through view button-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else
{
    if(isset($_GET['deletestaffid']))
    {
        $staffid=$_GET['deletestaffid'];
        $qry="DELETE FROM staffinfo WHERE staffid='$staffid'";
        $result=mysqli_query($conn,$qry);
        if($result)
        {
            echo"<script>alert('Staff record with staffid $staffid deleted successfully');</script>";
            echo"<script>window.location.href='staffmanagementphp.php';</script>";
            exit();

        }
    }
} 
?>
<!-- Delete staff record through delete button-->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        if (isset($_POST['deletestaffbtn']))
        {
            $delstaff = $_POST['deletestaff_id'];
            $qry = "SELECT * FROM staffinfo WHERE staffid='$delstaff'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h3>Are you sure you want to delete the following record?</h3>";
                echo'
                <div class="table">
                <table border="1">
                    <tr id="header">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th> Staff ID</th>
                        <th>Contact Number</th>
                        <th>Email Id</th>
                        <th>Password</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>DOJ</th>
                        <th>Experience in Years</th>
                        <th>Experience in Months</th>
                        <th>Qualification</th>
                        <th>Department</th>
                        
                    </tr>';echo"
                    
                    <tr>
                        <td>".$row['firstname']."</td>
                        <td>".$row['lastname']."</td>
                        <td>".$row['staffid']."</td>
                        <td>".$row['contact']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['password']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['gender']."</td>
                        <td>".$row['dob']."</td>
                        <td>".$row['dojj']."</td>
                        <td>".$row['yearexp']."</td>
                        <td>".$row['monthexp']."</td>
                        <td>".$row['qualification']."</td>
                        <td>".$row['dept']."</td>

                    </tr>
                                        
                </table>
                </div>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='deletestaffid' value='$delstaff'>";
                echo "<button type='submit' class='sdelete' name='confirmstaffdelete' value='Yes, delete record'>Yes, delete record</button>
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='cancelstaffbtn'>Cancel</button>
                ";
                echo "</form>";
            } else {
                echo"<script>alert('No staff record found with staff id $delstaff');</script>";
                echo "<script>window.location.href='staffmanagementphp.php';</script>";

            }
        } 
        elseif (isset($_POST['confirmstaffdelete'])) {
            $deletestaff = $_POST['deletestaffid'];
            $qry = "DELETE FROM staffinfo WHERE staffid='$deletestaff'";
            $result = mysqli_query($conn, $qry);

            if ($result) {
                echo "<script>alert('Record with staff-id $deletestaff deleted successfully');</script>";
               echo "<script>window.location.href='staffmanagementphp.php';</script>";
            } else {
                echo "<script>alert('failed to delete staff record');</script>";
                echo "<script>window.location.href='staffmanagementphp.php';</script>";
            }
        }
        elseif(isset($_POST['cancelstaffbtn'])){
            echo "<script>window.location.href='staffmanagementphp.php';</script>";
        }
    }
?>

<!-- Delete subject record through view button-->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        if(isset($_GET['deletesubcode']))
        {
            $scode=$_GET['deletesubcode'];
            $qry="DELETE FROM subinfo WHERE scode='$scode'";
            $result=mysqli_query($conn,$qry);
            if($result)
            {
                echo"<script>alert('Subject record with scode $scode deleted successfully');</script>";
                echo"<script>window.location.href='submanagementphp.php';</script>";
                exit();
            }
        }
    } 
?>
<!-- Delete subject record through delete button-->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        if (isset($_POST['deletesubbtn']))
        {
            $delsub = $_POST['deletesubject'];
            $qry = "SELECT * FROM subinfo WHERE scode='$delsub'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h3>Are you sure you want to delete the following record?</h3>";
                echo'
                <div class="table">
                <table border="1">
                    <tr id="header">
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Course</th>
                    <th>Staff Department</th>
                    <th>Staff-Id</th>
                    <th>Staff Name</th>
                        
                    </tr>';echo"
                    
                    <tr>
                        <td>".$row['scode']."</td>
                        <td>".$row['sname']."</td>
                        <td>".$row['clas']."</td>
                        <td>".$row['sem']."</td>
                        <td>".$row['course']."</td>
                        <td>".$row['dept']."</td>
                        <td>".$row['staffid']."</td>
                        <td>".$row['staffname']."</td>
                       
                    </tr>
                                        
                </table>
                </div>";

              
                echo "<form method='POST'>";
                echo "<input type='hidden' name='deletesubcode' value='$delsub'>";
                echo "<button type='submit' class='sdelete' name='confirmsubdelete'  value='Yes, delete record'>Yes, delete record</button>
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='cancelsubbtn'>Cancel</button>
                ";
                echo "</form>";
            } else {
                echo"<script>alert('No subject record found with scode $delsub');</script>";
                echo "<script>window.location.href='submanagementphp.php';</script>";

            }
        } 
        elseif (isset($_POST['confirmsubdelete'])) {
            $deletesub = $_POST['deletesubcode'];
            $qry = "DELETE FROM subinfo WHERE scode='$deletesub'";
            $result = mysqli_query($conn, $qry);

            if ($result) {
                echo "<script>alert('Record with scode $deletesub deleted successfully');</script>";
               echo "<script>window.location.href='submanagementphp.php';</script>";
               exit();
            } else {
                echo "<script>alert('failed to delete subject record');</script>";
                echo "<script>window.location.href='submanagementphp.php';</script>";

            }
        }
        elseif(isset($_POST['cancelsubbtn'])){
            echo "<script>window.location.href='submanagementphp.php';</script>";

        }
    }
?>
