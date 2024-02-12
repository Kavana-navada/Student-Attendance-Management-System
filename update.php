<!-- update student,staff,sub record through update button-->
<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Update</title>
</head>
<body>
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
        min-width: 200px;
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
    a{
        text-decoration: none;
        color:  rgb(3, 57, 88);
        cursor: default;
        
    }
    .supdate{
        margin-left: 28%;
        margin-right: 200px;
        
    }
    .supdate:hover{
        background-color: rgb(202, 148, 253);
    }
    #cancelbtn:hover{
        background-color: rgb(202, 148, 253);
    }
    /* #cancelbtn:before{
        content:"";
        position:absolute;
        height: 8px;
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
        height: 8px;
        width:230px;
        background-color: #acb1e6;
        left: 453px;
        right: 0;
        top: 273px;
        transition: width 0.5s,
                    height 0.5s,0.5s;
        margin: auto;
        
    } */
    /* #cancelbtn:hover:before,
    #cancelbtn:hover:after{
        width: 0;
        height: 5px;
        transition: height 0.5s,
                    width 0.5s 0.5s;
                    
    } */

    /* .supdate:before{
        content:"";
        position:absolute;
        height: 8px;
        width:230px;
        background-color: #acb1e6;
        left: -415px;
        right: 0;
        bottom: 414px;
        transition: width 0.5s,
                    height 0.5s,0.5s;
        margin: auto;
    }
    .supdate:after{
        content:"";
        position: absolute;
        height: 8px;
        width:230px;
        background-color: #acb1e6;
        left: -415px;
        right: 0;
        top: 273px;
        transition: width 0.5s,
                    height 0.5s,0.5s;
        margin: auto;
        
    }
    .supdate:hover:before,
    .supdate:hover:after{
        width: 0;
        height: 5px;
        transition: height 0.5s,
                    width 0.5s 0.5s;
                    
    } */

    </style>
</body>
</html>
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
        if (isset($_POST['updatestudbtn']))
        {
            $upreg = $_POST['updatestud_reg'];
            $qry = "SELECT * FROM studinfo WHERE regno='$upreg'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_assoc($result);
                $rno=$row['regno'];
                echo "<h3>Are you sure you want to update the following record?</h3>";
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
                echo "<input type='hidden' name='updatestud_reg' value='$upreg'>";
                echo "<button class='supdate'><a href='updatestud.php?updateregno=".$rno."'>Yes,I want to update</a></button>        
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='cancelbtn'>Cancel</button> ";
                echo "</form>";
            } else {
                echo"<script>alert('No student record found with registration number $upreg');</script>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";
            }
        } 
        
        elseif(isset($_POST['cancelbtn'])){
            echo "<script>window.location.href='studmanagementphp.php';</script>";
        }
        elseif (isset($_POST['updatestaffbtn']))
        {
            $upstaff = $_POST['updatestaff_id'];
            $qry = "SELECT * FROM staffinfo WHERE staffid='$upstaff'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_assoc($result);
                $staffidno=$row['staffid'];
                echo "<h3>Are you sure you want to update the following record?</h3>";
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
                echo "<input type='hidden' name='updatestaff_id' value='$upstaff'>";
                echo "<button class='supdate' ><a href='updatestaff.php?updatestaffid=".$staffidno."'>Yes,I want to update</a></button>            
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='btncancel'>Cancel</button>
                ";
                echo "</form>";
            } else {
                echo"<script>alert('No staff record found with staff-id  $upstaff');</script>";
                echo "<script>window.location.href='staffmanagementphp.php';</script>";
            }
        } 
        
        elseif(isset($_POST['btncancel'])){
            echo "<script>window.location.href='staffmanagementphp.php';</script>";
        }
        elseif (isset($_POST['updatesubbtn']))
        {
            $upsub = $_POST['updatesubject'];
            $qry = "SELECT * FROM subinfo WHERE scode='$upsub'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_assoc($result);
                $subjectcode=$row['scode'];
                echo "<h3>Are you sure you want to update the following record?</h3>";
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
                echo "<input type='hidden' name='updatescode' value='$upsub'>";
                echo "<button class='supdate'><a href='updatesub.php?updatescode=".$subjectcode."'>Yes, I want to Update</a></button>
               
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='btn__cancel'>Cancel</button>";
                echo "</form>";
            } else {
                echo"<script>alert('No subject record found with subject code  $upsub');</script>";
                echo "<script>window.location.href='submanagementphp.php';</script>";

            }
        } 
        
        elseif(isset($_POST['btn__cancel'])){
            echo "<script>window.location.href='submanagementphp.php';</script>";

        }
    }
?>