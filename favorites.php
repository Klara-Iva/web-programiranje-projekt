<?php
include('includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    
    if (isset($_POST['remove'])) {
        $sql = "DELETE FROM favorites WHERE user_id='$user_id' AND item_id='$item_id'";
        $conn->query($sql);
    }
}
//first take the current users ID, then finds in favourite his saved flowers IDs,and then goes to item to fetch info for those flower IDs.
$sql = "SELECT items.id, items.name, items.short_description, items.long_description, items.bloom_months, items.picture_url FROM items 
        JOIN favorites ON items.id = favorites.item_id 
        WHERE favorites.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="styles/style.css">
<div class="container">
    <h2>Favorites</h2>
    <p>Here you can find your favorite flowers:</p>
    <div class="card-grid">
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="card" onclick="openmodalFavorites('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['long_description']; ?>', '<?php echo $row['bloom_months']; ?>', '<?php echo $row['picture_url']; ?>', true)">
            <img src="<?php echo $row['picture_url']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['short_description']; ?></p>
            <form method="POST" action="favorites.php">
                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="remove">Remove from Favorites</button>
            </form>
        </div>
    <?php endwhile; ?>
    </div>
</div>
    <!--HTML for setting the modal when opened -->
<div id="itemmodalFavorites" class="modalFlowers">
    <div class="modalFlowers-content">
        <span class="close" onclick="closemodalFavorites()">&times;</span>
        <img id="modalFavoritesImage"  src="" alt="" style="width:100%;height:auto;border-radius:16px;">
        <h3 id="modalFavoritesTitle"></h3>
        <p id="modalFavoritesDescription"></p><br>
        <h4>Bloom time:</h4>
        <div id="modalFavoritesBloomChart"></div>
        <p id="modalFavoritesFavorite"></p>
    </div>
</div>

<script>
function openmodalFavorites(id, name, long_description, bloom_months, picture_url, isFavorite) {
    document.getElementById('modalFavoritesImage').src = picture_url;
    document.getElementById('modalFavoritesTitle').textContent = name;
    document.getElementById('modalFavoritesDescription').textContent = long_description;
   // Create bloom chart
   var bloomMonthsArray = bloom_months.split(',').map(Number);
    var bloomChartHtml = '<div class="bloom-chart"><table>';
  
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    for (var i = 0; i < months.length; i++) {
        bloomChartHtml += '<th>' + months[i] + '</th>';
    }
    bloomChartHtml += '</tr></thead><tbody>';
  
    for (var i = 1; i <= 12; i++) {
        var isBlooming = bloomMonthsArray.includes(i);
        bloomChartHtml += '<td class="' + (isBlooming ? 'blooming' : '') + '"></td>';
    }
    bloomChartHtml += '</tr></tbody></table></div>';

    document.getElementById('modalFavoritesBloomChart').innerHTML = bloomChartHtml;  document.getElementById('modalFavoritesFavorite').textContent = isFavorite ? "This item is in your favorites." : "This item is not in your favorites.";
    document.getElementById('itemmodalFavorites').style.display = "block";
}

function closemodalFavorites() {
    document.getElementById('itemmodalFavorites').style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById('itemmodalFavorites')) {
        closemodalFavorites();
    }
}
</script>
<?php include('includes/footer.php'); ?>
