<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Existing content of the page -->

    <footer>
        <div class="footer-container">
            <div class="footer-about">
                <h3>About Us</h3>
                <p>FlowerWorld is your ultimate destination for discovering and saving your favorite flowers. Search for your favorite flowers and learn when they bloom.</p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="flowers.php">Flowers</a></li>
                    <li><a href="addflower.php">Add your own flower</a></li>
                    <li><a href="bloom_chart.php">Bloom chart</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="https://hr-hr.facebook.com/"><img src="https://store-images.s-microsoft.com/image/apps.37935.9007199266245907.b029bd80-381a-4869-854f-bac6f359c5c9.91f8693c-c75b-4050-a796-63e1314d18c9?h=464" alt="Facebook"></a></li>
                    <li><a href="https://x.com/"><img src="https://static.dezeen.com/uploads/2023/07/x-logo-twitter-elon-musk_dezeen_2364_col_0.jpg" alt="Twitter"></a></li>
                    <li><a href="https://www.instagram.com/"><img src="https://cdn.pixabay.com/photo/2021/06/15/12/14/instagram-6338393_1280.png" alt="Instagram"></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 FlowerWorld. All rights reserved.</p>
            <?php if (isset($_SESSION['username'])): ?>
                <p>Currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <?php endif; ?>
        </div>
    </footer>
</body>
</html>
