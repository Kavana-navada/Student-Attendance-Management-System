<?php
   
    if (isset($_POST['save']))
    {                   
        $scode=$_POST['scode'];
        $sname=$_POST['sname'];
        $clas=$_POST['clas'];
        $sem=$_POST['sem'];
        $course=$_POST['course'];
        $dept=$_POST['dept'];
        $staffid=$_POST['staff'];   
        @$con=new mysqli('localhost','root','','attendance');
        $query = "SELECT firstname, lastname FROM staffinfo WHERE staffid = '$staffid'";
        $result = mysqli_query($con, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $staffname = $row['firstname'] . ' ' . $row['lastname']; 
            if(mysqli_connect_errno())
            {
                echo"could not connect";
            }
            else
            {
                $qry="INSERT INTO subinfo(scode,sname,clas,sem,course,dept,staffid,staffname) VALUES('".$scode."','".$sname."','".$clas."','".$sem."','".$course."','".$dept."','".$staffid."','".$staffname."')";
                $result=mysqli_query($con,$qry);
                if($result)
                    {
                        echo"<script>alert('Subject information inserted successfuly');</script>";
                        echo"<script>window.location.href='submanagementphp.php';</script>";
                    }
                    else
                    {
                        echo"<script>alert('failed!');</script>";
                        echo"<script>window.location.href='submanagementphp.php';</script>";
                                
                    }
            
            }
        }
    }
?>
