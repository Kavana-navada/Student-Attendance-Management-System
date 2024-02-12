<?php 
    session_start();
    $user = $_SESSION['user'];
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'attendance';
    $conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $query = "SELECT * FROM admin WHERE email = '$user'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $adminname=$row['name'];
?>
<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="admincss.css">
            <link rel="stylesheet" type="text/css" href="card.css">
            <title>Attendance report</title>
        </head>
        <style>
        #att{
                background: #19bd60;
                opacity: 0.8;
                border: 0.5px solid  #156602;      
            }
        
        </style>
    <body>
        <div class="container">
            <nav id="slidebar" >
                <ul>
                    <li>
                        <a href="#" class="admin">
                        <img class="adminimg" src="Pictures/profileimg.png" >
                        <span class="mainitem">ADMIN</span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php" class="adminitem">
                        <img  src="Pictures/dashboard.png" >
                        <span class="item">Dashboard</span>
                        </a>
                    </li>


                    <li>
                        <a href="studmanagementphp.php" class="adminitem" id="stud" >
                        <img src="Pictures/student_management.png">
                        <span class="item">Student Management</span>
                        </a>
                    </li>

                    <li>
                        <a href="staffmanagementphp.php" class="adminitem" >
                        <img src="Pictures/staff_management.png">
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
                        <a href="attmanagement.php" class="adminitem" id="att" >
                        <img src="Pictures/attendence_report.png" >
                        <span class="item">Attendance Report</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="home.html" class="adminitem" id="logoutitem" >
                        <img src="Pictures/logout1.png">
                        <span class="item">Logout</span>
                        </a>
                    </li>


                </ul>
            </nav>

            <section class="main">
                <div class="topheading">
                    <h1> ATTENDANCE REPORT</h1>
                    <?php
                        $pngImagePath = 'Pictures/profile.png';
                        $buttonValue = $adminname;
                        echo '<button type="submit" class="myprofile" onclick="togglemenu()">';
                        echo '<img class="profileimg" src="' . $pngImagePath . '" >';
                        echo $buttonValue;
                        echo '</button>';  
                    ?>
                </div>

                <div class="maintop">
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
                                    <input type="submit" class="updatemyprofile" id="updatemyprofile" name="update" value="Update My Profile" onclick="window.location.href='myprofile.php';">
                            </div>
                        </div> 
                    </div>          
                    <?php
                        $query1 = "SELECT * FROM subinfo ORDER BY clas, sem,course";
                        $result1 = mysqli_query($conn, $query1);
                        
                        $subjects = array(); // Associative array to store subjects grouped by class, semester, and course
                        
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $class = $row1["clas"];
                            $semester = $row1["sem"];
                            $course = $row1["course"];
                            
                            $subject = array(
                                "sname" => $row1["sname"],
                                "sid" => $row1["sid"]
                            );
                            
                            $key = $class . "-" . $semester . "-" . $course;
                            
                            if (!isset($subjects[$key])) {
                                $subjects[$key] = array();
                            }
                            
                            $subjects[$key][] = $subject;
                        }
                        echo'<div id="fullcard">';
                        foreach ($subjects as $key => $subjectGroup) {
                            $classSemCourse = explode("-", $key);
                            $class = $classSemCourse[0];
                            $semester = $classSemCourse[1];
                            $course = $classSemCourse[2];
                            
                            echo '<div id="card">
                                    <h1>' . $course . '</h1><hr><br>
                                    <label>' . $class . '</label>
                                    <label>' . $semester . '</label><br><br>';
                        
                            foreach ($subjectGroup as $subject) {
                                echo '
                                          <a class="att_btn" href="adminattendance.php?course=' . $course . '&class=' . $class . '&sem=' . $semester . '&sub=' . $subject["sname"] . '&sid=' . $subject["sid"] . '">' . $subject["sname"] . '</a>
                                     <br>';
                                      
                            }
                            echo'</div>';
                            
                        }
                        echo '</div>';

                    ?>
                                  
                </div>
            </div>
        <script>       
            let submenu=document.getElementById("sub-menu");
            function togglemenu(){
                submenu.classList.toggle("open-menu");
            }
        </script>    
    </body>
</html> 