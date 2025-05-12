
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <label for="logo">__________</label><img src="Images/GMI-logo.png" alt="Logo" width="500"><label for="logo">___________</label>
    <img align="right" src="Images/Class.jpg" alt="Class" width="1000" height="800">
    <hr>
    <pre>
    <font face="Tahoma" size="4"><h2>                                       Login</h2></font><form action="login.php" method="post">
                        <font face="Tahoma" size="4"><label for="username">Username : </label><input type="text" name="username" id="" placeholder="Username" size="30px" required></font><br>
        
                        <font face="Tahoma" size="4"><label for="password">Password : </label><input type="password" name="password" id="" placeholder="Password" size="30px" required><br><br></font>
                                    <a href="signup.php"><input type="button" value="Sign Up"></a>      <input type="submit" value="Login">
                                <font face="Tahoma" size="2" color="blue">*Create an account</font>
    </form>
    </pre>
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
    $table = "AccountInformation";
    // Check if the table exists
    $sql = "SHOW TABLES LIKE '$table'";
    $result = $conn->query($sql);
    // Verify Username and Password
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM AccountInformation WHERE Username_ = ? AND Password_ = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, redirect to homepage
            header("Location: homepage.html");
            exit();
        } else {
            echo "<p style='color:red;'>Invalid username or password</p>";
        }
    }
    ?>
</body>
</html>
