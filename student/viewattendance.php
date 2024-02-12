<?php 
session_start();
$user = $_SESSION['user'];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$query = "SELECT * FROM studinfo WHERE email = '$user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$studname=$row['firstname'].' '.$row['lastname'];
?>
<!DOCTYPE html>
<html >
<head>
   
    <link rel="stylesheet" type="text/css" href="studcss.css">
    <style>
        #fullcard {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: flex-start;
                } 
        #view{
            background: rgba(239, 231, 238,0.8);
                    border: 1px solid  rgb(65, 13, 118);     
            }
        .card{
                width: 18%;
                height:120px;
                margin: 30px;
                
                background:linear-gradient(  rgba(243, 232, 232, 1),rgb(147, 146, 218),rgba(243, 232, 232, 1));

                text-align: center;
                border-radius: 20px;
                padding: 10px;
                box-shadow:inset -3px -3px 7px rgb(15, 15, 15),
                3px 3px 5px rgb(0, 0, 0);
        }
        hr{
            background: black;
            height: 1px;
            width: 100%;
            margin: -15px 0 5px;
        }
        .subname{
            font-weight:bold;
            font-size:22px;
           
        }
        .att_btn{
            border-radius:5px;
            margin-top:10px;
            height:35px;
            width:180px;
            background-color:#222170;

            font-size:16px;
            color:white;
            transition:0.5s ease;
            box-shadow:  -2px -2px 5px rgb(255, 255, 255),
                        2px 2px 3px rgb(128, 127, 220);
            border:none;
            outline:none;
        }
        .att_btn:hover{
            border-radius:5px;
            margin-top:10px;
            height:40px;
            width:190px;
            background:white;
            font-weight:700;
            font-size:18px;
            color:black;
            transition:0.3s ease;
            box-shadow:  -2px -2px 5px rgb(20, 16, 141),
                        2px 2px 3px rgb(32, 28, 28);
            border:2px solid #222170;
        }
        
        
        </style>
    <title>Student</title>
</head>
<body>
    <div class="container" >
        <nav id="slidebar" >
            <li>
                <a href="#" class="stud">
                 <img class="studimg" src="../Pictures/profileimg.png" >
                 <span class="mainitem">STUDENT</span>
                </a>
            </li>

            <li>
                <a href="viewattendance.php" class="studitem" id="view">
                 <img src="../Pictures/todaysattendence.png" >
                 <span class="item">View Attendence</span>
                </a>
            </li>

            <li>
                <a href="../home.html" class="studitem" id="logoutitem" >
                 <img src="../Pictures/logout1.png" >
                 <span class="item">Logout</span>
                </a>
            </li>


            </ul>
        </nav>
        <section class="main">
            <div class="topheading">
                <h1>VIEW ATTENDANCE</h1>
                <?php
                    $pngImagePath = '../Pictures/profile.png';
                    $buttonValue = $studname;
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
                
                        <h2 id="name" ><?php echo $studname; ?></h2>
                        <hr>

                        <div id="oneline">
                            <label>Reg No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>:</span>&nbsp;&nbsp;
                            <label id="value"><?php echo $row['regno']; ?></label>
                        </div>

                        <div id="oneline">
                            <label>Roll No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>:</span>&nbsp;&nbsp;
                            <label id="value"><?php echo $row['rollno']; ?></label>
                        </div>

                        

                        <div id="oneline">
                        <label>Course</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['course']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['clas']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Sem</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['sem']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['email']; ?></label>
                        </div>

                        <div id="oneline">
                        <label>Contact</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>:</span>&nbsp;&nbsp;
                        <label id="value"><?php echo $row['contact']; ?></label>
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

                        
                    </div>
                </div>  
              </div>

            </div>


             <?php
                $dbhost = 'localhost';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'attendance';
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


                $email=$_SESSION['user'];
               

                $query = "SELECT clas,sem,course FROM studinfo WHERE email = '$email'";
                $result = mysqli_query($conn, $query);
                $row1 = mysqli_fetch_assoc($result);
                $studentclas=$row1['clas'];
                $studentsem=$row1['sem'];
                $studentcourse=$row1['course'];

                $query1 = "SELECT * FROM subinfo WHERE clas = '$studentclas' AND sem='$studentsem' AND course='$studentcourse' ORDER BY clas,sem";
                $result1 = mysqli_query($conn, $query1);
                echo'<div id="fullcard">';
                while ($row1 = mysqli_fetch_assoc($result1))
                {
                    echo'
                    <div class="card">
                    <label class="subname">'.$row1["sname"].'</label><br><br><hr>
                    <label>'.$row1["scode"].'</label><br>';
                    echo'<a href="viewreport.php?sname='.$row1["sname"] . '&sid=' . $row1["sid"] . '"><button class="att_btn">View Attendance</button></a>
                    </div>';
                }echo'</div>';
              ?>


          


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



