<?php
include('includes/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables for error and success messages
$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $shortDescription = $_POST['short_description'];
    $longDescription = $_POST['long_description'];
    $pictureUrl = $_POST['image_url']; 
    $bloom_months = implode(',', $_POST['bloom_months']);
    
    // SQL query to insert flower into database
    $sql = "INSERT INTO items (name, short_description, long_description, picture_url, bloom_months) VALUES ('$name', '$shortDescription', '$longDescription', '$pictureUrl', '$bloom_months')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "New flower added successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Add Flower</title>
    <style>
        .message-container, h2 {
            text-align: center;
            margin-top: 10px;
        }
        .success-message {
            color: green;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Add a New Flower</h2>
        
        <!-- Display success or error message -->
        <?php if ($message): ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form class="form-container" method="POST" action="addflower.php">
            <label for="name">Flower Name</label>
            <input type="text" id="name" name="name" required><br>

            <label for="short_description">Short Description</label>
            <input type="text" id="short_description" name="short_description" required><br>

            <label for="long_description">Long Description</label>
            <textarea id="long_description" name="long_description" rows="5" required></textarea><br>

            <label for="image_url">Image URL</label>
            <input type="url" id="image_url" name="image_url" required><br>

            <label for="bloom_months">Bloom months</label>
            <select id="bloom_months" name="bloom_months[]" multiple required>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <button type="submit">Add Flower</button> <!--when clicked triggest the post method to update to database-->
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
