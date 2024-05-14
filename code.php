<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name"><br><br>
        <label>Contact Number:</label>
        <input type="text" name="contact_number"><br><br>
        <label>Address:</label>
        <input type="text" name="address"><br><br>
        <label>Student ID:</label>
        <input type="text" name="student_id"><br><br>
        <input type="submit" name="submit" value="Add Student">
    </form>

    <h2>Student Information</h2>
    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "your_database_name");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Add data to the database
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $contact_number = $_POST['contact_number'];
        $address = $_POST['address'];
        $student_id = $_POST['student_id'];

        $sql = "INSERT INTO students (name, contact_number, address, student_id) VALUES ('$name', '$contact_number', '$address', '$student_id')";

        if(mysqli_query($conn, $sql)){
            echo "Student added successfully.";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Display existing data
    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Contact Number</th><th>Address</th><th>Student ID</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row['name']."</td><td>".$row['contact_number']."</td><td>".$row['address']."</td><td>".$row['student_id']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
