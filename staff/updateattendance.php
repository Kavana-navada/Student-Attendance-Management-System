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
    <style>
        #fullcard {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: flex-start;
                    align-items: flex-start;
                    }
        #update{
                background: rgba(239, 231, 238,0.8);
                border: 1px solid  rgb(65, 13, 118);   
            }
        .card{
                width: 15%;
                height:130px;
                margin: 30px;
                background:linear-gradient(  rgba(243, 232, 232, 1),rgb(202, 148, 253),rgba(243, 232, 232, 1));
                
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
            height:25px;
            width:160px;
            background:  rgb(142, 34, 243);
            font-size:14px;
            color:white;
            transition:0.5s ease;
            box-shadow:  -2px -2px 5px  rgb(28, 3, 51),
                        2px 2px 3px  rgb(28, 3, 25);
        }
        .att_btn:hover{
            border-radius:5px;
            margin-top:10px;
            height:29px;
            width:170px;
            background:white;
            font-weight:700;
            font-size:16px;
            color:black;
            transition:0.3s ease;
            box-shadow:  -2px -2px 5px rgb(28, 3, 51),
                        2px 2px 3px rgb(32, 28, 28);
        }
        </style>
    <title>update attendance</title>
</head>
<body>
    <div class="container" >
        <nav id="slidebar" >
            <ul>
            <li>
                <a href="#" class="staff">
                 <img class="staffimg" src="../Pictures/profileimg.png" >
                 <span class="mainitem">STAFF</span>
                </a>
            </li>


            <li>
                <a href="todaysattendance.php" class="staffitem">
                 <img src="../Pictures/todaysattendence.png" >
                 <span class="item">Today's Attendence</span>
                </a>
            </li>

            <li>
                <a href="updateattendance.php" class="staffitem" id="update" >
                 <img src="../Pictures/updateattendance.png" >
                 <span class="item">Update Attendance</span>
                </a>
            </li>

            <li>
                <a href="staffreport.php" class="staffitem" id="report" >
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
                <h1> Update Attendance</h1>
                <?php
                    $pngImagePath = '../Pictures/profile.png';
                    $buttonValue = $staffname;
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
            </div>



              <?php
                $dbhost = 'localhost';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'attendance';
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                $email=$_SESSION['user'];    
                $query = "SELECT staffid FROM staffinfo WHERE email = '$email'";
                $result = mysqli_query($conn, $query);
                $row1 = mysqli_fetch_assoc($result);
                $teacher=$row1['staffid'];

                $query1 = "SELECT * FROM subinfo WHERE staffid = '$teacher' ORDER BY clas,sem";
                $result1 = mysqli_query($conn, $query1);
                echo'<div id="fullcard">';
                while ($row1 = mysqli_fetch_assoc($result1))
                {
                    echo'
                    <div class="card">
                    <h1>'.$row1["course"].'</h1><br><hr>
                    <label>'.$row1["clas"].'</label>&nbsp;&nbsp;&nbsp;
                    <label>'.$row1["sem"].'</label><br>
                    <label class="subname">'.$row1["sname"].'</label><br>';
                   
                    echo'<a href="upattendance.php?course=' . $row1["course"] . '&class=' . $row1["clas"] . '&sem=' . $row1["sem"] . '&sub=' . $row1["sname"] . '&sid=' . $row1["sid"] . '"><button class="att_btn">Update Attendance</button></a>
                    </div>';
                }
                echo'</div>';
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






