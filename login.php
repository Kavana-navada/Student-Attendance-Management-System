<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>login</title>
   
    <style>
            * {
                padding: 0%;
                margin: 0%;
                font-family: sans-serif;
                box-sizing: border-box;
            }

            body {
                margin: 0%;
                padding: 0%;
                background-image: url("Pictures/bg1.jpg");
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            nav {
                left: 0%;
                top: 0%;
                width: 100%;
                height: 100px;
                position: fixed;
                background: transparent;
                box-sizing: border-box;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            img {
                height: 75px;
                width: 75px;
                border: 2px solid black;
                border-radius: 10px;
                margin: 1%;
            }
           
            
            

            ul {
                color: rgb(236, 230, 230);
                margin: 0%;
                display: flex;
                list-style: none;
            }

            span {
                color: #0e0d0d;
                 margin-left: -155%; 
                font-size: 30px;
                pointer-events: none;
            }

            li a {
                font-size: 20px;
                text-decoration: none;
                padding: 0 20px;
                font-weight: bold;
                position: relative;
            }

            li a:visited {
                color: black;
            }

            li a:hover {
                color: blue;
            }

            li a::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: -5px;
                margin-left: 15px;
                width: 70%;
                height: 3px;
                background-color: blue;
                border-radius: 5px;
                transform-origin: right;
                transform: scaleX(0);
                transition: transform 0.5s;
            }

            li a:hover::after {
                transform: scaleX(1);
                transform-origin: left;
            }

            .leaf {
                height: 375px;
                width: 375px;
                border-left-style: groove;
                border-right-style: groove;
                border-bottom-style: hidden;
                border-top-style: hidden;
                border-top-left-radius: 150px;
                border-bottom-right-radius: 150px;
                border-width: 10px;
                border-inline-color: rgb(88, 134, 233);
                margin-left: 500px;
                background: linear-gradient(rgb(166, 238, 21), rgb(123, 222, 230));
                margin-top: 150px;
                margin: 250px;
            }

            .input-box {
                border: none;
                border-style: none;
                border-radius: 30px;
                box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.2),
                            5px 5px 15px rgba(0, 0, 0, 0.5),
                            inset -5px -5px 5px rgba(255, 255, 255, 0.2),
                            inset 5px 5px 5px rgba(0, 0, 0, 0.1);
            }

            .middle form {
                width: 100%;
                padding: 0 50px;
            }

            h2 {
                font-size: 1.75em;
                color: rgb(85, 10, 236);
                text-align: center;
                text-shadow: 2px 2px 2px rgb(217, 209, 214);
                padding-top: 65px;
                padding-bottom: 0px;
            }

            .input-box {
                position: relative;
                margin: 15px 0;
            }

            .input-box input {
                width: 100%;
                height: 40px;
                background: transparent;
                border: 2px solid rgb(142, 202, 24);
                border-radius: 30px;
                outline: none;
                transition: 0.5s ease;
                font-size: medium;
                color: rgb(4, 4, 4);
                padding: 0 15px;
            }

            .input-box label {
                color: rgb(246, 245, 249);
                position: absolute;
                top: 50%;
                left: 10%;
                transform: translateY(-50%);
                font-size: medium;
                pointer-events: none;
                transition: 0.3s ease;
                font-weight: bold;
            }

            .input-box input:focus~label,
            .input-box input:valid~label {
                top: 1px;
                font-size: small;
                background-color: rgb(249, 243, 243);
                border-radius: 10px;
                padding: 0 8px;
                color: black;
            }

            .input-box input:focus,
            .input-box input:valid {
                border-color: white;
            }

            .forgotpass {
                text-align: right;
                margin: -10px 0 20px;
                margin-right: 15px;
            }

            .forgotpass a {
                font-size: 15px;
                color: rgb(239, 52, 10);
                text-decoration: none;
            }

            .forgotpass a:hover {
                text-decoration: underline;
                color: rgb(33, 67, 202);
            }

            .btn {
                width: 100%;
                height: 40px;
                border: none;
                outline: none;
                border-radius: 30px;
                background-color: rgb(40, 21, 213);
                font-size: large;
                color: black;
                font-weight: 600;
                box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.2),
                            5px 5px 15px rgba(0, 0, 0, 0.5),
                            inset -5px -5px 5px rgba(15, 14, 14, 0.1),
                            inset 5px 5px 5px rgba(0, 0, 0, 0.1);
            }

            .btn:hover {
                border-color: white;
                border: 2px solid white;
                color: white;
                cursor: pointer;
            }

    </style>
</head>
<body>
    <div class="container">
        <nav id="navigationbar">
            <img src="Pictures/clglogo.jpg"> 
            <ul>
                <li><span>Bhandarkars' Arts and Science College</span></li>
                <li><a href="home.html" >home</a></li>                   
            </ul>                            
        </nav>
        <div class="leaf">
            <div class="middle">    <!--login-box-->
                <h2><b>LOGIN</b></h2>
                <form action="login.php" method="POST">
                    <div class="input-box">
                        <input type="text" id="email" name="email" class="form__input"  maxlength="30" required>
                        <label for="username" class="form__label">Email</label>
                    </div>
                    <div class="input-box"> 
                        <input type="password" id="password" name="password"  maxlength="15" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forgotpass">
                        <a class="link1" id="link1" href="changepassphp.php">forgot password?</a>
                    </div>
                    <button type="submit" class="btn" value="login" name="login">Login</button><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php

$_SESSION['user'] = '';
if (isset($_POST['login'])) {
    $em = $_POST['email'];
    $pass = $_POST['password'];

    @$con = new mysqli('localhost', 'root', '', 'attendance');

    $qry = "SELECT * FROM admin WHERE email='$em'";
    $result = mysqli_query($con, $qry);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['password']) {
            $_SESSION['user'] = $em;
            echo "<script>window.location.href='admin.php';</script>";
            exit;
        } else {
            echo "<script>alert(' Wrong Password ');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }

    $qry = "SELECT * FROM studinfo WHERE email='$em'";
    $result = mysqli_query($con, $qry);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['password']) {
            $_SESSION['user'] = $em;
            echo "<script>window.location.href='student/viewattendance.php';</script>";
            exit;
        } else {
            echo "<script>alert(' Wrong Password ');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }
    $qry = "SELECT * FROM staffinfo WHERE email='$em'";
    $result = mysqli_query($con, $qry);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['password']) {
            $_SESSION['user'] = $em;
            echo "<script>window.location.href='staff/todaysattendance.php';</script>";
            exit;
        } else {
            echo "<script>alert(' Wrong Password ');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }

    $qry = "SELECT * FROM admin WHERE password='$pass'";
    $result = mysqli_query($con, $qry);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (!($em == $row['email'])) {
            echo "<script>alert(' Wrong Email-ID ');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }

    $qry = "SELECT * FROM staffinfo WHERE password='$pass'";
    $result = mysqli_query($con, $qry);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (!($em == $row['email'])) {
            echo "<script>alert(' Wrong Email-ID ');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }

    $qry = "SELECT * FROM studinfo WHERE password='$pass'";
    $result = mysqli_query($con, $qry);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (!($em == $row['email'])) {
            echo "<script>alert(' Wrong Email-ID ');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }

    echo "<script>alert('You are not an authenticated user');</script>";
    echo "<script>window.location.href='login.php';</script>";
}
?>

