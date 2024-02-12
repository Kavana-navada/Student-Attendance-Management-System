<?php
   /* if($_SERVER['REQUEST_METHOD']=='POST')*/
    if ($_POST['register'])
    {
        
                    
            $fn=$_POST['firstname'];
            $ln=$_POST['lastname'];
            $tid=$_POST['teacherid'];
            $cont=$_POST['contact'];
            $gen=$_POST['gender'];
            $quali=$_POST['quali'];
            $dept=$_POST['dept'];
            $em=$_POST['email'];
            $pass=$_POST['password'];
            $adr=$_POST['address'];
            $dob=$_POST['dob'];

        @$con=new mysqli('localhost','root','','attendance');
        
        
        if(mysqli_connect_errno())
        {
            echo"could not connect";
        }
        else
        {
            $existqry="select * from staffregtab where email='$em'";
            $rslt=mysqli_query($con,$existqry);
            
            if($rslt)
            {
                $num=mysqli_num_rows($rslt);
                
                if($num>0)
                {
                    echo"<script>alert('This Email-Id already existed ');</script>";
                    
                    echo"<script>window.location.href='register.html';</script>";
                }
            
                else
                {
                  /*  if($pass===$conpass)
                    {*/
                        
                        $qry="Insert into staffregtab(firstname,lastname,teacherid,contact,gender,quali,dept,email,password,address,dob)values('".$fn."','".$ln."',".$tid.",". $cont.",'".$gen."','". $quali."','". $dept."','".$em."','".$pass."','".$adr."','".$dob."')";
                        $result=mysqli_query($con,$qry);
                        if($result)
                        {
                            
                            echo"<script>alert('Registerd successfuly');</script>";
                            echo"<script>window.location.href='mylogin.html';</script>";
                        }
                        else
                        {
                            echo"<script>alert('Registration failed!');</script>";
                            echo"<script>window.location.href='register.html';</script>";
                        }
                    
                        
                   /*}
                     else
                    {  
                        
                        echo"<script>alert('Password does not matched!');</script>";
                        echo"<script>window.location.href='register.html';</script>";
                    }*/

                 }
            }
        }
    }
?>