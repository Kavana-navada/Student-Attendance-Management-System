<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="registercss.css">
        <script type="text/javascript">
            function onlychar(){
                var fn=document.getElementById("firstname");
                var ln=document.getElementById("lastname");
                let num=/[0-9]/;
                let spcl=/[!,@,#,$,%,^,&,*,),(,?,~,_,+,{,|,-,=,},<,>,.]/;
                let space=/[ ]/;
                
                if(fn.value.match(num))
                {
                    fn.setCustomValidity("Don't enter the numbers");
                    
                    
                }
                else if(fn.value.match(spcl))
                {
                    fn.setCustomValidity("Don't enter the special characters");
                }
                else if(fn.value.match(space))
                {
                    fn.setCustomValidity("Don't enter the space ");
                }
                else{
                    fn.setCustomValidity("");
                }

                if(ln.value.match(num))
                {
                    ln.setCustomValidity("Don't enter the numbers");
                }
                else if(ln.value.match(spcl))
                {
                    ln.setCustomValidity("Don't enter the special characters");
                }
                else if(ln.value.match(space))
                {
                    ln.setCustomValidity("Don't enter the space ");
                }
                else{
                    ln.setCustomValidity("");
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
            function passcheck()
            {
                var pass=document.getElementById("password");
                var conpass=document.getElementById("confirmpass");
                if((pass.value)!=(conpass.value))
                {
                    conpass.setCustomValidity("password mismatched");
                    
                }
                else
                {
                   
                    conpass.setCustomValidity("");
                    
                }
                
            }

            

        </script>
    </head>
    <body>
        
       
        <div class="container">
        
            <nav id="navigationbar">
                <img src="Pictures/clglogo.jpg"> 
                 
                <ul>
                    <li><span>Bhandakars' Arts and Science College</span></li>
                    <li><a href="mylogin.html">Back</a></li>                   
                </ul>                            
            </nav>
            <div class="leaf">
            <div class="middle">    <!--login-box-->
                <h2><b>Admin Register</b></h2>
                    <form action="registerphp.php" method="POST">

                    <div class="input-box">
                        <input type="text" id="firstname" name="firstname" maxlength="15" oninput="onlychar()"required >
                        <label for="firstname">First Name</label>
                    </div>

                    <div class="input-box">
                        <input type="text" id="lastname" name="lastname" maxlength="15" oninput="onlychar()" required>
                        <label for="lastname">Last Name</label>
                    </div>

                    <div class="input-box">
                        <input type="email" id="email" name="email" maxlength="30" required>
                        <label for="email">Email ID</label>
                    </div>

                    <div class="input-box">
                        <input type="password"  id="password" name="password" maxlength="15" oninput="passwordstrength()" required>
                        <label for="password">Password</label>
                        <span id="strength"></span> 
                    </div>

                    <div class="input-box">
                        <input type="password"  id="confirmpass" name="confirmpass" maxlength="15" oninput="passcheck()" required>
                        <label for="password">Confirm Password </label>
                    </div>


                    
                   <button type="submit" class="btn" value="register" name="register">Register</button><br>

                    <div class="login">
                         <label for="alreadyuser" id="alreadyuser">Already registerd?</label><a class="link1" id="link1" href="adminlogin.html">Login</a>
                    </div>
                 </div>
                 
                </form>
             
            </div>
        </div>
    </div>
    </body>
</html>
