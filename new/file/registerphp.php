<?php
   /* if($_SERVER['REQUEST_METHOD']=='POST')*/
    if ($_POST['register'])
    {
        
                    
            $fn=$_POST['firstname'];
            $ln=$_POST['lastname'];
            $em=$_POST['email'];
            $pass=$_POST['password'];
            $conpass=$_POST['confirmpass'];

        @$con=new mysqli('localhost','root','','attendance');
        
        
        if(mysqli_connect_errno())
        {
            echo"could not connect";
        }
        else
        {
            $existqry="select * from regtab where email='$em'";
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
                    if($pass===$conpass)
                    {
                        
                        $qry="INSERT INTO regtab values('".$fn."','".$ln."','".$em."','".$pass."','".$conpass."')";
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
                    
                        
                    }

                 }
            }
        }
    }
?>