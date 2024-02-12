<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="admincss.css">

    <link rel="stylesheet" type="text/css" href="studmanagementcss.css">
</head>
<body>
    
</body>
</html>
<?php
           
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "attendance";

            $conn = new mysqli($servername, $username, $password, $dbname);
            

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            function checkdelete(){
                return confirm('Are you sure you want to delete this record?');
            }

            // Function to search and display records
            function searchRecords($conn, $searchInput) {
                $query = "SELECT * FROM studinfo WHERE LOWER(rollno) LIKE LOWER('%$searchInput%') OR LOWER(CONCAT(firstname, ' ', lastname)) LIKE LOWER('%$searchInput%') OR LOWER(regno) LIKE LOWER('%$searchInput%') OR LOWER(contact) LIKE LOWER('%$searchInput%') OR LOWER(fathername) LIKE LOWER('%$searchInput%') OR LOWER(mothername) LIKE LOWER('%$searchInput%') OR LOWER(pcontact) LIKE LOWER('%$searchInput%') OR LOWER(email) LIKE LOWER('%$searchInput%') OR LOWER(password) LIKE LOWER('%$searchInput%') OR LOWER(address) LIKE LOWER('%$searchInput%') OR LOWER(dob) LIKE LOWER('%$searchInput%') OR LOWER(gender) LIKE LOWER('%$searchInput%') OR LOWER(clas) LIKE LOWER('%$searchInput%') OR LOWER(sem) LIKE LOWER('%$searchInput%') OR LOWER(course) LIKE LOWER('%$searchInput%')";

                $result = $conn->query($query);

                if ($result->num_rows == 0) {
                    echo 'No matching records found.';
                   

                } else {
                    echo'<div class="headpart">
                        <h1 id="detailheading">Student details</h1>
                        </div>
                        <div class="table">';
                    echo "<table >";
                    echo "<tr id='header'>";
                    echo "
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
                    <th>Operation</th><tr>";

                    while ($r= $result->fetch_assoc()) {
                        $rno=$r['regno'];
                        echo"
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
                        
                            <button id='updelbtn'><a href='updatestud.php?updateregno=".$rno."'>update</a></button>
                            <button  id='updelbtn'class='deletebutton'><a href='delete.php?deleteregno=".$rno."' onclick='return checkdelete()'>delete</a></button>
                        </td><tr>";

                    }

                    echo "</table>
                    </div>";
                    
                }
                    echo"<a style=' text-decoration: none;' href='studmanagementphp.php' ><button  class='btn'>BACK</button></a>";

            }
            fR(firstname) LIKE LOWER('%$searchInput%') OR
                LOWEunction staffsearchRecords($conn, $searchInput) {
                $query1 = "SELECT * FROM staffinfo WHERE 
                LOWER(lastname) LIKE LOWER('%$searchInput%') OR
                LOWER(staffid) LIKE LOWER('%$searchInput%') OR
                LOWER(contact) LIKE LOWER('%$searchInput%') OR
                LOWER(email) LIKE LOWER('%$searchInput%') OR
                LOWER(address) LIKE LOWER('%$searchInput%') OR
                LOWER(gender) LIKE LOWER('%$searchInput%') OR
                LOWER(dob) LIKE LOWER('%$searchInput%') OR
                LOWER(dojj) LIKE LOWER('%$searchInput%') OR
                LOWER(yearexp) LIKE LOWER('%$searchInput%') OR
                LOWER(monthexp) LIKE LOWER('%$searchInput%') OR
                LOWER(qualification) LIKE LOWER('%$searchInput%') OR
                LOWER(dept) LIKE LOWER('%$searchInput%')";
                $result1 = $conn->query($query1);

                if ($result1->num_rows == 0) {
                    echo 'No matching records found.';
                   

                } else {
                    echo'<div class="headpart">
                        <h1 id="detailheading">Staff details</h1>
                        </div>
                        <div class="table">';
                    echo "<table>";
                    echo "<tr id='header'>";
                    echo "
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Staff ID</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Date of Joining</th>
                    <th>Years of Experience</th>
                    <th>Months of Experience</th>
                    <th>Qualification</th>
                    <th>Department</th>
                    <th>Operation</th><tr>";

                    while ($r= $result1->fetch_assoc()) {
                        $staffidno=$r['staffid'];
                        echo"
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
                    <tr>";

                    }

                    echo "</table>
                    </div>";
                    
                }
                    echo"<a style=' text-decoration: none;' href='staffmanagementphp.php' ><button  class='btn'>BACK</button></a>";

            }
            function subsearchRecords($conn, $searchInput) {
                $query2 = "SELECT * FROM subinfo WHERE 
                LOWER(scode) LIKE LOWER('%$searchInput%') OR
                LOWER(sname) LIKE LOWER('%$searchInput%') OR
                LOWER(clas) LIKE LOWER('%$searchInput%') OR
                LOWER(sem) LIKE LOWER('%$searchInput%') OR
                LOWER(course) LIKE LOWER('%$searchInput%') OR
                LOWER(dept) LIKE LOWER('%$searchInput%') OR
                LOWER(staffid) LIKE LOWER('%$searchInput%') OR
                LOWER(staffname) LIKE LOWER('%$searchInput%')";
                $result2 = $conn->query($query2);

                if ($result2->num_rows == 0) {
                    echo 'No matching records found.';
                   

                } else {
                    echo'<div class="headpart">
                        <h1 id="detailheading">Subject details</h1>
                        </div>
                        <div class="table">';
                    echo "<table style='width:100%;'>";
                    echo "<tr id='header'>";
                    echo "
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Course</th>
                    <th>Staff Department</th>
                    <th>Staff-Id</th>
                    <th>Staff Name</th>
                    <th>Operation</th><tr>";            

                    while ($r= $result2->fetch_assoc()) {
                        $scode=$r['scode'];
                        echo"
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
                    <tr>";

                    }

                    echo "</table>
                    </div>";
                    
                }
                    echo"<a style=' text-decoration: none;' href='submanagementphp.php' ><button  class='btn'>BACK</button></a>";

            }


            // Check if the form is submitted
            if (isset($_POST['search'])){
                // User input
                $searchInput = $_POST["search_input"];

                // Call the search function
                searchRecords($conn, $searchInput);
            }  
            if (isset($_POST['staffsearch'])) {
                // Retrieve the search input value
                $searchInput = $_POST["staff_search_input"];
                staffsearchRecords($conn, $searchInput);
            }  
            if (isset($_POST['subsearch'])) {
                // Retrieve the search input value
                $searchInput = $_POST["sub_search_input"];
                subsearchRecords($conn, $searchInput);
            }  
                    
?>
