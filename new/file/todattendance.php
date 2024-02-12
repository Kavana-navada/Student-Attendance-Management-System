<?php
session_start();

// Step 1: Retrieve staff's first name and last name from staffinfo table based on email
$email = $_SESSION['user'];

// Step 2: Establish database connection
$servername = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "attendance"; // Replace with your database name

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Step 3: Retrieve staff's first name and last name from staffinfo table based on email
$query = "SELECT firstname, lastname FROM staffinfo WHERE email = '$email'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];

  // Step 4: Merge first name and last name to create staff name
  $staffName = $firstname . ' ' . $lastname;

  // Step 5: Select class, sem, and course associated with staff name from staffinfo table
  $query = "SELECT  clas, sem, course,sname FROM subinfo WHERE staffname = '$staffName'";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $class = $row['clas'];
    $sem = $row['sem'];
    $course = $row['course'];
    $sname=$row['sname'];

    // Step 6: Fetch rollno and firstname of students from studinfo table based on selected values
    if (isset($_POST['load'])) {
      $selectedClass = $_POST['class'];
      $selectedSem = $_POST['sem'];
      $selectedCourse = $_POST['course'];
     // $selectedsub = $_POST['sname'];

      $query = "SELECT rollno, firstname FROM studinfo WHERE clas = '$selectedClass' AND sem = '$selectedSem' AND course = '$selectedCourse'";
      $result = mysqli_query($connection, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $rollno = array();
        $firstname = array();

        while ($row = mysqli_fetch_assoc($result)) {
          $rollno[] = $row['rollno'];
          $firstname[] = $row['firstname'];
        }
      }
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Today's Attendance</title>
</head>
<body>
  <h1>Today's Attendance</h1>

  <form method="POST" action="">
    <label for="class">Class:</label>
    <select name="class" id="class">
      <option value="<?php echo $class; ?>"><?php echo $class; ?></option>
    </select>

    <label for="sem">Semester:</label>
    <select name="sem" id="sem">
      <option value="<?php echo $sem; ?>"><?php echo $sem; ?></option>
    </select>

    <label for="course">Course:</label>
    <select name="course" id="course">
      <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
    </select>

    <label for="sname">Subject:</label>
    <select name="sname" id="sname">
      <option value="<?php echo $sname; ?>"><?php echo $sname; ?></option>
    </select>

    <button type="submit" name="load">Load</button>
  </form>

  <?php if (isset($rollno) && isset($firstname)): ?>
    <table>
      <tr>
        <th>Roll No</th>
        <th>First Name</th>
      </tr>
      <?php foreach ($rollno as $key => $value): ?>
        <tr>
          <td><?php echo $value; ?></td>
          <td><?php echo $firstname[$key]; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</body>
</html>

<?php
// Step 7: Close the database connection
mysqli_close($connection);
?>
