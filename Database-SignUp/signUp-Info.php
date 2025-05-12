<?php
session_start();
$form_data = $_SESSION['form_data'];

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
$sql = "CREATE TABLE IF NOT EXISTS AccountInformation (
    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    FullName VARCHAR(30) NOT NULL,
    Age INT(3) NOT NULL,
    Gender VARCHAR(10) NOT NULL,
    Username_ VARCHAR(20) NOT NULL,
    Password_ VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
} else {
    echo "Table AccountInformation created successfully";
}

// Prepare and bind
$name = $form_data['name'];
$age = $form_data['age'];
$gender = $form_data['gender'];
$username_ = $form_data['username'];
$password_ = $form_data['password'];

$sql = "INSERT INTO AccountInformation (FullName, Age, Gender, Username_, Password_)
VALUES ('$name', '$age', '$gender', '$username_', '$password_')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
unset($_SESSION['form_data']);
// Redirect to the form page after submission
header("Location: ../login.php");
exit();
?>