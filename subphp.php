<!DOCTYPE html>
<html>
<head>
  <title>Example</title>
</head>
<body>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <label for="department-dropdown">Department:</label>
    <select id="department-dropdown" name="department">
      <option value="">-- Select Department --</option>
      <option value="dept1">Department 1</option>
      <option value="dept2">Department 2</option>
    </select>

    <label for="staff-dropdown">Staff Name:</label>
    <select id="staff-dropdown" name="staff">
      <?php
        if (isset($_POST['department'])) {
          // Retrieve the selected department
          $selectedDepartment = $_POST['department'];

          // Query the database to retrieve the staff names for the selected department
          // Assume that the results are stored in an array called $staffNames

          // Generate the options for the staff dropdown list
          echo '<option value="">-- Select Staff Name --</option>';
          foreach ($staffNames as $staffName) {
            echo '<option value="' . $staffName['firstname'] . '">' . $staffName['firstname'] . '</option>';
          }
        } else {
          echo '<option value="">-- Select Staff Name --</option>';
        }
      ?>
    </select>

    <input type="submit" value="Submit">

  </form>

</body>
</html>
        

   



 
    <title>Subject</title>
</head>
<body>
  
    <div class="container">
        <nav id="slidebar" >
            <ul>
            <li>
                <a href="#" class="admin">
                 <img class="adminimg" src="Pictures/admin1.jpg" >
                 <span class="mainitem">ADMIN</span>
                </a>
            </li>

            <li>
                <a href="admin.html" class="adminitem">
                 <img src="Pictures/dashboard2.png" >
                 <span class="item">Dashboard</span>
                </a>
            </li>


            <li>
                <a href="studmanagementphp.php" class="adminitem" id="stud" >
                 <img src="Pictures/stud.png" >
                 <span class="item">Student Management</span>
                </a>
            </li>

            <li>
                <a href="staffmanagementphp.php" class="adminitem" >
                 <img src="Pictures/staff1.png" >
                 <span class="item">Staff Management</span>
                </a>
            </li>

            <li>
                <a href="submanagementphp.php" class="adminitem" id="sub">
                 <img src="" >
                 <span class="item">Subject Management</span>
                </a>
            </li>
            
            <li>
                <a href="#" class="adminitem" >
                 <img src="Pictures/report1.png" >
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

        <!--student management-->
        <section class="main">
            <div class="maintop">
               <button id="addsub" onclick="show(1)">Add new Subject</button>
               <button id="viewsub" onclick="show(2)">View Subject</button>
            </div>

            <!--add student details-->
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
                       <!--<div class="input-box">-->
                        
                            
  <label for="year-dropdown">Year:</label>
  <select id="year-dropdown" >
    <option value="">-- Select Year --</option>
    <option value="I YEAR">I YEAR</option>
    <option value="II YEAR">II YEAR</option>
  </select>

  <label for="sem-dropdown">Semester:</label>
  <select id="sem-dropdown">
    <option value="">-- Select Semester --</option>
  </select>
                      
                            <select class="course" id="course" name="course"  >
                                <option value="not selected" style="color:grey">Select Course </option>
                                <option value="BA">BA</option>
                                <option value="BBA">BBA</option>
                                <option value="BCA">BCA </option>
                                <option value="BCom">BCom</option>
                                <option value="BSc">BSc</option>
                                
                                
                                
                            </select>                           
                      <!--  </div>  -->
                        <div class="input-box">
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
                                    <option value="Maths">Mathematics</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Political Science">Political Science</option>
                                    <option value="Psychology">Psychology</option>
                                    <option value="Sanskrit">Sanskrit</option>
                                   
                            </select>
                            <?php

                                // Connect to the MySQL database
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "attendance";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                                }

                                // Execute a query to retrieve the available courses
                                $sql = "SELECT DISTINCT firstname FROM staffinfo";
                                $result = $conn->query($sql);

                                // Create a dropdown list of the available courses
                                if ($result->num_rows > 0) {
                                echo '<select name="stafname" class="staffname">';
                                echo'<option value="Not Selected" style="color:grey">Select Staff</option>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["firstname"] . '">' . $row["firstname"] . '</option>';
                                }
                                echo '</select>';
                                } else {
                                echo "No staff name found";
                                }

                                // Close the database connection
                                $conn->close();

                            ?>
                        </div>
                        
                </div> 
                    <div class="btns">
                        <button type="reset" value="Reset" class="btn" id="resetbtn" >Reset</button>
                        <button type="submit" class="btn" value="save" name="save" >Save</button>
                        <button type="submit" class="btn" value="cancel" name="cancel" onclick="mycancel(1)">Cancel</button>
                    </div> 
                    </form>
               
                </div>
            </div>
            <!--end of adding student details-->

            <!--View students-->
             
                
            <section class="main">
                <div class="maintop">
                    <form method="GET" action="">
              
                </div>


                <div class="subform2" id="subform2">
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
                            </tr>
                            <?php
                                @$con=new mysqli('localhost','root','','attendance');
                                    
                                    
                                if(mysqli_connect_errno())
                                {
                                    echo"could not connect";
                                }
                                else
                                {
                                    $existqry="SELECT * FROM subinfo";
                                    $rslt=mysqli_query($con,$existqry);
                                    $num=mysqli_num_rows($rslt);
                                
                                    while($r=$rslt->fetch_assoc())
                                    {
                                    echo"<table cellspacing='0'>
                                    <tr>
                                        <td>".$r['scode']."</td>
                                        <td>".$r['sname']."</td>
                                        <td>".$r['clas']."</td>
                                        <td>".$r['sem']."</td>
                                        <td>".$r['course']."</td>
                                        <td>".$r['dept']."</td>
                                        <td>".$r['staffname']."</td>
                                        <td>".$r['staffid']."</td>
                                    </tr>";
                                    } 
                                    
                                }
                            echo"</table>"; 
                            
                            ?>
                    </div>
                    <button class="btn" id="backbtn">back</button>
                    </div> 
                    <button type="submit" class="btn" value="cancelbtn" id="cancelbtn" name="cancelbtn" onclick="cancelbtn(2)">Back</button>
                    
                </div>
           </section>
        </div>
            
    </div>



</body>
</html>