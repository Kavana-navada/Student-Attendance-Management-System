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
    <link rel="stylesheet" type="text/css" href="studmanagementcss.css">
    <script type="text/javascript">
        function populateSemesterDropdown() {
                var yearDropdown = document.getElementById("year-dropdown");
                var semDropdown = document.getElementById("sem-dropdown");
                var yearOptions = {
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
        function checkdelete(){
            return confirm('Are you sure you want to delete this record?');
        }
        function show(formno){
            document.getElementById("addstud").style.display="none";
            document.getElementById("viewstud").style.display="none";
            document.getElementById("delstud").style.display="none";
            document.getElementById("upstud").style.display="none";
            document.getElementById("studform1").style.display="none";
            document.getElementById("studform2").style.display="none";
            document.getElementById("studform3").style.display="none";
            document.getElementById("cancelbtn").style.display="none";
            document.getElementById("studform"+formno).style.display="block";
            
        }
       
       
        function onlychar(){
                var firstname=document.getElementById("firstname");
                var lastname=document.getElementById("lastname");
                var fname=document.getElementById("fathername");
                var mname=document.getElementById("mothername");
                let num=/[0-9]/;
                let spcl=/[!,@,#,$,%,^,&,*,),(,?,~,_,+,{,|,-,=,},<,>,.]/;
                let space=/[ ]/;
                if(firstname.value.match(num))
                {
                    firstname.setCustomValidity("Don't enter the numbers");
                }
                else if(firstname.value.match(spcl))
                {
                    firstname.setCustomValidity("Don't enter the special characters");
                }
                else if(firstname.value.match(space))
                {
                    firstname.setCustomValidity("Don't enter the space ");
                }
                else{
                    firstname.setCustomValidity("");
                }
            

                if(lastname.value.match(num))
                {
                    lastname.setCustomValidity("Don't enter the numbers");
                }
                else if(lastname.value.match(spcl))
                {
                    lastname.setCustomValidity("Don't enter the special characters");
                }
                else if(lastname.value.match(space))
                {
                    lastname.setCustomValidity("Don't enter the space ");
                }
                else{
                    lastname.setCustomValidity("");
                }

                if(fname.value.match(num))
                {
                    fname.setCustomValidity("Don't enter the numbers");
                }
                else if(fname.value.match(spcl))
                {
                    fname.setCustomValidity("Don't enter the special characters");
                }
                else{
                    fname.setCustomValidity("");
                }

                if(mname.value.match(num))
                {
                    mname.setCustomValidity("Don't enter the numbers");
                }
                else if(mname.value.match(spcl))
                {
                    mname.setCustomValidity("Don't enter the special characters");
                }
                else{
                    mname.setCustomValidity("");
                }
                
            }
        function checkphn()
        {
            var phoneNumberInput = document.getElementById('contact');
            var phoneNumber = phoneNumberInput.value;
           
            if (phoneNumber.length==10) {
                phoneNumberInput.setCustomValidity('');
                
            }
             else
              {
                phoneNumberInput.setCustomValidity('Please enter a valid 10-digit phone number');
            }
        }
           function passwordstrength(){
                var pass=document.getElementById("password");               
                var str=document.getElementById("strength");
                
                let alpha=/[a-zA-z]/;
                let upper=/[A-Z]/;
                let num=/[0-9]/;
                let spcl=/[!,@,#,$,%,^,&,*,),(,?,~,_,+,{,|,-,=,},<,>,.]/;
                
                    
                    if(pass.value.length<4)
                    {
                        str.innerHTML="password is weak";
                        str.style.color="red";
                        pass.setCustomValidity("password must contain 8 character");
                        
                    }
                    else if(pass.value.length<8)
                    {
                        str.innerHTML="password is medium";
                        str.style.color="yellow";
                        pass.setCustomValidity("password must contain 8 character");
                        if(!(pass.value.match(num)))
                        {
                            pass.setCustomValidity("must contain atleast one digit");
                        }
                        if(!(pass.value.match(spcl)))
                        {
                            pass.setCustomValidity("must contain atleast one special character");
                        }
                        if(!(pass.value.match(upper)))
                        {
                            pass.setCustomValidity("must contain atleast one uppercase charater");
                            
                        }
                    }
                    else if(pass.value.length>=8 &&  pass.value.match(alpha) &&  pass.value.match(upper) && pass.value.match(num)&& pass.value.match(spcl))
                    {
                        str.innerHTML="password is strong";
                        str.style.color="green";
                        
                        pass.setCustomValidity("");
                    }           
            }

    </script>
    <title>Admin</title>
</head>
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

        <!--student management-->
        <section class="main">
            <div class="topheading">
                <h1> STUDENT MANAGEMENT</h1>
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
                    <button id="addstud" onclick="show(1)"><img src="Pictures/add.png"><br>Add New Student</button>
                    <button id="viewstud" onclick="show(2)"><img src="Pictures/view.png"><br>View Student</button>
                </div>
                <div>
                    <button id="delstud" onclick="show(3)"><img src="Pictures/delete.png"><br>Delete Student</button>
                    <button id="upstud" onclick="show(4)"><img src="Pictures/edit.png"><br>Update Student</button>
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

            <!--add student details-->
            <div class="studform1" id="studform1">             
                <div class="heading">
                    <label>Student Registration<label>
                 

                </div>       
                <div class="middle">   
                    <form id="studform11" action="studregisterphp.php" method="POST" >
    
                        <div class="input-box" id="firstbox">
                            <input type="text" id="firstname" name="firstname" maxlength="15"  placeholder="First Name" oninput=onlychar() required>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="lastname" name="lastname" maxlength="15"  placeholder="Last Name" oninput=onlychar()>
                          
                        </div>
                        <div class="input-box">
                            <input type="number" id="rollno" name="rollno" maxlength="10"  min="1" placeholder="Roll Number" required >&nbsp;&nbsp;&nbsp;
                            <input type="number" id="regno" name="regno" maxlength="15" min="1" placeholder="Register Number"required >
                
                        </div>
                        <div class="input-box">
                            <input type="text" id="fathername" name="fathername" maxlength="30" placeholder="Father Name" oninput=onlychar() required>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="mothername" name="mothername" maxlength="30" placeholder="Mother Name" oninput=onlychar() required>
                            
                        </div>
                        <div class="input-box">
                            <input type="number" id="contact" name="contact" min="0" pattern="\d{10}" title="Please enter a 10-digit phone number" style="width:250px" placeholder="Contact Number" oninput=checkphn() required>
                            &nbsp;&nbsp;&nbsp;<input type="number" id="pcontact" name="pcontact" min="0"  title="Please enter a 10-digit phone number" style="width:250px" placeholder="Parent Contact Number" oninput=checkphn() >
                            
                        </div>
                        <div class="input-box">
                            <input type="email" id="email" name="email" maxlength="30" placeholder="Email Id"required >&nbsp;&nbsp;&nbsp;
                           <input type="password"  id="password" name="password" oninput="passwordstrength()" placeholder="Password" required><br>
                           <span id="strength"></span> 
                        </div>
                        <div class="input-box">
                            <textarea id="add" name="address" placeholder="Address" style="width:250px; height:50px" required></textarea>&nbsp;&nbsp;&nbsp;
                            <div class="gender-box">
                                <span>Gender:</span>
                                <input type="radio" id="male" name="gender" value="male" >
                                <label for="male" id="lmale">Male</label>
                                <input type="radio" id="female" name="gender" value="female" >
                                <label for="female" id="lfemale">Female</label>
                                <input type="radio" id="other" name="gender" value="other" >
                                <label for="other" id="other">Other</label><br>
                                <span id="dob" >DOB:</span>
                                <input type="date" name="dob" required>
                            </div>
                        </div>                 
                        <div>
                            <div class="input-box">
                                <select class="clas" name="clas" id="year-dropdown" onchange="populateSemesterDropdown()">
                                    <option value="Not selected"style="color:grey">Select Year</option>
                                    <option value="I YEAR">I YEAR</option>
                                    <option value="II YEAR">II YEAR</option>
                                    <option value="III YEAR">III YEAR</option>
                                </select>
                                <select class="sem" name="sem" id="sem-dropdown">
                                    <option value="Not selected">Select Semester</option>
                                </select>
                                <select class="course" id="course" name="course"  >
                                    <option value="Not selected" style="color:grey">Select Course </option>
                                    <option value="BA">BA</option>
                                    <option value="BBA">BBA</option>
                                    <option value="BCA">BCA </option>
                                    <option value="BCom">BCom</option>
                                    <option value="BSc">BSc</option>
                                </select>
                            
                            </div>
                        </div> 
                        <div class="btns">
                            <button type="reset" value="Reset" class="btn" id="resetbtn" >Reset</button>
                            <button type="submit" class="btn" value="register" name="register" >Register</button>
                            <button type="submit" class="btn" value="cancel" name="cancel" onclick="window.location.href='studmanagementphp.php';">Cancel</button>

                        </div> 
                    </form>           
                </div>    <!--middle close-->
            </div>          <!--studform1 close-->
            <!--end of adding student details-->

            <!--View students-->

            <section class="main">
                <div class="maintop">
                     
                </div>
                <div class="studform2" id="studform2">
                    <div class="search-box">
                        <form action="search.php" method="POST">
                            <input type="text" autocomplete="off"  name="search_input" placeholder="search...">
                            <button type="submit" name="search" style="background:none; padding:'0';border:none;"><a href="##" class="icon"><img src="Pictures/magnifying-glass.png"></a></button>
                        </form>
                    </div>          
                    <div class="headpart">
                        <h1 id="detailheading">Student details</h1>
                    </div>
                    <div class="table">
                        <table>
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
                                    $existqry="SELECT * FROM studinfo ORDER BY clas,sem,course,regno";
                                    $rslt=mysqli_query($con,$existqry);
                                    $num=mysqli_num_rows($rslt);
                                
                                    while($r=$rslt->fetch_assoc())
                                    {
                                        $rno=$r['regno'];
                                   echo"
                                    <tr>
                                        <td>".$r['firstname']."</td>
                                        <td>".$r['lastname']."</td>
                                        <td>".$r['rollno']."</td>
                                        <td>".$r['regno']."</td>
                                        <td>".$r['fathername']."</td>
                                        <td>".$r['mothername']."</td>
                                        <td>".$r['contact']."</td>
                                        <td>".$r['pcontact']."</td>
                                        <td>".$r['email']."</td> 
                                        <td>".$r['password']."</td>
                                        <td>".$r['address']."</td>
                                        <td>".$r['gender']."</td>
                                        <td>".$r['dob']."</td>
                                        <td>".$r['clas']."</td>
                                        <td>".$r['sem']."</td>
                                        <td>".$r['course']."</td>

                                        <td>
                        
                                        <button id='updelbtn'><a href='updatestud.php?updateregno=".$rno."'>Update</a></button>
                                        <button id='updelbtn' class='deletebutton'><a href='delete.php?deleteregno=".$rno."' onclick='return checkdelete()'>Delete</a></button>
                                        </td>
                                    </tr>";
                                    } 
                                    
                                }
                        echo"</table>"; 
                             
                            ?>
                    </div>
                    <button class="btn" id="backbtn" onclick="window.location.href='studmanagementphp.php'">back</button>
                </div>      <!--studform2 close--> 
                <button type="submit" class="btn" value="cancelbtn" id="cancelbtn" name="cancelbtn" onclick="window.location.href='studmanagementphp.php';">Back</button>  
           </section>
            
           <!--Delete student-->
            <section class="main">
                <div class="maintop">
                        <div class="studform3" id="studform3">
                            <form method="POST" action="delete.php">
                            
                            </form>
                            <form method="POST" action="delete.php">
                                    <label for="deletestud_reg" id="enterreg">Enter registration number to delete:</label>
                                    <input type="number" id="deletestud_reg" name="deletestud_reg"><br>
                                    <button type="submit" id="btndelete" name="deletestudbtn">Delete</button>
                                    <button type="submit" id="btnback" name="cancelbtn">Back</button>
                            </form>
                        </div>
                </div>
            </section> 

            <!--Update student-->
            <section class="main">
                <div class="maintop">
                    <div class="studform4" id="studform4">
                        <form method="POST" action="update.php">                           
                        </form>
                        <form method="POST" action="update.php">
                            <label for="updatestud_reg" id="enterregister">Enter registration number to update:</label>
                            <input type="number" id="updatestud_reg" name="updatestud_reg"><br>
                            <button type="submit" id="btnupdate"  name="updatestudbtn">Update</button>
                            <button type="submit" id="btnback"  name="cancelbtn" onclick='window.location.href="studmanagementphp.php";'>Back</button>
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