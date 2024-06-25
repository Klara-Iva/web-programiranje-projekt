<?php
include('includes/db.php');
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;  
            $_SESSION['is_admin'] = $row['admin']; 
            header("Location: welcome.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that username.";
    }
}
?>

<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="styles/style.css">
<div class="container login-container">
    <h2 class="login-title">Login</h2>
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php" class="login-form">
        <label for="username" class="login-label">Username</label>
        <input type="text" id="username" name="username" class="login-input" required>
        <label for="password" class="login-label">Password</label>
        <input type="password" id="password" name="password" class="login-input" required>
        <button type="submit" class="login-button">Login</button>
    </form>

    <div class="register-container">
        <p class="register-text">Don't have an account?</p>
        <a href="register.php" class="register-button">Register</a>
    </div>
</div>
<?php include('includes/footer.php'); ?>
