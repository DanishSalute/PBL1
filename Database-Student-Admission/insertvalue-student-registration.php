<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "StudentRegister";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS StudentsAdmission (
    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    StudentName VARCHAR(30) NOT NULL,
    Age INT(3) NOT NULL,
    Gender VARCHAR(10) NOT NULL,
    EducationLevel VARCHAR(20) NOT NULL,
    Course1 VARCHAR(50) NOT NULL,
    Course2 VARCHAR(50),
    Course3 VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
} else {
    echo "Table StudentsAdmission created successfully";
}

// Prepare and bind
$student_name = $_POST['name'];
$student_age = $_POST['age'];
$student_gender = $_POST['gender'];
$student_education = $_POST['education'];
$student_course1 = $_POST['course1'];
$student_course2 = $_POST['course2'];
$student_course3 = $_POST['course3'];

$sql = "INSERT INTO studentsadmission (StudentName, Age, Gender, EducationLevel, Course1, Course2, Course3)
VALUES ('$student_name', '$student_age', '$student_gender', '$student_education', '$student_course1', '$student_course2', '$student_course3')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

// Redirect to the form page after submission
header("Location: ../homepage.html");
exit();
?>