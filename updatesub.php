
<!DOCTYPE html>
<html >
<head>
   
<link rel="stylesheet" type="text/css" href="admincss.css">
    <link rel="stylesheet" type="text/css" href="submanagementcss.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
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
            
    </script>
       
       
    <?php
     
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'attendance';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $subcode=$_GET['updatescode'];
       
		
        $query = "SELECT * FROM subinfo WHERE scode = '$subcode'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
    ?>
</head>
<body>
<?php
    $oldscode=$row['scode'];

    echo'
    <form action="updatesub.php?updatescode='.$oldscode.'" method="POST">
    <section class="main">
        <div class="subform1" id="subform1" style="display:block">        
            <div class="heading">
                <label>Subject Details<label>
            </div>
            <div class="middle">   
                    <form id="subform11" action="subdetailphp.php" method="POST" >
    
                        <div class="input-box" id="firstbox">
                            <input type="text" id="scode" name="scode" maxlength="10"  placeholder="Subject Code"  value="'.$row['scode'].'"required>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="sname" name="sname" maxlength="20"  placeholder="Subject Name"  value="'.$row['sname'].'" required>
                          
                        </div>
                        <div class="input-box">

                        <select class="clas" name="clas" id="year-dropdown" onchange="populateSemesterDropdown()" onfocus="populateSemesterDropdown()" >';
                        if($row['clas']=="Not selected")
                        {
                           echo'
                           <option value="Not selected" selected style="color:grey">Select Year </option>
                           <option value="I YEAR">I YEAR</option>
                           <option value="II YEAR">II YEAR</option>
                           <option value="III YEAR">III YEAR</option>';
                        }
                        else if($row['clas']=="I YEAR")
                         {
                            echo'<option value="Not selected" style="color:grey">Select Year </option>
                            <option value="I YEAR"selected>I YEAR</option>
                            <option value="II YEAR">II YEAR</option>
                            <option value="III YEAR">III YEAR</option>';
                         }
                         else if($row['clas']=="II YEAR")
                         {
                            echo'<option value="Not selected" style="color:grey">Select Year </option>
                            <option value="I YEAR">I YEAR</option>
                            <option value="II YEAR" selected>II YEAR</option>
                            <option value="III YEAR">III YEAR</option>';
                         }
                         else if($row['clas']=="III YEAR")
                         {
                            echo'<option value="Not selected" style="color:grey">Select Year </option>
                            <option value="I YEAR">I YEAR</option>
                            <option value="II YEAR" >II YEAR</option>
                            <option value="III YEAR" selected>III YEAR</option>';
                         }
                         echo'
                        </select>

                            <select class="sem" name="sem" id="sem-dropdown" >';
                            if($row['clas']=="Not selected")
                            {
                               echo'
                               <option value="Not selected" selected style="color:grey">Select Sem </option>';
                            }
                            if($row['sem']=="I SEM")
                            {
                               echo'<option value="not selected" style="color:grey">Select Semester </option>
                               <option value="I SEM" selected>I SEM</option>
                               <option value="II SEM">II SEM</option>';
                               
                            }
                            else if($row['sem']=="II SEM")
                            {
                               echo' <option value="not selected" style="color:grey">Select Semester </option>
                               <option value="I SEM">I SEM</option>
                               <option value="II SEM" selected>II SEM</option>';
                               
                            }
                            else if($row['sem']=="III SEM")
                            {
                               echo'<option value="not selected" style="color:grey">Select Semester </option>
                               <option value="III SEM" selected>III SEM</option>
                               <option value="IV SEM">IV SEM</option>';
                            }
                            if($row['sem']=="IV SEM")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Semester </option>
                                <option value="III SEM" >III SEM</option>
                                <option value="IV SEM"selected>IV SEM</option>';
                            }
                            else if($row['sem']=="V SEM")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Semester </option>
                                <option value="V SEM" selected>V SEM</option>
                                <option value="VI SEM">VI SEM</option>';
                            }
                            else if($row['sem']=="VI SEM")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Semester </option>
                                <option value="V SEM" >V SEM</option>
                                <option value="VI SEM"selected>VI SEM</option>';
                            }
                            echo'
                           </select>
                            <select class="course" id="course" name="course" value="'.$row['course'].'" >';
                            if($row['course']=="Not selected")
                            {
                               echo'<option value="Not selected" selected style="color:grey">Select Course </option>
                               <option value="BA" >BA</option>
                               <option value="BBA" >BBA</option>
                               <option value="BCA" >BCA</option>
                               <option value="BCom" >BCom</option>
                               <option value="BSc" >BSc</option>';
                               
                            }
                            if($row['course']=="BA")
                            {
                               echo'<option value="Not selected" style="color:grey">Select Course </option>
                               <option value="BA" selected>BA</option>
                               <option value="BBA" >BBA</option>
                               <option value="BCA" >BCA</option>
                               <option value="BCom" >BCom</option>
                               <option value="BSc" >BSc</option>';
                               
                            }
                            else if($row['course']=="BBA")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Course </option>
                                <option value="BA" >BA</option>
                                <option value="BBA" selected>BBA</option>
                                <option value="BCA" >BCA</option>
                                <option value="BCom" >BCom</option>
                                <option value="BSc" >BSc</option>';
                               
                            }
                            else if($row['course']=="BCA")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Course </option>
                                <option value="BA" >BA</option>
                                <option value="BBA" >BBA</option>
                                <option value="BCA" selected >BCA</option>
                                <option value="BCom" >BCom</option> 
                                <option value="BSc" >BSc</option>';
                            }
                            if($row['course']=="BCom")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Course </option>
                                <option value="BA" >BA</option>
                                <option value="BBA" >BBA</option>
                                <option value="BCA" >BCA</option>
                                <option value="BCom" selected>BCom</option>
                                <option value="BSc" >BSc</option>';
                            }
                            else if($row['course']=="BSc")
                            {
                                echo'<option value="Not selected" style="color:grey">Select Course </option>
                                <option value="BA" >BA</option>
                                <option value="BBA" >BBA</option>
                                <option value="BCA" >BCA</option>
                                <option value="BCom" >BCom</option>
                                <option value="BSc"selected >BSc</option>';
                            }
                            
                            echo'
                            </select>                         
                       </div> 
                        <div class="input-box">
                        <select name="dept" class="dept" onclick="showStaff(this.value)" required>';
                        if($row['dept']=="Not Selected")
                        {
                           echo'
                            <option value="Not Selected" selected style="color:grey">Select Department</option>
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Arts")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts"selected>Arts</option>
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Botony")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony"selected>Botany </option>
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Chemestry")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry"selected>Chemistry</option>
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Commerce")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry">Chemistry</option>
                            <option value="Commerce"selected>Commerce</option>                                   
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Computer Science")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry">Chemistry</option>
                            <option value="Commerce">Commerce</option>                                   
                            <option value="Computer Science"selected>Computer Science</option>
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Economics")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry">Chemistry</option>
                            <option value="Commerce">Commerce</option>                                   
                            <option value="Computer Science">Computer Science</option>
                            <option value="Economics"selected>Economics</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="History">History</option>
                            <option value="Journalism">Journalism</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="English")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry">Chemistry</option>
                            <option value="Commerce">Commerce</option>                                   
                            <option value="Computer Science">Computer Science</option>
                            <option value="Economics">Economics</option>
                            <option value="English"selected>English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="History">History</option>
                            <option value="Journalism">Journalism</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Hindi")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry">Chemistry</option>
                            <option value="Commerce">Commerce</option>                                   
                            <option value="Computer Science">Computer Science</option>
                            <option value="Economics">Economics</option>
                            <option value="English">English</option>
                            <option value="Hindi"selected>Hindi</option>
                            <option value="History">History</option>
                            <option value="Journalism">Journalism</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="History")
                        {
                           echo'
                            <option value="Not Selected"  style="color:grey">Select Department</option>
                            <option value="Arts">Arts</option>
                            <option value="Botony">Botany </option>
                            <option value="Chemestry">Chemistry</option>
                            <option value="Commerce">Commerce</option>                                   
                            <option value="Computer Science">Computer Science</option>
                            <option value="Economics">Economics</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="History"selected>History</option>
                            <option value="Journalism">Journalism</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Journalism")
                        {
                           echo'
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
                            <option value="Journalism"selected>Journalism</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Kannada")
                        {
                           echo'
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
                            <option value="Kannada"selected>Kannada</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Mathematics")
                        {
                           echo'
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
                            <option value="Mathematics"selected>Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Physics")
                        {
                           echo'
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
                            <option value="Physics"selected>Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Political Science")
                        {
                           echo'
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
                            <option value="Political Science"selected>Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Psychology")
                        {
                           echo'
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
                            <option value="Psychology"selected>Psychology</option>
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        else if($row['dept']=="Sanskrit")
                        {
                           echo'
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
                            <option value="Political Science"selected>Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Sanskrit"selected>Sanskrit</option>';
                        }
                        else
                        {
                           echo'
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
                            <option value="Sanskrit">Sanskrit</option>';
                        }
                        echo'
                        </select>

                            <select name="staff" id="staffresponse" class="staff"  onclick="staff(this.value)">
                            <option value="'.$row['staffid'].'"selected>'.$row['staffname'].'</option> 
                                </select>
                                

                        
                        </div>
                        
                        
               
                    
        <div class="btns">
        <a href="updatesub.php"><button class="btn">reset</button></a>                        
            <button type="submit" class="btn" value="update" name="update">Update</button>
            <a href="submanagementphp.php"><button type="button" class="btn">Cancel</button></a>
            
        </div> 

            </div>
        </div>
    </section>
    </form>
    
</body>
</html>';
mysqli_close($conn);
?>
<?php
    $con = mysqli_connect('localhost', 'root', '', 'attendance');

    if (isset($_POST['update'])) {
        $getsubcode=$_GET['updatescode'];
        $scode = $_POST['scode'];
        $sname = $_POST['sname'];
        $clas = $_POST['clas'];
        $sem = $_POST['sem'];
        $course = $_POST['course'];
        $dept = $_POST['dept'];
        $staffid = $_POST['staff'];
        
        $query = "SELECT firstname, lastname FROM staffinfo WHERE staffid = '$staffid'";
        $rslt = mysqli_query($con, $query);

        if ($rslt) {
            
            $row = mysqli_fetch_assoc($rslt);
           
            $staffname = $row['firstname'] . ' ' . $row['lastname'];
        
        
        $qry = "UPDATE subinfo SET scode='".$scode."', sname='".$sname."', clas='".$clas."', sem='".$sem."', course='".$course."', dept='".$dept."', staffid=".$staffid.", staffname='".$staffname."' WHERE scode='".$getsubcode."'";
        $result = mysqli_query($con, $qry);
        if ($result) {
            mysqli_close($con);
            echo "<script>alert('Updated successfully');</script>";
            echo "<script>window.location.href='submanagementphp.php';</script>";
            exit();
            
        } else {
            echo "<script>alert('Could not update subject detail!');</script>";
            //echo "<script>window.location.href='submanagementphp.php';</script>";

        }
    } elseif (isset($_POST['cancelbtn'])) {
        echo "<script>window.location.href='submanagementphp.php';</script>";
    }
}
?>