<?php
include('includes/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
          $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Username does not exist, proceed with registration
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Get the newly created user's ID
            $user_id = $conn->insert_id;

 
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username; 
            $_SESSION['is_admin'] = 0; 

            header("Location: welcome.php");
            exit();
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="styles/style.css">
<div class="container register-container">
    <h2 class="register-title">Register</h2>
    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST" action="register.php" class="register-form">
        <label for="username" class="register-label">Username</label>
        <input type="text" id="username" name="username" class="register-input" required>
        <label for="password" class="register-label">Password</label>
        <input type="password" id="password" name="password" class="register-input" required><br>
        <button type="submit" class="register-button">Register</button>
    </form>

    <div class="login-container">
        <p class="login-text">You already have an account?</p>
        <a href="login.php" class="login-button">Login</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>
