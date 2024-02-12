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
    <link rel="stylesheet" type="text/css" href="staffmanagementcss.css">
    <script type="text/javascript">
        function show(formno){
            document.getElementById("addstaff").style.display="none";
            document.getElementById("viewstaff").style.display="none";
            document.getElementById("delstaff").style.display="none";
            document.getElementById("upstaff").style.display="none";
            document.getElementById("staffform1").style.display="none";
            document.getElementById("staffform2").style.display="none";
            document.getElementById("staffform3").style.display="none";
            document.getElementById("staffform4").style.display="none";
            document.getElementById("cancelbtn").style.display="none";
            document.getElementById("staffform"+formno).style.display="block";
        }
        function checkdelete(){
            return confirm('Are you sure you want to delete this record?');
        }
        function mycancel(formno){
            document.getElementById("staffform"+formno).style.display="none";
            document.getElementById("cancelbtn").style.display="none";    
            document.getElementById("addstaff").style.display="block";
            document.getElementById("viewstaff").style.display="block";
        }
        function onlychar(){
                var firstname=document.getElementById("firstname");
                var lastname=document.getElementById("lastname");
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
                <a href="staffmanagementphp.php" class="adminitem" id="staff" >
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

        <!--staff management-->
        <section class="main">
        <div class="topheading">
                <h1>STAFF MANAGEMENT</h1>
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
                    <button id="addstaff" onclick="show(1)"><img src="Pictures/add.png"><br>Add new staff</button>
                    <button id="viewstaff" onclick="show(2)" ><img src="Pictures/view.png"><br>View staff</button>
                </div>
               <div>
                    <button id="delstaff" onclick="show(3)"><img src="Pictures/delete.png"><br>Delete Staff</button>
                    <button id="upstaff" onclick="show(4)"><img src="Pictures/edit.png"><br>Update Staff</button>
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

            <!--add staff details-->
            <div class="staffform1" id="staffform1">
        
                <div class="heading">
                    <label>Staff Registration<label>
                  
                </div>
                
                <div class="middle">   
                    <form id="staffform11" action="staffregisterphp.php" method="POST" >
    
                            <div class="input-box" id="firstbox">
                                <input type="text" id="firstname" name="firstname" maxlength="15" placeholder="First Name"required oninput="onlychar()"required >&nbsp;&nbsp;&nbsp;
                                <input type="text" id="lastname" name="lastname" maxlength="15" placeholder="Last Name" oninput="onlychar()" >
        
                            </div>
                            <div class="input-box">
                                <input type="number" id="staffid" name="staffid" maxlength="15" min="1" placeholder="Staff Id"required>&nbsp;&nbsp;&nbsp;
                                <input type="number" id="contact" name="contact" pattern="\d{10}" min="0" title="Please enter a 10-digit phone number" style="width:250px" placeholder="Contact Number" oninput=checkphn() required >
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
                                <input type="radio" id="male" name="gender" value="Male" >
                                <label for="male" id="lmale">Male</label>
                                <input type="radio" id="female" name="gender" value="Female" >
                                <label for="female" id="lfemale">Female</label>
                                <input type="radio" id="other" name="gender" value="Other" >
                                <label for="other" id="other">Other</label><br>
                                <span id="dobb" >DOB:</span>
                                <input type="date" name="dob" id="dob"required>
                                </div>
                            </div>
                           
                            <div class="inputs-box">
                                
                                <span id="exp" >Experience:</span><br>
                                <div class="staffexp">
                                <input type="number" id="expy" min="0" max="60" name="yearexp"><span id="expyear" >years</span>&nbsp;<input type="number" id="expm" name="monthexp" min="0" max="12"><span id="expmonth" >months</span>&nbsp;&nbsp;&nbsp;
                                <span id="doj" >DOJ:</span>
                                <input type="date" id="dojj" name="dojj" required></div>
                            </div>

                            <div class="input-box">
                                <select name="qualification" id="quali" class="quali"  required>
                                    <option value="Not Selected" style="color:grey">Select Qualification</option>
                                    <option value="MA">MA</option>
                                    <option value="MBA">MBA</option>
                                    <option value="MCA">MCA</option>
                                    <option value="MCom">MCom</option>
                                    <option value="MSc">MSc</option>
                                                                     
                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <select name="dept" id="dept" class="dept" aria-placeholder="Select Department" required>
                                    <option value="Not Selected" style="color:grey">Select Department</option>
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
                             </div>

                            <div class="btns">
                                <button type="reset" value="Reset" class="btn" id="resetbtn" >Reset</button>
                                <button type="submit" class="btn" value="register" name="register" >Register</button>
                                <button type="submit" class="btn" value="cancel" name="cancel" onclick="window.location.href='staffmanagementphp.php';">Cancel</button>
                            </div> 
        
                    </form>
                </div>
            </div>
        
            <!--end of adding student details-->

            <!--View staff-->
            <section class="main">
                <div class="maintop">
                   
              
                </div>


                <div class="staffform2" id="staffform2">
                <div class="search-box">
                        <form action="search.php" method="POST">
                            <input type="text"  name="staff_search_input" placeholder="search...">
                            <button type="submit" name="staffsearch" style="background:none; padding:'0';border:none;"><a href="##" class="icon"><img src="Pictures/magnifying-glass.png"></a></button>
                        </form>
                    </div> 
                    <div class="headpart">
                        <h1>Staff details</h1>
                    </div>
                    <div class="table">
                        <table  >
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
                            <th>Experience in  Years</th>
                            <th>Experience in Months</th>
                            <th>Qualification</th>
                            <th>Department</th>
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
                                    $existqry="SELECT * FROM staffinfo";
                                    $rslt=mysqli_query($con,$existqry);
                                    $num=mysqli_num_rows($rslt);
                                
                                    while($r=$rslt->fetch_assoc())
                                    {
                                    $staffidno=$r['staffid'];
                                    echo"
                                    <tr>
                                        <td>".$r['firstname']."</td>
                                        <td>".$r['lastname']."</td>
                                        <td>".$r['staffid']."</td>
                                        <td>".$r['contact']."</td>
                                        <td>".$r['email']."</td>
                                        <td>".$r['password']."</td>
                                        <td>".$r['address']."</td>
                                        <td>".$r['gender']."</td>
                                        <td>".$r['dob']."</td>
                                        <td>".$r['dojj']."</td>
                                        <td>".$r['yearexp']."</td>
                                        <td>".$r['monthexp']."</td>
                                        <td>".$r['qualification']."</td>
                                        <td>".$r['dept']."</td>
                                        <td>                                      
                                            <button id='updelbtn'><a href='updatestaff.php?updatestaffid=".$staffidno."'>Update</a></button>
                                            <button id='updelbtn'><a href='delete.php?deletestaffid=".$staffidno."' onclick='return checkdelete()'>Delete</a></button>
                                        </td>
                                    </tr>";
                                    } 
                                    
                                }
                            echo"</table>"; 
                            
                            ?>
                    </div>
                    <button class="btn" id="backbtn" onclick="window.location.href='staffmanagementphp.php'">back</button>
                    </div>

                    <button type="submit" class="btn" value="cancelbtn" id="cancelbtn" name="cancelbtn" onclick="window.location.href='staffmanagementphp.php';">Back</button>
                    
                
           </section>
           
            <!--Delete staff-->
            <section class="main">
                <div class="maintop">
                    <!--<form method="POST" action="deletestaff.php">-->
                        <div class="staffform3" id="staffform3">
                        <form method="POST" action="delete.php">
                                
                                </form>
                            <form method="POST" action="delete.php">
                                    <label for="deletestaff_id" id="enterstaffid">Enter staff id to delete:</label><br>
                                    <input type="number" id="deletestaff_id" name="deletestaff_id"><br>
                                    <button type="submit" id="btndelete" name="deletestaffbtn">Delete</button>
                                    <button type="submit" id="btnback" class="backbtn" name="cancelstaffbtn" onclick="window.location.href='staffmanagementphp.php';">Back</button>
                            </form>
                        </div>
                    
                </div>
                
            </section> 
             <!--Update staff-->
             <section class="main">
                <div class="maintop">
                    
                        <div class="staffform4" id="staffform4">
                            <form method="POST" action="update.php">
                                
                            </form>
                            <form method="POST" action="update.php">
                                    <label for="updatestaff_id" id="enterstaffid">Enter staff-id to update:</label><br>
                                    <input type="number" id="updatestaff_id" name="updatestaff_id"><br>
                                    <button type="submit" id="btnupdate" name="updatestaffbtn">Update</button>
                                    <button type="submit" id="btnback" name="btncancel" onclick='window.location.href="staffmanagementphp.php";'>Back</button>

                            </form>
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