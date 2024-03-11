index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css"/>
</head>
<body>
<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the firstname and lastname fields are set
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];

        // Establish database connection
        $conn = new mysqli("localhost", "root", "", "db");

        // Check if connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform user authentication
        $query = "SELECT * FROM users WHERE firstname='$firstname' AND lastname='$lastname'";
        $result = $conn->query($query);

        if ($result) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Check if the provided password matches the password in the database
                if (password_verify($password, $row['password_hash'])) {
                    // Authentication successful, set session variables
                    $_SESSION['user_id'] = $row['user_id']; // Assuming you have a user_id column
                    header("Location: profile.php"); // Redirect to the user's profile page
                    exit();
                } else {
                    // Password does not match
                    echo "Incorrect password";
                }
            } else {
                // No user found with the provided first name and last name
                echo "User not found";
            }
        } else {
            // Query execution failed
            echo "Error: " . $conn->error;
        }

        $conn->close();
    } else {
        // Form fields are not set
        echo "First name, last name, and password fields are required";
    }
}
?>

    <div class="container">
        <div class="form">
            <h1>LOG IN</h1>
            <form action="" method="post" name="login">
                <input type="text" name="firstname" placeholder="First Name" required />
                <input type="text" name="lastname" placeholder="Last Name" required />
                <input type="password" name="password" placeholder="Password" required />
                <input name="submit" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='register.php'>Register Here</a></p>
        </div>
    </div>
    <?php ?>
    <script src="script.js"></script>
</body>
</html>