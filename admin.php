<?php 
    session_start();
    $user = $_SESSION['user'];
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'attendance';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $query = "SELECT * FROM admin WHERE email = '$user'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $adminname=$row['name'];
?>
<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="admincss.css">
            <title>Admin</title>
        </head>
        <body>
        <div class="container" >
            <nav id="slidebar" >
                <ul>
                <li>
                    <a href="#" class="admin">
                    <img class="adminimg" src="Pictures/profileimg.png" >
                    <span class="mainitem">ADMIN</span>
                    </a>
                </li>

                <li>
                    <a href="admin.php" class="adminitem" id="dashboard">
                    <img src="Pictures/dashboard.png" >
                    <span class="item">Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="studmanagementphp.php" class="adminitem" id="stud">
                    <img src="Pictures/student_management.png" >
                    <span class="item">Student Management</span>
                    </a>
                </li>

                <li>
                    <a href="staffmanagementphp.php" class="adminitem" >
                    <img src="Pictures/staff_management.png" >
                    <span class="item">Staff Management</span>
                    </a>
                </li>

                <li>
                    <a href="submanagementphp.php" class="adminitem" id="sub">
                    <img src="Pictures/subject_management.png" >
                    <span class="item">Subject Management</span>
                    </a>
                </li>

                <li>
                    <a href="attmanagement.php" class="adminitem" >
                    <img src="Pictures/attendence_report.png" >
                    <span class="item">Attendance Report</span>
                    </a>
                </li>
                
                <li>
                    <a href="home.html" class="adminitem" id="logoutitem" >
                    <img src="Pictures/logout1.png" >
                    <span class="item">Logout</span>
                    </a>
                </li>
                </ul>
            </nav>
            <section class="main">
                <div class="topheading">
                    <h1> DASHBOARD</h1>
                    <?php
                        $pngImagePath = 'Pictures/profile.png';
                        $buttonValue = $adminname;
                        echo '<button type="submit" class="myprofile" onclick="togglemenu()">';
                        echo '<img class="profileimg" src="' . $pngImagePath . '" >';
                        echo $buttonValue;
                        echo '</button>';  
                    ?>
                </div>
                
                <div class="sub-menu-wrap" id="sub-menu">
                    <div class="sub-menu">
                        <div class="user-info">                
                        <h2 id="name" ><?php echo $adminname; ?></h2>
                        <hr>
                            <div id="oneline">
                            <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>:</span>&nbsp;&nbsp;
                            <label id="value"><?php echo $row['email']; ?></label>
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
                            <input type="submit" id="updatemyprofile" name="update" value="Update My Profile" onclick="window.location.href='myprofile.php';">
                        </div>
                    </div>                 
                </div>
                <section class="main1">
                    <div class="main-skills">
                        <div class="card">
                            <div id="imgno">
                                <img class="cardimg" src="Pictures/student_management.png" >
                                    <?php
                                        $qry="select count(*) from studinfo";
                                        $rslt=$conn->query($qry);
                                        while($rows=mysqli_fetch_array($rslt))
                                        {
                                            echo'<h3>'. $rows['count(*)'].'</h3>';                      
                                        }
                                    ?>
                            </div>
                        <label> Total Number of Students</label>
                        </div>
                        <div class="card">
                            <div id="imgno">
                                <img class="cardimg"  src="Pictures/staff_management.png" >
                                    <?php
                                        $qry="select count(*) from staffinfo";
                                        $rslt=$conn->query($qry);
                                        while($rows=mysqli_fetch_array($rslt))
                                        {
                                            echo'<h3>'. $rows['count(*)'].'</h3>';
                                        }
                                    ?>
                                </div>
                            <label>Total Number of Staff</label>
                        </div>
                        <div class="card">
                            <div id="imgno">
                                <img class="cardimg"  src="Pictures/subject_management.png" >
                                    <?php
                                        $qry = "SELECT COUNT(DISTINCT course) AS unique_courses FROM studinfo";
                                        $rslt = mysqli_query($conn, $qry);
                                        $row = mysqli_fetch_assoc($rslt);                                   
                                        echo'<h3>'.$row['unique_courses'].'</h3>';                                  
                                    ?>
                                </div>
                            <label>Total Number of Courses</label>
                        </div>
                    </div>
                </section>
            </section>     
        </div>
        <script>       
            let submenu=document.getElementById("sub-menu");
            function togglemenu(){
                submenu.classList.toggle("open-menu");
            }
        </script>
    </body>
</html>


 
