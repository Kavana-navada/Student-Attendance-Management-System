<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        if (isset($_POST['deletestudbtn']))
        {
            $delreg = $_POST['deletestud_reg'];
            $qry = "SELECT * FROM studinfo WHERE regno='$delreg'";
            $result = mysqli_query($conn, $qry);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h3>Are you sure you want to delete the following record?</h3>";
                echo'
                <div class="table">
                <table border="1">
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
                        
                    </tr>';echo"
                    
                    <tr>
                        <td>".$row['firstname']."</td>
                        <td>".$row['lastname']."</td>
                        <td>".$row['rollno']."</td>
                        <td>".$row['regno']."</td>
                        <td>".$row['fathername']."</td>
                        <td>".$row['mothername']."</td>
                        <td>".$row['contact']."</td>
                        <td>".$row['pcontact']."</td>
                        <td>".$row['email']."</td> 
                        <td>".$row['password']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['gender']."</td>
                        <td>".$row['dob']."</td>
                        <td>".$row['clas']."</td>
                        <td>".$row['sem']."</td>
                        <td>".$row['course']."</td>

                    </tr>
                                        
                </table>
                </div>";

              
                echo "<form method='POST'>";
                echo "<input type='hidden' name='deletestud_reg' value='$delreg'>";
                echo "<input type='submit' name='confirmdelete' value='Yes, delete record'>
               <button type='submit' class='btn' value='cancel' id='cancelbtn' name='cancelbtn'>Cancel</button>
                ";
                echo "</form>";
            } else {
                echo"<script>alert('No student record found with registration number $delreg');</script>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";

            }
        } 
        elseif (isset($_POST['confirmdelete'])) {
            $delreg = $_POST['deletestud_reg'];
            $qry = "DELETE FROM studinfo WHERE regno='$delreg'";
            $result = mysqli_query($conn, $qry);

            if ($result) {
                echo "<script>alert('Student record of with registration number $delreg deleted successfully');</script>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";
            } else {
                echo "<h3>Failed to delete student record.</h3>";
                echo "<script>window.location.href='studmanagementphp.php';</script>";

            }
        }
        elseif(isset($_POST['cancelbtn'])){
            echo "<script>window.location.href='studmanagementphp.php';</script>";

        }
    }
?>