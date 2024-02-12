<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "attendance";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_GET['str'])) {
      $dept = $_GET['str'];
      $sql = "SELECT staffid,firstname,lastname FROM staffinfo WHERE dept= '$dept'";
      $result = mysqli_query($conn, $sql);
      echo'<option value="">Select staff</option>';
      while($row = mysqli_fetch_array($result)) {
        echo '<option value="' . $row['staffid'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';
      }
      echo'</select>';
    }
  mysqli_close($conn);
?>