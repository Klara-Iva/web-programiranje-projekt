<?php
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FlowerWorld</title>
</head>
<body>
    <nav>
   
    <img src="images/logo.png" alt="Logo" class="logo">

   
    
    <!--Hamburger menu for small screen -->
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar" id="bar1"></span>
            <span class="bar" id="bar2"></span>
            <span class="bar" id="bar3"></span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="welcome.php">Welcome</a></li>
            <li><a href="flowers.php">Flowers</a></li>
            <li><a href="bloom_chart.php">Bloom chart</a></li>
            <li><a href="favorites.php">Favorites</a></li>
            <li><a href="addflower.php">Add flower</a></li>
            <!-- If user is admin, he can see edit flowers-->
            <?php if ($isAdmin): ?>
                        <li><a href="edit_flowers.php">Edit Flowers</a></li>
                    <?php endif; ?>

            <?php if ($isLoggedIn): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <script>
      
        const mobileMenu = document.getElementById('mobile-menu');
        const navLinks = document.getElementById('nav-links');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            mobileMenu.classList.toggle('open');

            if (mobileMenu.classList.contains('open')) { //makes X from 3 lines
                bar1.style.transform = 'rotate(-45deg) translate(-9px, 6px)';
                bar2.style.opacity = '0';
                bar3.style.transform = 'rotate(45deg) translate(-9px, -6px)';
            } else {
                bar1.style.transform = 'rotate(0) translate(0, 0)';
                bar2.style.opacity = '1';
                bar3.style.transform = 'rotate(0) translate(0, 0)';
            }
        });
    </script>

       <!-- Existing content of the page -->
</body>
</html>
