<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <header>
        <h1 align="center"><img src="Images/GMI-logo.png" alt="Logo" width="150px"></h1>
    </header>
    <table align="center" bgcolor="#173E8D" width="100%">
        <tr>
            <td align="center"><font size="5" face="Arial" color="white"><b>Register Account</b></font></td>
        </tr>
    </table>
    <br>
    <fieldset>
        <legend>User's Information</legend>
        <form action="signup.php" action="Database-SignUp/signUp-Info.php" method="post">
            <table width="100%">
                <tr height="50px">
                    <td><label for="name">Name</label></td>
                    <td><input type="text" name="name" required placeholder="John Doe" size="60"></td>
                    <td rowspan="3"><fieldset width="100%" align="center"><legend>Upload Picture</legend><input type="file"></fieldset></td>
                </tr>
                <tr height="50px">
                    <td><label for="gender">Gender</label></td>
                    <td>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" value="male" required>
                        <label for="female">Female</label>
                        <input type="radio" name="gender" value="female" required>
                    </td>
                </tr>
                <tr height="50px">
                    <td><label for="age">Age</label></td>
                    <td><input type="number" name="age" placeholder="18" required></td>
                </tr>
            </table>
    </fieldset>
    <br>
    <table align="center" width="22%">
        <tr height="30px">
            <td><label for="username">Username</label></td>
            <td align="right"><input type="text" name="username" placeholder="johndoe" size="30" required></td>
        </tr>
        <tr height="30px">
            <td><label for="password">Password</label></td>
            <td align="right"><input type="password" name="password" placeholder="password" size="30" required></td>
        </tr>
        <tr height="50px">
            <td></td>
            <td><label for="term">Do you agree to the <a href="term.html">terms and conditions</a></label><input type="checkbox" name="term" id="" required></td>
        </tr>
    </table>
    <table align="center" width="20%">
        <tr height="30px">
            <td align="right"><input type="submit" value="Sign Up"></td>
        </tr>
    </table>
    </form>
    <?php
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
    }

    $table = "AccountInformation";
    // Check if the table exists
    $sql = "SHOW TABLES LIKE '$table'";
    $result = $conn->query($sql);
    // Check Username existence
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM AccountInformation WHERE Username_ = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        session_start();

        if ($result->num_rows > 0) {
            echo "<p style='color:red;'>Username already exists</p>";
        } else {
            $_SESSION['form_data'] = $_POST; // store all form data
            header("Location: Database-SignUp/signUp-Info.php");
            exit();
        }
    }
    ?>
</body>
</html>