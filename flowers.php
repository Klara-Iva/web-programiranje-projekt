<?php
include('includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    if (isset($_POST['action']) && $_POST['action'] == 'remove') {
        $sql = "DELETE FROM favorites WHERE user_id='$user_id' AND item_id='$item_id'";
    } else {
        $sql = "INSERT INTO favorites (user_id, item_id) VALUES ('$user_id', '$item_id')";
    }
    $conn->query($sql);
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$favorites = [];
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $fav_sql = "SELECT item_id FROM favorites WHERE user_id = '$user_id'";
    $fav_result = $conn->query($fav_sql);
    while ($fav_row = $fav_result->fetch_assoc()) {
        $favorites[] = $fav_row['item_id'];
    }
}
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="styles/style.css">
<div class="container">
    <div class="header-line">
        <p>Here you can find all flowers we collected.</p>
        <form>
            <input type="text" id="search" placeholder="Search for flowers..." style="width: 200px">
        </form>
    </div>
    <br><br>
    <div class="card-grid" id="card-grid">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="card" data-item-id="<?php echo $row['id']; ?>" data-name="<?php echo strtolower($row['name']); ?>" data-description="<?php echo strtolower($row['short_description']); ?>">
        <!--Code for  switching the heart picture for liked and not liked flowers, it sends true or false whenever the flower is in faves-->    
            <div class="favorite-icon" onclick="toggleFavorite(event, '<?php echo $row['id']; ?>', <?php echo in_array($row['id'], $favorites) ? 'true' : 'false'; ?>)">
                    <img src="<?php echo in_array($row['id'], $favorites) ? 'images/like-full.png' : 'images/like-border.png'; ?>" alt="Favorite" style="width: 40px; height: 40px;border-radius:0px;">
                </div>
                <img src="<?php echo $row['picture_url']; ?>" alt="<?php echo $row['name']; ?>" onclick="openmodalFlowers('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['long_description']; ?>', '<?php echo $row['bloom_months']; ?>', '<?php echo $row['picture_url']; ?>', <?php echo in_array($row['id'], $favorites) ? 'true' : 'false'; ?>)">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['short_description']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
    <p id="not-found" style="display: none;">Not found</p>
</div>

<div id="itemmodalFlowers" class="modalFlowers">
    <div class="modalFlowers-content">
        <span class="close" onclick="closemodalFlowers()">&times;</span>
        <img id="modalFlowersImage" src="" alt="" style="width:100%;height:auto;border-radius:16px;">
        <div class="modalFlowers-text">
            <h3 id="modalFlowersTitle"></h3>
            <p id="modalFlowersDescription"></p><br>
            <h4>Bloom time:</h4>
            <div id="modalFlowersBloomChart"></div><br>
            <p id="modalFlowersFavorite"></p>
        </div>
    </div>
</div>

<script>
function openmodalFlowers(id, name, long_description, bloom_months, picture_url, isFavorite) {
    document.getElementById('modalFlowersImage').src = picture_url;
    document.getElementById('modalFlowersTitle').textContent = name;
    document.getElementById('modalFlowersDescription').textContent = long_description;

    // Create bloom chart, weirdly written bc its in a script
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

    document.getElementById('modalFlowersBloomChart').innerHTML = bloomChartHtml;
    document.getElementById('modalFlowersFavorite').textContent = isFavorite ? "This item is in your favorites." : "This item is not in your favorites.";
    document.getElementById('itemmodalFlowers').style.display = "block";
}

function closemodalFlowers() {
    document.getElementById('itemmodalFlowers').style.display = "none";
}

function toggleFavorite(event, item_id, isCurrentlyFavorite) {
    event.stopPropagation();
    var action = isCurrentlyFavorite ? 'remove' : 'add';
    var formData = new FormData();
    formData.append('item_id', item_id);
    formData.append('action', action);

    fetch('flowers.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Update the favorite icon image
        var card = document.querySelector(`.card[data-item-id='${item_id}']`);
        var favoriteIcon = card.querySelector('.favorite-icon img');
        if (isCurrentlyFavorite) {
            favoriteIcon.src = 'images/like-border.png'; // Change to border icon after removal
            favoriteIcon.onclick = function(event) { toggleFavorite(event, item_id, false); }
        } else {
            favoriteIcon.src = 'images/like-full.png'; // Change to full icon after addition
            favoriteIcon.onclick = function(event) { toggleFavorite(event, item_id, true); }
        }
    })
    .catch(error => console.error('Error:', error));
}

window.onclick = function(event) {
    if (event.target == document.getElementById('itemmodalFlowers')) {
        closemodalFlowers();
    }
}

//search function 
document.getElementById('search').addEventListener('input', function() {
    var searchQuery = this.value.toLowerCase();
    var cards = document.querySelectorAll('.card');
    var found = false;//if none are found, it serves to show the message that none are found

    cards.forEach(function(card) {
        var name = card.getAttribute('data-name');
        var description = card.getAttribute('data-description');
        if (name.includes(searchQuery) || description.includes(searchQuery)) {
            card.style.display = '';
            found = true;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('not-found').style.display = found ? 'none' : 'block';
});
</script>

<style>
.header-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.favorite-icon {
    position: absolute;
    top: 20px;
    right: 20px;
}

.card {
    position: relative;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  
    transition: box-shadow 0.3s ease-in-out;
}

.card:hover {
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

</style>
<?php include('includes/footer.php'); ?>
