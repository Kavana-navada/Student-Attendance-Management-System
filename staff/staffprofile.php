<?php
session_start();
$user = $_SESSION['user'];
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);?>
<!DOCTYPE html>

<head>
<!-- <script type="text/javascript">
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
  
</script> -->
    <title>myprofile</title>

    <style>
   body{
    background-color: rgb(201, 236, 245);
   }
    .container {
    max-width: 400px;
    height: 500px;
    margin: 100px auto;
    padding: 20px;
    background-color:rgb(226, 233, 239);
    border: 1px solid #ccc;
    border-radius: 5px;
    color:black;
    border:2px solid black;
    box-shadow:-3px -3px 7px grey,
    3px 3px 5px black;
}

.container h2 {
    margin-top:10px;
    text-align: center;
    margin-bottom: 20px;
    font-size:40px;
}
#oneline{
    display:flex;
}
.container label {
    
    display: block;
    font-size:20px;
    
}

.container input[type="text"],
.container input[type="email"],
.container input[type="password"],
.container input[type="number"]
{
   
    width: 60%;
    padding: 8px;
    background:none;
    font-size:18px;
border-bottom:2px solid black;
    color:black;
   
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom:15px;
   
}

.container input[type="button"]{
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.container input[type="button"]:hover{
    background-color: #45a049;
}
#strength
{
    color: red;
    font-size: 12px;
   margin-right: -325px;
  margin-bottom: 100px;
    font-weight: bold;
    letter-spacing: 0.5px;
    
    width: 200px;
    
    
}


        </style>

</head>
<body>
    
</body>
</html>
<?php
$query = "SELECT * FROM staffinfo WHERE email = '$user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$staffname = $row['firstname'] . ' ' . $row['lastname'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Profile</title>
   
</head>
<body>
    <div class="container">
        <h2>My Profile</h2>
        <form method="POST" action="">
            <div id="oneline">
                <label>Staff-ID:</label>
                <label id="value"><?php echo $row['staffid']; ?></label>
            </div>

            <div id="oneline">
                <label>Name:</label>
                <label id="value"><?php echo $staffname; ?></label>
                
            </div>

            <div id="oneline">
            <label>Department:</label>
            <label id="value"><?php echo $row['dept']; ?></label>
            </div>

            <div id="oneline">
            <label>Email:</label>
            <label id="value"><?php echo $row['email']; ?></label>
            </div>

            <div id="oneline">
            <label>Password:</label>
            <label id="value"><?php echo $row['password']; ?></label>
            </div>

            <div id="oneline">
            <label>Address:</label>
            <label id="value"><?php echo $row['address']; ?></label>
            </div>

          
            <div id="oneline">
            <label>Gender:</label>
            <label id="value"><?php echo $row['gender']; ?></label>
            </div>

            <div id="oneline">
            <label>Contact:</label>
            <label id="value"><?php echo $row['contact']; ?></label>
            </div>

           

            <div id="oneline">
            <input type="button" name="back" value="Back" onclick="window.location.href='staff.php';">
            </div>
            
        </form>
    </div>
</body>
</html>

