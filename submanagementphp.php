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
<html >
<head>
   
    <link rel="stylesheet" type="text/css" href="admincss.css">
    <link rel="stylesheet" type="text/css" href="submanagementcss.css">
    <script src="jquery-3.6.0.min.js"></script>
    <script> 
        function showStaff(selectedValue) {
            
            $.ajax({
                type: 'GET',
                url: 'selection.php',
                data: { str: selectedValue },
                success: function(response) {
                    // Do something with the response from PHP
                    $('#staffresponse').html(response);
                }
            });
        }
        function checkdelete(){
            return confirm('Are you sure you want to delete this record?');
        }
        
    function populateSemesterDropdown() {
            var yearDropdown = document.getElementById("year-dropdown");
            var semDropdown = document.getElementById("sem-dropdown");
            var yearOptions = {
                //"":["Select proper year"],
                "I YEAR": ["I SEM", "II SEM"],
                "II YEAR": ["III SEM", "IV SEM"],
                "III YEAR": ["V SEM", "VI SEM"]
            };
            var selectedYear = yearDropdown.value;
            semDropdown.innerHTML = "";
            yearOptions[selectedYear].forEach(function(option) {
                var optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                semDropdown.appendChild(optionElement);
            });
            
    }
    function show(formno){
            document.getElementById("addsub").style.display="none";
            document.getElementById("viewsub").style.display="none";
            document.getElementById("delsub").style.display="none";
            document.getElementById("upsub").style.display="none";
            document.getElementById("subform1").style.display="none";
            document.getElementById("subform2").style.display="none";
            document.getElementById("subform3").style.display="none";
            document.getElementById("subform4").style.display="none";
            document.getElementById("subform"+formno).style.display="block";
            document.getElementById("cancelbtn").style.display="none";
            
            
        }
        function mycancel(formno){
            document.getElementById("subform"+formno).style.display="none";
           
            document.getElementById("addsub").style.display="block";
            document.getElementById("viewsub").style.display="block";
            document.getElementById("delsub").style.display="block";
            document.getElementById("upsub").style.display="block";
            document.getElementById("cancelbtn").style.display="none";    
           
        }
    </script>
                     

   



 
    <title>Subject</title>
