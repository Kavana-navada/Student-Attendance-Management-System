
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
            var phoneNumberInput = document.getElementById('pcontact');
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
    <?php
     
		// Include database configuration file
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'attendance';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		// Get the document ID from the URL parameter

		// Get the document details from the database
        $reg=$_GET['updateregno'];
       
		
        $query = "SELECT * FROM studinfo WHERE regno = '$reg'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
    ?>
</head>
<body>
<?php
    $oldregno=$row['regno'];

    echo'
    <form action="updatestud.php?updateregno='.$oldregno.'" method="POST">
    <section class="main">
        <div class="studform1" id="studform1" style="display:block">        
            <div class="heading">
                <label>Student Registration<label>
            </div>
            <div class="middle">  
                        <div class="input-box" id="firstbox">
                            <input type="text" id="firstname" name="firstname" maxlength="15"  placeholder="First Name"  oninput=onlychar() value="'.$row['firstname'].'" required >&nbsp;&nbsp;&nbsp;
                            <input type="text" id="lastname" name="lastname" maxlength="15"  placeholder="Last Name" oninput=onlychar() value="'.$row['lastname'].'">
                          
                        </div>
                        <div class="input-box">
                            <input type="number" id="rollno" name="rollno" maxlength="10"  min="1" placeholder="Roll Number" value="'.$row['rollno'].'" required >&nbsp;&nbsp;&nbsp;
                            <input type="number" id="regno" name="regno" maxlength="15" min="1" placeholder="Register Number" value="'.$row['regno'].'"required >
                
                        </div>
                        <div class="input-box">
                            <input type="text" id="fathername" name="fathername" maxlength="30" placeholder="Father Name" oninput=onlychar() value="'.$row['fathername'].'" required>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="mothername" name="mothername" maxlength="30" placeholder="Mother Name" oninput=onlychar() value="'.$row['mothername'].'"required>
                            
                        </div>
                        <div class="input-box">
                            <input type="number" id="contact" name="contact" min="0"  pattern="\d{10}" title="Please enter a 10-digit phone number" style="width:250px" placeholder="Contact Number" oninput=checkphn() value="'.$row['contact'].'" required>
                            &nbsp;&nbsp;&nbsp;<input type="number" id="pcontact" min="0" title="Please enter a 10-digit phone number"  name="pcontact"  style="width:250px" placeholder="Parent Contact Number" oninput=checkphn() value="'.$row['pcontact'].'">
                            
                        </div>
                        <div class="input-box">
                            <input type="email" id="email" name="email" maxlength="30" placeholder="Email Id" value="'.$row['email'].'"required >&nbsp;&nbsp;&nbsp;
                           <input type="password"  id="password" name="password" oninput="passwordstrength()" placeholder="Password" value="'.$row['password'].'" required><br>
                           <span id="strength"></span> 
                        </div>
                        <div class="input-box">
                        <textarea id="add" name="address" placeholder="Address" style="width:250px; height:50px;"  required>'.$row['address'].'</textarea>&nbsp;&nbsp;&nbsp;
  
                            <div class="gender-box">
                            <span>Gender:</span>';
                            
                                if($row['gender']=="male")
                                {
                                   echo' <input type="radio" id="male" name="gender" value="male" checked="true" >
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="female">
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="other"  >
                                    <label for="other" id="other">Other</label><br>';
                                  
                                }
                    
                                else if($row['gender']=="female")
                                {
                                    echo '<input type="radio" id="male" name="gender" value="male">
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="female" checked="true">
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="other"  >
                                    <label for="other" id="other">Other</label><br>';
                                }
                                else if($row['gender']=="other")
                                {
                                    echo '<input type="radio" id="male" name="gender" value="male">
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="female" >
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="other" checked="true" >
                                    <label for="other" id="other">Other</label><br>';
                                }
                                else
                                {
                                    echo '<input type="radio" id="male" name="gender" value="male">
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="female" >
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="other" >
                                    <label for="other" id="other">Other</label><br>';
                                }
                                
                                echo'
                            <span id="dob" >DOB:</span>
                            <input type="date" name="dob" value="'.$row['dob'].'" required>
                            </div>
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
                        
                    
                    <div class="btns">
                        <button type="reset" value="Reset" class="btn" id="resetbtn" >Reset</button>                        
                        <button type="submit" class="btn" value="update" name="update">Update</a></button>

                        <button class="btn"  name="cancelbtn">Cancel</button>
                        
                    </div> 
            </div>
        </div>
    </section>
    </form>
</body>
</html>
';
mysqli_close($conn);
?>
<?php
    $con = mysqli_connect('localhost', 'root', '', 'attendance');

    if (isset($_POST['update'])) {
        $registerno=$_GET['updateregno'];
        $fn = $_POST['firstname'];
        $ln = $_POST['lastname'];
        $rn = $_POST['rollno'];
        $reg = $_POST['regno'];
        $fname = $_POST['fathername'];
        $mname = $_POST['mothername'];
        $cont = $_POST['contact'];
        $pcont = $_POST['pcontact'];
        $em = $_POST['email'];
        $pass = $_POST['password'];
        $add = $_POST['address'];
        $gen = $_POST['gender'];
        $dob = $_POST['dob'];
        $cls = $_POST['clas'];
        $sem = $_POST['sem'];
        $cours = $_POST['course'];

        if ($ln == "") {
            $ln = "N/A";
        }
        if ($pcont == "") {
            $pcont = "0";
        }
 
        $qry = "UPDATE studinfo SET firstname='".$fn."', lastname='".$ln."', rollno=".$rn.", regno=".$reg.", fathername='".$fname."', mothername='".$mname."', contact=".$cont.", pcontact=".$pcont.", email='".$em."', password='".$pass."', address='".$add."', gender='".$gen."', dob='".$dob."', clas='".$cls."', sem='".$sem."', course='".$cours."' WHERE regno='".$registerno."'";
        $result = mysqli_query($con, $qry);
        if ($result) {
        $name = $fn . ' ' . $ln;
           $qry = "UPDATE attendance SET name='".$name."', rollno=".$rn.", regno='".$reg."' WHERE regno='".$registerno."'";
            $result = mysqli_query($con, $qry);
            echo "<script>alert('Updated successfully');</script>";
            mysqli_close($con);
            echo "<script>window.location.href='studmanagementphp.php';</script>";
        } else {
            echo "<script>alert('Could not update student detail!');</script>";
            echo "<script>window.location.href='studmanagementphp.php';</script>";

        }
    } elseif (isset($_POST['cancelbtn'])) {
        echo "<script>window.location.href='studmanagementphp.php';</script>";
    }
?>

