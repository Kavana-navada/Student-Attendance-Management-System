
<!DOCTYPE html>
<html >
<head>
   
<link rel="stylesheet" type="text/css" href="admincss.css">
    <link rel="stylesheet" type="text/css" href="staffmanagementcss.css">
    <script type="text/javascript">
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
       
       
    <?php
     
		// Include database configuration file
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'attendance';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		// Get the document ID from the URL parameter

		// Get the document details from the database
        $staff_id=$_GET['updatestaffid'];
       
		
        $query = "SELECT * FROM staffinfo WHERE staffid = '$staff_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
    ?>
</head>
<body>
<?php
    $oldstaffid=$row['staffid'];

    echo'
    <form action="updatestaff.php?updatestaffid='.$oldstaffid.'" method="POST">
    <section class="main">
        <div class="staffform1" id="staffform1" style="display:block">        
            <div class="heading">
                <label>Staff Registration<label>
            </div>
            <div class="middle">  
            <div class="input-box" id="firstbox">
            <input type="text" id="firstname" name="firstname" maxlength="15" placeholder="First Name"required oninput="onlychar()" value="'.$row['firstname'].'">&nbsp;&nbsp;&nbsp;
            <input type="text" id="lastname" name="lastname" maxlength="15" placeholder="Last Name" oninput="onlychar()" value="'.$row['lastname'].'" >

        </div>
        <div class="input-box">
            <input type="number" id="staffid" name="staffid" maxlength="15" min="1" placeholder="Staff Id" value="'.$row['staffid'].'"required>&nbsp;&nbsp;&nbsp;
            <input type="number" id="contact" name="contact" pattern="\d{10}" min="0" title="Please enter a 10-digit phone number" style="width:250px" placeholder="Contact Number" oninput=checkphn() value="'.$row['contact'].'" required >
        </div>
        <div class="input-box">
            <input type="email" id="email" name="email" maxlength="30" placeholder="Email Id" value="'.$row['email'].'"required >&nbsp;&nbsp;&nbsp;
            <input type="text"  id="password" name="password" oninput="passwordstrength()" placeholder="Password" value="'.$row['password'].'" required><br>
            <span id="strength"></span> 
        </div>
        
       <div class="input-box">
            <textarea id="add" name="address" placeholder="Address" style="width:250px; height:50px" required>'.$row['address'].'</textarea>&nbsp;&nbsp;&nbsp;
            <div class="gender-box">
                 <span>Gender:</span>';
                                if($row['gender']=="Male")
                                {
                                   echo' <input type="radio" id="male" name="gender" value="Male" checked="true" >
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="Female">
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="other"  >
                                    <label for="other" id="other">Other</label><br>';
                                  
                                }
                    
                                else if($row['gender']=="Female")
                                {
                                    echo '<input type="radio" id="male" name="gender" value="Male">
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="Female" checked="true">
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="Other"  >
                                    <label for="other" id="other">Other</label><br>';
                                }
                                else if($row['gender']=="Other")
                                {
                                    echo '<input type="radio" id="male" name="gender" value="Male">
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="Female" >
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="other" checked="true" >
                                    <label for="other" id="other">Other</label><br>';
                                }
                                else
                                {
                                    echo '<input type="radio" id="male" name="gender" value="Male">
                                    <label for="male" id="lmale">Male</label>';
                                    echo '<input type="radio" id="female" name="gender" value="Female" >
                                    <label for="lfemale" id="lfemale">Female</label>';
                                    echo'<input type="radio" id="other" name="gender" value="Other" >
                                    <label for="other" id="other">Other</label><br>';
                                }
                                
                                echo'
            <span id="dobb" >DOB:</span>
            <input type="date" name="dob" id="dob" value="'.$row['dob'].'" required>
            </div>
        </div>
       
        <div class="inputs-box">
            
            <span id="exp" >Experience:</span><br>
            <div class="staffexp">
            <input type="number" id="expy" min="0" max="60" name="yearexp" value="'.$row['yearexp'].'"><span id="expyear" >years</span>&nbsp;<input type="number" id="expm" name="monthexp" min="0" max="12"value="'.$row['monthexp'].'"><span id="expmonth" >months</span>&nbsp;&nbsp;&nbsp;
            <span id="doj" >DOJ:</span>
            <input type="date" id="dojj" name="dojj" value="'.$row['dojj'].'" required></div>
        </div>

        <div class="input-box">
            <select name="qualification" id="quali" class="quali"  required>';
            if($row['qualification']=="Not Selected")
            {
               echo'
                <option value="Not Selected" selected style="color:grey">Select Qualification</option>
                <option value="MA">MA</option>
                <option value="MBA">MBA</option>
                <option value="MCA">MCA</option>
                <option value="MCom">MCom</option>
                <option value="MSc">MSc </option>';
            }
            else if($row['qualification']=="MA")
            {
                echo'
                <option value="Not Selected" style="color:grey">Select Qualification</option>
                <option value="MA"selected>MA</option>
                <option value="MBA">MBA</option>
                <option value="MCA">MCA</option>
                <option value="MCom">MCom</option>
                <option value="MSc">MSc </option>';
            }
            else if($row['qualification']=="MBA")
            {
                echo'
                <option value="Not Selected" style="color:grey">Select Qualification</option>
                <option value="MA">MA</option>
                <option value="MBA"selected>MBA</option>
                <option value="MCA">MCA</option>
                <option value="MCom">MCom</option>
                <option value="MSc">MSc </option>';
            }
            else if($row['qualification']=="MCA")
            {
                echo'
                <option value="Not Selected" style="color:grey">Select Qualification</option>
                <option value="MA">MA</option>
                <option value="MBA">MBA</option>
                <option value="MCA"selected>MCA</option>
                <option value="MCom">MCom</option>
                <option value="MSc">MSc </option>';
            }
            else if($row['qualification']=="MCom")
            {
                echo'
                <option value="Not Selected" style="color:grey">Select Qualification</option>
                <option value="MA">MA</option>
                <option value="MBA">MBA</option>
                <option value="MCA">MCA</option>
                <option value="MCom"selected>MCom</option>
                <option value="MSc">MSc </option>';
            }
            else if($row['qualification']=="MSc")
            {
                echo'
                <option value="Not Selected" style="color:grey">Select Qualification</option>
                <option value="MA">MA</option>
                <option value="MBA">MBA</option>
                <option value="MCA">MCA</option>
                <option value="MCom">MCom</option>
                <option value="MSc"selected>MSc </option>';
            }
            echo'
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            

            <select name="dept" id="dept" class="dept" aria-placeholder="Select Department" required>';
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
         </div>

        <div class="btns">
            <button type="reset" value="Reset" class="btn" id="resetbtn" >Reset</button>                        
            <button type="submit" class="btn" value="update" name="update">Update</a></button>
            <button class="btn"  name="cancelbtn" onclick="window.location.href="staffmanagementphp.php";">Cancel</button>
            
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
        $getstaffid=$_GET['updatestaffid'];
        $fn = $_POST['firstname'];
        $ln = $_POST['lastname'];
        $sid = $_POST['staffid'];
        $cont = $_POST['contact'];
        $em = $_POST['email'];
        $pass = $_POST['password'];
        $add = $_POST['address'];
        $gen = $_POST['gender'];
        $dob = $_POST['dob'];
        $doj = $_POST['dojj'];
        $yrexp = $_POST['yearexp'];
        $mnexp = $_POST['monthexp'];
        $quali = $_POST['qualification'];
        $dept = $_POST['dept'];


        if ($ln == "") {
            $ln = "N/A";
        }
    
        $qry = "UPDATE staffinfo SET firstname='".$fn."', lastname='".$ln."', staffid=".$sid.", contact=".$cont.", email='".$em."', password='".$pass."', address='".$add."', gender='".$gen."', dob='".$dob."',dojj='".$doj."', yearexp=".$yrexp.", monthexp=".$mnexp.", qualification='".$quali."', dept='".$dept."' WHERE staffid='".$getstaffid."'";
        $result = mysqli_query($con, $qry);
        if ($result) {
            $staffname = $fn . ' ' . $ln;
            $qry = "UPDATE subinfo SET staffid=".$sid.", staffname='".$staffname."' WHERE staffid='".$getstaffid."'";
            $result = mysqli_query($con, $qry);
            echo "<script>alert('Updated successfully');</script>";
            mysqli_close($con);
            echo "<script>window.location.href='staffmanagementphp.php';</script>";
        } else {
            echo "<script>alert('Could not update staff detail!');</script>";
            echo "<script>window.location.href='staffmanagementphp.php';</script>";

        }
    } elseif (isset($_POST['cancelbtn'])) {
        echo "<script>window.location.href='staffmanagementphp.php';</script>";
    }
?>