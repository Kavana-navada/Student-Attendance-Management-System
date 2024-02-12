<!DOCTYPE html>
<html>
<head>
    <title>Attendance Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        input[type="checkbox"] {
            zoom: 1.5; /* Adjust the checkbox size as needed */
        }
    </style>
</head>
<body>
    <?php
    // Establish the database connection
    $host = "localhost"; // Replace with your database host
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $database = "attendance"; // Replace with your database name

    $connection = mysqli_connect($host, $username, $password, $database);
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }
session_start();
    // Retrieve the staff's email and staff ID from the database based on the session ID
    $session_id = $_SESSION['user']; // Assuming you have stored the session ID
    $query = "SELECT * FROM staffinfo WHERE email = '$session_id'";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $staff_id = $row['staffid'];
       
    } else {
        // Handle error, such as invalid session ID or staff not found
        echo '<script>alert("Invalid session ID or staff not found.");</script>';
    }
    $subinfo_query = "SELECT course, clas, sem, sname FROM subinfo WHERE staffid = '$staff_id'";
    $subinfo_result = mysqli_query($connection, $subinfo_query);

    // Handle the form submission when the "Mark Attendance" button is clicked
    if (isset($_POST['mark_attendance'])) {
        // Display the date selector
        echo '<form method="POST">';
        echo '<input type="date" name="date" required>';
        echo '<button type="submit" name="load">Load</button>';
        echo '</form>';
    }

    // Handle the form submission when the "Load" button is clicked
    if (isset($_POST['load'])) {
        $selected_date = $_POST['date']; // Assuming you have a form field with the name "date"
        // Display the attendance information for the selected date
        if ($selected_date) {
            // Retrieve the attendance information from the database based on the selected date and staff ID
               
                // Display the attendance information in an HTML table
               
                echo '<table>';
                echo '<tr><th>Roll No</th><th>Student Name</th><th>Present</th></tr>';
                while ($row = mysqli_fetch_assoc($results)):{
                    echo '<tr>';
                    echo '<td>' . $row['rollno'] . '</td>';
                    echo '<td>' . $row['firstname'] . '</td>';
                    echo '<td><input type="checkbox" name="attendance[' . $row['rollno'] . ']" value="present"';
                    if ($row['present'] == 'present') {
                        echo ' checked';
                    }
                    echo '></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<button type="submit" name="submit">Submit Attendance</button>';
            } 
        else {
            // No date selected
            echo '<script>alert("Please select a date.");</script>';
        }
    }

    // Close the database connection
    mysqli_close($connection);
    ?>

    <!-- Add your HTML code here -->

    <!-- Display the courses, classes, semesters, and subject names handled by the staff -->
    <form method="POST">
        <?php while ($subinfo_row = mysqli_fetch_assoc($subinfo_result)): ?>
            <div>
                <p>Course: <?php echo $subinfo_row['course']; ?></p>
                <p>Class: <?php echo $subinfo_row['clas']; ?></p>
                <p>Semester: <?php echo $subinfo_row['sem']; ?></p>
                <p>Subject Name: <?php echo $subinfo_row['sname']; ?></p>
                <button type="submit" name="mark_attendance">Mark Attendance</button>
                
            </div>
        <?php endwhile; ?>
    </form>

</body>
</html>
