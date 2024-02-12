
<?php
   /* if($_SERVER['REQUEST_METHOD']=='POST')*/
    if ($_POST['register'])
    {
        
                    
            $fn=$_POST['firstname'];
            $ln=$_POST['lastname'];
            $sid=$_POST['staffid'];
            $cont=$_POST['contact'];
            $em=$_POST['email'];
            $pass=$_POST['password'];
            $adr=$_POST['address'];
            $gen=$_POST['gender'];
            $dob=$_POST['dob'];
            $doj=$_POST['dojj'];
            $expy=$_POST['yearexp'];
            $expm=$_POST['monthexp'];
            $quali=$_POST['qualification'];
            $dept=$_POST['dept'];
            
            if($expy=="")
            {
                $expy="0";
            }
            if($expm=="")
            {
                $expm="0";
            }

        @$con=new mysqli('localhost','root','','attendance');
        
        
        if(mysqli_connect_errno())
        {
            echo"could not connect";
        }
        else
        {
            $existqry="SELECT * FROM staffinfo where staffid='$sid'";
            $rslt=mysqli_query($con,$existqry);
            
            if($rslt)
            {
                $num=mysqli_num_rows($rslt);
                
                if($num>0)
                {
                    echo"<script>alert('Staff-Id already existed ');</script>";                   
                    echo"<script>window.location.href='staffmanagementphp.php';</script>";
                }
            }
            
            $existqry="select * from staffinfo where email='$em'";
            $rslt=mysqli_query($con,$existqry);
            
            if($rslt)
            {
                $num=mysqli_num_rows($rslt);
                
                if($num>0)
                {
                    echo"<script>alert('This Email-Id already existed ');</script>";                   
                    echo"<script>window.location.href='staffmanagementphp.php';</script>";
                }
            
                else
                {
                        
                        $qry="INSERT INTO staffinfo VALUES('".$fn."','".$ln."',".$sid.",".$cont.",'".$em."','".$pass."','".$adr."','".$gen."','".$dob."','".$doj."',".$expy.",".$expm.",'". $quali."','". $dept."')";
                        $result=mysqli_query($con,$qry);
                        if($result)
                        {
                            
                            echo"<script>alert('Registerd successfuly');</script>";
                            echo"<script>window.location.href='staffmanagementphp.php';</script>";
                        }
                        else
                        {
                            echo"<script>alert('Registration failed!');</script>";
                            echo"<script>window.location.href='staffmanagementphp.php';</script>";
                        }

                 }
            }
        }
    }
?>