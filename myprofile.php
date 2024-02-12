
<?php
session_start();
$user = $_SESSION['user'];
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'attendance';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);?>
<!DOCTYPE html>
<html lang="en">
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
            background: rgb(201, 236, 245);
        }
        .updateprofile {
            background:white;
            padding:20px;
            text-align:center;
            width:500px;
            border-radius:5px;
            justify-content:center;
            margin-top:130px;
            margin-left:450px;
            
           
        }
        .updateprofile h2{
            font-size:40px;
            margin-top:10px;
            margin-bottom:15px;

        }
        .updateprofile .flex{
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            margin-bottom:20px;
            gap:15px;
        }
        .updateprofile .flex .inputbox {
            display:flex;
            
            vertical-align:middle;
            margin-bottom:-15px;
            margin-left:60px;
        }
        .updateprofile .flex .inputbox label{
            width:49%;
            display:block;
            margin-top:15px;
            font-size:20px;
           
        }
        .updateprofile .flex .inputbox input{
          
           height:30px;
           font-size:20px;
           border-radius:2px;
          border:none;
          border-bottom:2px solid  grey;
          padding:10px;
          transition:0.2s ease;
        
        }
        .updateprofile .flex .inputbox input:focus{
           
            outline:none;
            border-radius:10px;
            border-bottom:3px solid #3479db;
            transition:0.2s ease;
            color:#3498db;
        }
        input[type="email"]:focus{
            color:black;
            
        }
        input[type="submit"],
        input[type="button"]{
            border-radius:5px;
            margin-top:30px;
            height:40px;
            width:160px;
            background: rgb(45, 186, 183);
            font-size:20px;
            color:white;
            font-weight:bold;
            transition:0.5s ease;
            box-shadow:  -2px -2px 5px rgb(201, 326, 205),
     2px 2px 3px rgb(32, 28, 28);
 
        }

        input[type="submit"]{
            margin-left:60px;
        }
        input[type="button"]{
            margin-left:60px;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover{
            background:white;
            color:rgb(45, 186, 183);
            font-size:22px;
        }
        .inputbutton{
            display:flex;
           
            
        }


    </style>

</head>
<body>
    
</body>
</html>
<?php


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $updateQuery = "UPDATE admin SET name='$name', email='$email', password='$password', gender='$gender', address='$address', contact='$contact' WHERE email='$user'";
    $rslt=mysqli_query($conn, $updateQuery);
    if($rslt)
    {
        echo"<script>alert('Profile updated successfully ');</script>"; 
    }

    $_SESSION['user'] = $email; // Update session variable if email is changed
}

$query = "SELECT * FROM admin WHERE email = '$user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$adminname = $row['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
</head>
<body>
    <div class="updateprofile">
        <h2>My Profile</h2>
        <form method="POST" action="">
            <div class="flex">
                <div class="inputbox">
                    <label>Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="name" value="<?php echo $row['name']; ?>"required><br>
                </div>   
                <div class="inputbox">
                    <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="email" name="email" value="<?php echo $row['email']; ?>"readonly><br>
                </div>
                <div class="inputbox">  
                    <label>Password</label>&nbsp;&nbsp;&nbsp;
                        <label>:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="password" name="password" value="<?php echo $row['password']; ?>" oninput=passwordstrength() required><br>
                    <!-- <span id="strength"></span>  -->
                </div>
           
            
                <div class="inputbox">
                    <label>Contact</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="number" name="contact" length="10" value="<?php echo $row['contact']; ?>"required oninput="checkphn()"><br>
                </div>  
                <div class="inputbox">
                    <label>Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="address" value="<?php echo $row['address']; ?>"required><br>
                </div>
                <div class="inputbox">   
                    <label>Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="gender" value="<?php echo $row['gender']; ?>"required><br>
                </div>
            
                <div class="inputbutton"> 
            <input type="submit" name="update" class="updatebtn"  value="Update" >
            <input type="button" name="back" class="backbtn" value="Back" onclick="window.location.href='admin.php';" >
</div>
            <!-- <span id="updateMessage"></span> -->
            </div>
        </form>
    </div>
</body>
</html>

