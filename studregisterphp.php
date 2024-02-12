<?php
    if (isset($_POST['register']))
    {           
            $fn=$_POST['firstname'];
            $ln=$_POST['lastname'];
            $rn=$_POST['rollno'];
            $reg=$_POST['regno'];
            $fname=$_POST['fathername'];
            $mname=$_POST['mothername'];
            $cont=$_POST['contact'];
            $pcont=$_POST['pcontact'];
            $em=$_POST['email'];
            $pass=$_POST['password'];
            $add=$_POST['address'];
            $gen=$_POST['gender'];
            $dob=$_POST['dob'];
            $cls=$_POST['clas'];
            $sem=$_POST['sem'];
            $cours=$_POST['course'];
            
            if($ln=="")
            {
                $ln="N/A";
            }
            if($pcont=="")
            {
                $pcont="0";
            }
            
        @$con=new mysqli('localhost','root','','attendance');       
        if(mysqli_connect_errno())
        {
            echo"could not connect";
        }
        else
        {
            $existqry="SELECT * FROM studinfo where regno='$reg'";
            $rslt=mysqli_query($con,$existqry);
            
            if($rslt)
            {
                $num=mysqli_num_rows($rslt);
                
                if($num>0)
                {
                    echo"<script>alert('This registration number already existed ');</script>";                   
                    echo"<script>window.location.href='studmanagementphp.php';</script>";
                }
            }
            $existqry="select * from studinfo where email='$em'";
            $rslt=mysqli_query($con,$existqry);         
            if($rslt)
            {
                $num=mysqli_num_rows($rslt);    
                if($num>0)
                {
                    echo"<script>alert('This Email-Id already existed ');</script>";                   
                    echo"<script>window.location.href='studmanagementphp.php';</script>";
                }
                else
                {
                    $qry="INSERT INTO studinfo VALUES('".$fn."','".$ln."',".$rn.",".$reg.",'".$fname."','".$mname."',".$cont.",".$pcont.",'".$em."','".$pass."','".$add."','".$gen."','".$dob."','".$cls."','".$sem."','".$cours."')";
                    $result=mysqli_query($con,$qry);
                    if($result)
                    {
                            
                        echo"<script>alert('Registerd successfuly');</script>";
                        
                        echo"<script>window.location.href='studmanagementphp.php';</script>";
                    }
                    else
                    {
                        echo"<script>alert('Registration failed!');</script>";
                        echo"<script>window.location.href='studmanagementphp.php';</script>";     
                    }  
                }
            }
        }
    }
?>

