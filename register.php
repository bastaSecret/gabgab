<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="php.css"/>

    <script>
        $(document).ready(function() {
            // Password Confirmation
            $('#password_confirm-text').on('keyup', function () {
                var password = $('#password_hash-text').val();
                var confirmPassword = $('#password_confirm-text').val();
                if (password != confirmPassword) {
                    $('#password_confirm-text')[0].setCustomValidity("Passwords don't match");
                } else {
                    $('#password_confirm-text')[0].setCustomValidity('');
                }
            });
        });
    </script>
    
</head>
<body class="p-5">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="col-sm-6">
            <h3>USER REGISTRAION</h3>
        </div>
        <hr>
        <div class="col-md-6 mb-3">
            <label for="lastname-text" class="form-label">Lastname *</label>
            <input type="text" class="form-control form-control-md" name="lastname_text" id="lastname-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="firstname-text" class="form-label">Firstname *</label>
            <input type="text" class="form-control form-control-md" name="firstname_text" id="firstname-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="country-text" class="form-label">Country *</label>
            <input type="text" class="form-control form-control-md" name="country_text" id="country-text" value="Philippines" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="province-text" class="form-label">Province *</label>
            <select name="province" class="form-control form-control-md" id="province" required></select>
            <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="city-text" class="form-label">City / Municipality *</label>
            <select name="city" class="form-control form-control-md" id="city" required></select>
            <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="baranagay-text" class="form-label">Barangay *</label>
            <select name="baranagay_text" class="form-control form-control-md" id="baranagay" required></select>
            <input type="hidden" class="form-control form-control-md" name="baranagay" id="baranagay-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="subdivision-text" class="form-label">Subdivision (Optional)</label>
            <input type="text" class="form-control form-control-md" name="subdivision_text" id="subdivision-text">
        </div>
        <div class="col-md-6 mb-3">
            <label for="lot_blk-text" class="form-label">Lot/Block (Optional)</label>
            <input type="text" class="form-control form-control-md" name="lot_blk_text" id="lot_blk-text">
        </div>
        <div class="col-md-6 mb-3">
            <label for="street-text" class="form-label">Street (Optional)</label>
            <input type="text" class="form-control form-control-md" name="street_text" id="street-text">
        </div>
        <div class="col-md-6 mb-3">
            <label for="contact_number-text" class="form-label">Contact Number *</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">+63</span>
                </div>
                <input type="text" class="form-control form-control-md" name="contact_number_text" id="contact_number-text" required>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="password_hash-text" class="form-label">Password *</label>
            <input type="password" class="form-control form-control-md" name="password_hash_text" id="password_hash-text" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="password_confirm-text" class="form-label">Repeat Password *</label>
            <input type="password" class="form-control form-control-md" name="password_confirm_text" id="password_confirm-text" required>
        </div>
        <div class="dom">
            <input type="submit" class="btn btn-success" name="submit">

            <p>Already have an account? <a href="login.php" style="text-decoration: underline; color: white;">Login</a>.</p>
        </div>
    </form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $lastname = $_POST['lastname_text'];
    $firstname = $_POST['firstname_text'];
    $country = $_POST['country_text'];
    $province = $_POST['province_text'];
    $city = $_POST['city_text'];
    $baranagay = $_POST['baranagay_text'];
    $subdivision = $_POST['subdivision_text'];
    $lot_blk = $_POST['lot_blk_text'];
    $street = $_POST['street_text'];
    $contact_number = $_POST['contact_number_text'];
    $password = $_POST['password_hash_text'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Your database connection code goes here
    // Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
    $conn = new mysqli("localhost", "root", "", "db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into your database
    $sql = "INSERT INTO users (lastname, firstname, country, province, city_municipality, baranagay, subdivision, lot_blk, street, contact_number, password_hash) VALUES ('$lastname', '$firstname', '$country', '$province', '$city', '$baranagay', '$subdivision', '$lot_blk', '$street', '$contact_number', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Display the success message
        echo '<div class="message-container">';
        echo 'New record created successfully';
        echo '</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

