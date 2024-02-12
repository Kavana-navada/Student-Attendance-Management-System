<?php 
session_start();
$user = $_SESSION['user'];
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$query = "SELECT * FROM staffinfo WHERE email = '$user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$staffname=$row['firstname'].' '.$row['lastname'];
?>
<!DOCTYPE html>
<html >
<head>
   
    <link rel="stylesheet" type="text/css" href="staffcss.css">
    
    <title>Staff</title>
</head>
<body>
    <div class="container" >
        <nav id="slidebar" >
            <ul>
            <li>
                <a href="#" class="staff">
                 <img class="staffimg" src="../Pictures/profile.png" >
                 <span class="mainitem">STAFF</span>
                </a>
            </li>


            <li>
                <a href="todaysattendance.php" class="staffitem" >
                 <img src="../Pictures/todaysattendence.png" >
                 <span class="item">Today's Attendence</span>
                </a>
            </li>

            <li>
                <a href="" class="staffitem" >
                 <img src="../Pictures/updateattendance.png" >
                 <span class="item">Update Attendance</span>
                </a>
            </li>

            <li>
                <a href="staffreport.php" class="staffitem" >
                 <img src="../Pictures/attendence_report.png" >
                 <span class="item">Attendance Report</span>
                </a>
            </li>
            <li>
                <a href="../home.html" class="staffitem" id="logoutitem" >
                 <img src="../Pictures/logout1.png" >
                 <span class="item">Logout</span>
                </a>
            </li>


            </ul>
        </nav>
        <section class="main">
            <div class="topheading">
                <h1> Dashboard</h1> 
                <?php
                    $pngImagePath = '../Pictures/profile.png';
                    $buttonValue = $staffname;
                    echo '<button type="submit" class="myprofile" onclick="togglemenu()">';
                    echo '<img class="profileimg" src="' . $pngImagePath . '" >';
                    echo $buttonValue;
                    echo '</button>';  
                ?>
            </div>
            <div class="sub-menu-wrap" id="sub-menu">
                <div class="sub-menu">
                    <div class="user-info">
                
                        <h2 id="name" ><?php echo $staffname; ?></h2>
                        <hr>
                        <div id="oneline">
                            <label>Staff-ID</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>:</span>&nbsp;&nbsp;
                            <label id="value"><?php echo $row['staffid']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Department</label>
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['dept']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['email']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Password</label>&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['password']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['address']; ?></label>
                        </div>

                    
                        <div id="oneline">
                        <label>Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['gender']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Contact</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['contact']; ?></label>
                        </div>
                    </div>
                </div>  
            </div>
        </section>
        
    </div>
    <script>
        
            let submenu=document.getElementById("sub-menu");
            function togglemenu(){
                submenu.classList.toggle("open-menu");
               // document.getElementById("sub-menu").style.display="block";
        }
        </script>
    
</body>
</html> 