</head>
<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
  
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
                <a href="attmanagement.php" class="adminitem" >
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

        <!--sub management-->
       
        <section class="main">
        <div class="topheading">
                <h1> SUBJECT MANAGEMENT</h1>
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
                <div>
                    <button id="addsub" onclick="show(1)"><img src="Pictures/addsubject.png"><br>Add new Subject</button>
                    <button id="viewsub" onclick="show(2)"><img src="Pictures/view.png"><br>View Subject</button>
               </div>
                <div>
                    <button id="delsub" onclick="show(3)"><img src="Pictures/deletesubject.png"><br>Delete Subject</button>
                    <button id="upsub" onclick="show(4)"><img src="Pictures/updatesubject.png"><br>Update Subject</button>
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
                    <input type="submit" class="updatemyprofile" id="updatemyprofile" name="update" value="Update My Profile" onclick="window.location.href='myprofile.php';">
                    </div>
                </div> 
                </div>
            </div>
        
            <!--add sub details-->
            <div class="subform1" id="subform1">
        
             
                <div class="heading">
                    <label>Subject Detail<label>
                </div>
                
                <div class="middle">   
                    <form id="subform11" action="subdetailphp.php" method="POST" >
    
                        <div class="input-box" id="firstbox">
                            <input type="text" id="scode" name="scode" maxlength="10"  placeholder="Subject Code" required>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="sname" name="sname" maxlength="20"  placeholder="Subject Name"  required>
                          
                        </div>
                       <div class="input-box">
                        
                            <select class="clas" id="year-dropdown" name="clas" onchange="populateSemesterDropdown()">
                                <option value=""style="color:grey">Select Year</option>
                                <option value="I YEAR">I YEAR</option>
                                <option value="II YEAR">II YEAR</option>
                                <option value="III YEAR">III YEAR</option>
                            </select>

                            
                            <select class="sem" name="sem" id="sem-dropdown">
                                <option value="">Select Semester</option>
                            </select>
                            
                        
                       
                            <select class="course" id="course" name="course"  >
                                <option value="not selected" style="color:grey">Select Course </option>
                                <option value="BA">BA</option>
                                <option value="BBA">BBA</option>
                                <option value="BCA">BCA </option>
                                <option value="BCom">BCom</option>
                                <option value="BSc">BSc</option>
                                
                                
                                
                            </select>                           
                       </div> 
                        <div class="input-box">
                            <select name="dept" class="dept" onchange="showStaff(this.value)" required>
                                <option value="Not Selected"  style="color:grey">Select Department</option>
                                <option value="Arts">Arts</option>
                                <option value="Botony">Botany </option>
                                <option value="Chemestry">Chemistry</option>
                                <option value="Commerce">Commerce</option>                                   
                                <option value="Computer Science">Computer Science</option>
                                <option value="Economics">Economics</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="History">History</option>
                                <option value="Journalism">Journalism</option>
                                <option value="Kannada">Kannada</option>
                                <option value="Mathematics">Mathematics</option>
                                <option value="Physics">Physics</option>
                                <option value="Political Science">Political Science</option>
                                <option value="Psychology">Psychology</option>
                                <option value="Sanskrit">Sanskrit</option>
                            </select>

                            <select name="staff" id="staffresponse" class="staff" onchange="staff(this.value)">
                                <option value="">Select staff</option>
                                </select>
                                

                        
                        </div>
                        
                        
               
                    <div class="btns">
                        <button type="reset" value="Reset" class="btn" id="resetbtn" >Reset</button>
                        <button type="submit" class="btn" value="save" name="save" >Save</button>

                        <button type="submit" class="btn" value="cancel" name="cancel" onclick="window.location.href='submanagementphp.php';">Cancel</button>
                    </div> 
                    </form>
               
                
            </div>
        </div>
      
            <!--end of adding student details-->

            <!--View students-->
             
                
            <section class="main">
                <div class="maintop">
                   
              
                </div>


                <div class="subform2" id="subform2">
                <div class="search-box">
                        <form action="search.php" method="POST">
                            <input type="text"  name="sub_search_input" placeholder="search..." >
                            <button type="submit" name="subsearch" style="background:none; padding:'0';border:none;"><a href="##" class="icon"><img src="Pictures/magnifying-glass.png"></a></button>
                        </form>
                    </div> 
                    <div class="headpart">
                    
                        <h1>Subject details</h1>
                    </div>
                    <div class="table">
                        <table  >
                            <tr id="header">
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Course</th>
                            <th>Staff Department</th>
                            <th>Staff-Id</th>
                            <th>Staff Name</th>
                            <th>Operation</th>
                            </tr>
                            <?php
                                @$con=new mysqli('localhost','root','','attendance');
                                    
                                    
                                if(mysqli_connect_errno())
                                {
                                    echo"could not connect";
                                }
                                else
                                {
                                    $existqry="SELECT * FROM subinfo ORDER BY clas,sem,course";
                                    $rslt=mysqli_query($con,$existqry);
                                    $num=mysqli_num_rows($rslt);
                                
                                    while($r=$rslt->fetch_assoc())
                                    {
                                        $scode=$r['scode'];
                                    echo"
                                    <tr>
                                        <td>".$r['scode']."</td>
                                        <td>".$r['sname']."</td>
                                        <td>".$r['clas']."</td>
                                        <td>".$r['sem']."</td>
                                        <td>".$r['course']."</td>
                                        <td>".$r['dept']."</td>  
                                        <td>".$r['staffid']."</td>
                                        <td>".$r['staffname']."</td>
                                        <td>
                                            <button id='updelbtn'><a href='updatesub.php?updatescode=".$scode."'>Update</a></button>
                                            <button id='updelbtn'><a href='delete.php?deletesubcode=".$scode."' onclick='return checkdelete()'>Delete</a></button>
                                        </td>
                                        
                                    </tr>";
                                    } 
                                    
                                }
                            echo"</table>"; 
                            
                            ?>
                    </div>
                    <button class="btn" id="backbtn" onclick="window.location.href='submanagementphp.php'">back</button>
                    </div> 
                    <button type="submit" class="btn" value="cancelbtn" id="cancelbtn" name="cancelbtn" onclick="cancelbtn(2)">Back</button>
                    
                
           </section>
           <!--Delete sub-->
           <section class="main">
                <div class="maintop">
                    <!--<form method="POST" action="deletestaff.php">-->
                        <div class="subform3" id="subform3">
                        <form method="POST" action="delete.php">
                                
                                </form>
                            <form method="POST" action="delete.php">
                                    <label for="deletesub" id="entersubcode">Enter subject code to delete:</label>
                                    <input type="text" id="deletesubject" name="deletesubject"><br>
                                    <button type="submit" id="btndelete" name="deletesubbtn">Delete</button>

                                    <button type="submit" id="btnback" class="back_btn" name="cancelsubbtn" onclick="window.location.href='submanagementphp.php';">Back</button>
                            </form>
                        </div>
                    </div>
                
            </section> 
        
            <!--Update staff-->
            <section class="main">
                <div class="maintop">
                        
                    <div class="subform4" id="subform4">
                        <form method="POST" action="update.php">
                                    
                        </form>
                        <form method="POST" action="update.php">
                            <label for="updatesub" id="entersubcode">Enter subject code to update:</label>
                            <input type="text" id="updatesubject" name="updatesubject"><br>
                            <button type="submit" id="btnupdate" name="updatesubbtn">Update</button>
                            <button type="submit" id="btnback" name="btn__cancel" onclick='window.location.href="submanagementphp.php";'>Back</button>
                        </form>
                    </div>
                </div>
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