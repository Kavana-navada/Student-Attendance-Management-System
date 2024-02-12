<!DOCTYPE html>
<html>
    <head>
        <title>changemypassword</title>
        <style>
                *{
                    padding: 0%;
                    margin: 0%;
                    font-family: sans-serif;
                    box-sizing: border-box;
                }
                body{
                    margin: 0%;
                    padding: 0%;
                    background-image: url("Pictures/bg1.jpg");
                    background-position: center;
                    background-attachment: fixed;
                    background-repeat: no-repeat;
                    background-size:cover;
                    display: flex;                   
                    justify-content: center;
                    align-items: center;
                    
                }
                nav
                {
                    left:0%;
                    top:0%;
                    width: 100%;
                    height: 100px;
                    position: fixed;
                    background:transparent;
                    box-sizing: border-box;
                    display: flex;              
                    justify-content: space-between;
                    align-items: center;
                
                }

                img{
                    height:75px;
                    width:75px;
                    border: 2px solid black;
                    border-radius: 10px;
                    margin: 1%;
                }
                span{
                    color: #0d0d0d;
                    margin-left:-173%;/*-160%*/
                    font-size: 30px;
                    pointer-events: none;
                }
                ul li{
                    color: rgb(9, 9, 9);
                margin-left: 100px;
                    display:flex;
                    list-style:none;   
                }

                li a:hover::after{
                    transform:scaleX(1);
                transform-origin: left;
                }
                #cancelbutton{
                    color: rgb(226, 211, 211);
                    font-size: 30px;
                    margin-left:323px;
                    font-weight: 600;
                    cursor: pointer;
                    background-color: rgba(8, 6, 14,0.8) ;
                    outline: none;
                    border:2px solid black;
                    padding-right: 5px;
                    padding-left: 10px;
                    padding-bottom: 5px;
                    border: none;
                    border-bottom:2px solid black;
                    border-left:2px solid black;
                    border-bottom-left-radius: 20px;
                }
                #cancelbutton:hover{
                background-color:rgb(250, 48, 48);
                }
                .leaf{
                    height: 375px;
                    width: 375px;
                    border-left-style:groove;
                    border-right-style:groove;
                    border-bottom-style: hidden;
                    border-top-style: hidden;
                    border-top-left-radius: 150px;
                    border-bottom-right-radius: 150px;
                    border-width: 10px;
                    border-inline-color: rgb(12, 54, 223);
                    margin-left:500px;
                    background:linear-gradient(rgb(166, 238, 21),rgb(123, 222, 230));
                    margin-top: 150px; 
                    margin:250px ;
                
                }
                .middle form{
                    width: 100%;
                    padding: 0 50px;
                }

                h2{
                    font-size: 1.75em;
                    color: rgb(85, 10, 236);
                    text-align: center;
                    text-shadow: 2px 2px 2px rgb(217, 209, 214);
                    padding-top: 10px;   /*65*/
                    letter-spacing: -1px;

                }
                .input-box{
                    position: relative;
                    margin: 23px 0 ;

                }
                .input-box{
                        
                    border:none;
                    border-style: none;
                    border-radius: 30px;
                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.2),
                                5px 5px 15px rgba(0,0,0,0.5),
                                inset -5px -5px 5px rgba(255,255,255,0.2),
                                inset 5px 5px 5px rgba(0,0,0,0.1);
                }

                .input-box input{
                    width: 100%;
                    height: 40px;
                    background: transparent;
                    
                    border-radius: 30px;
                    outline: none;
                    transition: 0.5s ease;
                    font-size:medium;
                    color: rgb(8, 8, 8);
                    padding: 0 15px;
                    border: 2px solid rgb(142, 202, 24);

                }   

                .input-box label{
                    color: white;
                    position:absolute;
                    top: 50%;
                    left: 10%;
                    transform: translateY(-50%);
                    font-size: medium;
                    pointer-events: none;
                    transition: 0.3s ease;
                    font-weight: bold;

                }

                .input-box input:focus~label,
                .input-box input:valid~label{
                    top:1px;
                    font-size: small;
                    background-color:white;
                    border-radius: 10px;
                    padding: 0 8px;
                    color: black;
                    
                }

                .input-box input:focus,
                .input-box input:valid{
                    border-color:white;
                }
                .btn
                {
                    width: 70%;
                    height: 40px;
                    border: none;
                    outline: none;
                    border-radius: 30px;
                    background-color: rgb(56, 9, 224);
                    font-size:large;
                    color: black;
                    font-weight: 600;
                    margin-left: 40px;
                    margin-top: 5px;
                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.2),
                    5px 5px 15px rgba(0,0,0,0.5),
                    inset -5px -5px 5px rgba(15, 14, 14, 0.1),
                    inset 5px 5px 5px rgba(0,0,0,0.1);
                    
                }
                .btn:hover{
                    border-color: white;
                    border:2px solid white;
                    color: white;
                    cursor:pointer;
                    
                }
                #strength
                {
                    color: red;
                    font-size: 11px;
                    position:absolute;
                    bottom: -13px;
                    font-weight: bold;
                    letter-spacing: 0.5px;
                    left: 490px;
                    width: 200px;
                    
                }

        </style>
        <script type="text/javascript"> 
            function mycancel(){
                window.location="login.php";
            }


            function passwordstrength(){
                var npass=document.getElementById("newpass");               
                var str=document.getElementById("strength");
                
                let alpha=/[a-zA-z]/;
                let upper=/[A-Z]/;
                let num=/[0-9]/;
                let spcl=/[!,@,#,$,%,^,&,*,),(,?,~,_,+,{,|,-,=,},<,>,.]/;
                
                    
                    if(npass.value.length<4)
                    {
                        str.innerHTML="password is weak";
                        str.style.color="red";
                        npass.setCustomValidity("password must contain 8 character");
                        
                    }
                    else if(npass.value.length<8)
                    {
                        str.innerHTML="password is medium";
                        str.style.color="yellow";
                        npass.setCustomValidity("password must contain 8 character");
                        if(!(npass.value.match(num)))
                        {
                            npass.setCustomValidity("must contain atleast one digit");
                        }
                        if(!(npass.value.match(spcl)))
                        {
                            npass.setCustomValidity("must contain atleast one special character");
                        }
                        if(!(npass.value.match(upper)))
                        {
                            npass.setCustomValidity("must contain atleast one uppercase charater");
                        }
                    }
                    else if(npass.value.length>=8 &&  npass.value.match(alpha) &&  npass.value.match(upper) && npass.value.match(num)&& npass.value.match(spcl))
                    {
                        str.innerHTML="password is strong";
                        str.style.color="green";
                        
                        npass.setCustomValidity("");
                    }
                    
                }
                function passcheck()
                {
                    var npass=document.getElementById("newpass");
                    var cnpass=document.getElementById("confirmnewpass");
                    if((npass.value)===(cnpass.value))
                    {
                        cnpass.setCustomValidity("");

                    }
                    else
                    {
                        cnpass.setCustomValidity("password mismatched");
                    }
                }
        </script>
    </head>
    <body>
        
        <div class="container">
        
            <nav id="navigationbar">
                <img src="Pictures/clglogo.jpg">  
                
                <ul>
                    <li><span>Bhandarkars' Arts and Science College</span></li>
                               
                </ul>                            
            </nav>
           
            <div class="leaf">
            <div class="middle">     <!--login-box-->
                <input type="button" value="x" id="cancelbutton" onclick="mycancel()"/>
                <h2><b>Reset Password</b></h2>
                    <form action="changepassphp.php" method="POST">

                    <div class="input-box">
                        <input type="email" id="email" name="email" maxlength="30" required>
                        <label for="email">Email Id</label>
                    </div>

                    <div class="input-box">
                        <input type="password"  id="newpass" name="newpass" maxlength="15" oninput="passwordstrength()" required>
                        <label for="newpassword">New Password</label>
                        <span id="strength"></span>
                    </div>

                    <div class="input-box">
                        <input type="password"  id="confirmnewpass" name="confirmnewpass" maxlength="15" oninput="passcheck()" required>
                        <label for="newpassword">Confirm new Password</label>
                    </div>

                   <button  type="submit" class="btn" value="change" name="change">Change Password</button><br>
                    </form>
            </div>
            </div>
        </div>
        
    </body>
</html>



<?php
    if(isset($_POST['change']))
    {
        $em=$_POST['email'];
        $npass=$_POST['newpass'];
        $conpass=$_POST['confirmnewpass'];
        @$con=new mysqli('localhost','root','','attendance');
        if(mysqli_connect_errno())
        {
            echo"could not connect";
        }
        else
        {
            $qry="SELECT * FROM admin WHERE email='".$em."'";
            $rslt=mysqli_query($con,$qry);
            if($rslt)
            {
                if(mysqli_num_rows($rslt))
                { 
                    $qry="UPDATE admin SET password='".$npass."' where email='".$em."'";
                    $rslt=mysqli_query($con,$qry);
                    if($qry)
                    {
                        echo"<script>alert(' password is successfully changed');</script>";
                        echo"<script>window.location.href='login.php';</script>";
                        exit;
                    }
                
                    
                }
            }
            $qry="SELECT * FROM studinfo WHERE email='".$em."'";
            $rslt=mysqli_query($con,$qry);
            if($rslt)
            {
                if(mysqli_num_rows($rslt))
                { 
                    $qry="UPDATE studinfo SET password='".$npass."' where email='".$em."'";
                    $rslt=mysqli_query($con,$qry);
                    if($qry)
                    {
                        echo"<script>alert(' password is successfully changed');</script>";
                        echo"<script>window.location.href='login.php';</script>";
                        exit;
                    }
                
                    
                }
            }
            $qry="SELECT * FROM staffinfo WHERE email='".$em."'";
            $rslt=mysqli_query($con,$qry);
            if($rslt)
            {
                if(mysqli_num_rows($rslt))
                { 
                    $qry="UPDATE staffinfo SET password='".$npass."' where email='".$em."'";
                    $rslt=mysqli_query($con,$qry);
                    if($qry)
                    {
                        echo"<script>alert(' password is successfully changed');</script>";
                        echo"<script>window.location.href='login.php';</script>";
                        exit;
                    }
                
                    
                }
            }
            echo"<script>alert('This Email-ID doesnot exists');</script>";
            echo"<script>window.location.href='changepassphp.php';</script>";

        }
    }
?>