<!DOCTYPE html>
<head>
  <title>Today attendance table</title>
</head>
<style>
  body
  {
    background:rgb(253, 247, 253);
  }
  p{
    color: red;
    font-size: 25px;
    text-align: center;
    
  }
  .tabletop{
    
      display: flex;
      align-items: center;
      justify-content:space-around;
      padding: 20px;
      background-color: rgb(240,240,240);
      font-size: 20px;
      width:50%;
      margin-left:22%;
      margin-top: -1%; 
    }
    select{
      font-size: 20px;
      margin-left: 10px;
      border-radius: 5px;
      border:none;
      outline: none;
    }
    .table_selection{
      overflow: auto;
      height: 650px;
    }
    table{
      cursor: default;
      table-layout: fixed;
      min-width: 765px;
      margin-left:23%;
      border-collapse: collapse;
      margin-top: 1%;
      background-color: rgb(238, 231, 238);
    }
    thead td{
      position: sticky;
      top:0;
      background-color:rgb(157, 135, 176);
      color: rgb(8, 27, 80);
      font-size: 26px;
      font-weight: 700;
      text-align: center; 
    }
    td{
      border-bottom: 1px solid #dddddd;
      padding: 5px 20px;
      font-size:20px ;
      word-break: break-all;
      text-align: center;
    }
    
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    
    tr:hover {
      background-color: rgb(225, 212, 237);
    }
  #tablerow:hover td{ 
      color: #066284;
      background-color: #0c0d0c11;
      font-size: 21px;
    }
    input[type=checkbox]
    {
      height: 20px;
      width: 40px;
    }
    .btns{
      display: flex;
    }
    #submitAttendance{
      border:none;
      position: relative;
      background: none;
      padding: 10px 40px;
      display: inline-block;
      text-transform: uppercase;
      background: rgb(80, 47, 112);
      color: #fff;
      letter-spacing: 2px;
      font-size: 1rem;
      font-weight: 800;
      transform-style: preserve-3d;
      outline: none;
      outline: 1px solid transparent;
      transition: all 0.5s ease-out;
      cursor: pointer;
      margin-left: 23%;
      margin-top: 1%;
      width: 370px;
      margin-right: 1.8%;
    }
    #submitAttendance:after{
      content: "submit Attendance";
      position: absolute;
      padding: 10px 0px;
      z-index: -1;
      transition: all 0.5s ease-out;
      width: 370px;
      
      left: 0;
      top:-100%;
      background: rgb(159, 106, 211);
      transform-origin: 0% 100%;
      transform: rotateX(90deg);
    }
    #submitAttendance:hover{
      transform: translateY(40px) rotateX(-90deg);
    }
    #backbtn{
      border:none;
      position: relative;
      background: none;
      padding: 10px 40px;
      display: inline-block;
      text-transform: uppercase;
      background: rgb(159, 106, 211);
      color: #fff;
      letter-spacing: 2px;
      font-size: 1rem;
      font-weight: 800;
      transform-style: preserve-3d;
      outline: none;
      outline: 1px solid transparent;
      transition: all 0.5s ease-out;
      cursor: pointer;
      margin-top: 1%;
      width: 370px;
      margin-right: 1.8%;
    }
    #backbtn:after{
      content: "Back";
      position: absolute;
      padding: 10px 0px;
      z-index: -1;
      transition: all 0.5s ease-out;
      width: 370px;
      
      left: 0;
      top:-100%;
      background: rgb(80, 47, 112);
      transform-origin: 0% 100%;
      transform: rotateX(90deg);
    }
    #backbtn:hover{
      transform: translateY(40px) rotateX(-90deg);
    }
</style>
<script>
  function toggleCheckboxes() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var selectAllCheckbox = document.getElementById('select-all');
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = selectAllCheckbox.checked;
    }
  }
</script>
<body></body>
</html>
<?php
  $course= $_GET['course'];
  $class= $_GET['class'];
  $sub=$_GET['sub'];
  $sem=$_GET['sem']; 
  $sid=$_GET['sid'];

  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'attendance';
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  session_start();
  $email=$_SESSION['user'];
  $query = "SELECT * FROM studinfo WHERE course = '$course' and clas = '$class' and sem = '$sem'";
  $result = mysqli_query($conn, $query);
  $currentDate = date('d-m-Y');
  $cDate = date('Y-m-d');
  $query1 = "SELECT * FROM attendance WHERE adate = '$cDate' and sid = '$sid'";
  $result1 = mysqli_query($conn, $query1);
  if($result1->num_rows>0){
    $issued='yes';
      echo "<p>Attendance has already been issued on this date, submitting will add aditional attendance</p>";
  }
  else
  {
    $issued='no';
  }
  echo '<div class="tabletop"><label>Date:  '.$currentDate.'</label>';
  echo'
  <form action="submit.php?course=' . $course . '&class=' . $class . '&sem=' . $sem . '&sub=' . $sub .'&sid='.$sid.'&issued='.$issued. '" method=POST>
  <label>Select Hours:</label><select name="hours">
    <option value="1">1 hour</option>
    <option value="2">2 hours</option>
    <option value="3">3 hours</option>
    <option value="4">4 hours</option>
  </select>
  </div>
  <div class="table_selection">
      <table><thead><tr>
      <td>Roll number</td><td>Name</td><td><input type="checkbox" id="select-all" onchange="toggleCheckboxes()"> All Present</td>
      </tr></thead>';
      while ($row = mysqli_fetch_assoc($result))
      {
          echo'
          <tr id="tablerow">
            <td> '.$row["rollno"].'</td>
            <td>'.$row["firstname"].' '.$row["lastname"].'</td>
            <td><input type="checkbox" name="'. $row['rollno'].'" value="present"></td>
          </tr>';
      }
      echo'</table>
    <div class="btns">
      <button type="submit" id="submitAttendance" name="submitAttendance">Submit Attendance</button>
      <button type="submit" id="backbtn" name="backbtn" value="Back" >Back</button>
    </div>
  </div>
  </form>';
?>