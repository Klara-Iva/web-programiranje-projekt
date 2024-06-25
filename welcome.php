<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
 
</head>
<body>
    
    <?php include('includes/header.php'); ?>

    <header class="hero">
        <div class="hero-content">
            <h1>Welcome to FlowerWorld</h1>
            <p>Your ultimate destination for beautiful flowers.</p>
            <?php if ($isLoggedIn): ?>
                <a href="flowers.php" class="cta-button">Explore Now</a>
            <?php else: ?>
                <a href="login.php" class="cta-button">Explore Now</a>
            <?php endif; ?>
        </div>
    </header>
    
    <section class="features" >
        <div class="feature">
            <h2>Discover</h2>
            <p>Explore a wide variety of flowers from around the world.</p>
        </div>
        <div class="feature">
            <h2>Favorites</h2>
            <p>Save your favorite flowers and access them anytime.</p>
        </div>
        <div class="feature">
            <h2>Learn</h2>
            <p>Get detailed information about each flower.</p>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
  
</body>

</html>
