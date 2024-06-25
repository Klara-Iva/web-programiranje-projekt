<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $item_id = $_POST['item_id'];
        
        // Delete from favorites first
        $sql_fav = "DELETE FROM favorites WHERE item_id='$item_id'";
        if ($conn->query($sql_fav) === TRUE) {
            //  delete the flower from items table
            $sql = "DELETE FROM items WHERE id='$item_id'";
            $conn->query($sql);
        }
    } else if (isset($_POST['update'])) {
        $item_id = $_POST['item_id'];
        $name = $_POST['name'];
        $short_description = $_POST['short_description'];
        $long_description = $_POST['long_description'];
        $bloom_months = implode(',', $_POST['bloom_months']);
        $picture_url = $_POST['picture_url'];
        $sql = "UPDATE items SET name='$name', short_description='$short_description', long_description='$long_description', bloom_months='$bloom_months', picture_url='$picture_url' WHERE id='$item_id'";
        $conn->query($sql);
    }
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="styles/style.css">
<div class="container">
    <h2>Edit Flowers</h2>
    <p>Here you can edit or delete flower information.</p>
    <div class="card-grid">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="<?php echo $row['picture_url']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <form method="POST" action="edit_flowers.php">
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <label for="name_<?php echo $row['id']; ?>">Name:</label>
                    <input type="text" id="name_<?php echo $row['id']; ?>" name="name" value="<?php echo $row['name']; ?>" required>
                    <label for="short_description_<?php echo $row['id']; ?>">Short Description:</label>
                    <input type="text" id="short_description_<?php echo $row['id']; ?>" name="short_description" value="<?php echo $row['short_description']; ?>" required>
                    <label for="long_description_<?php echo $row['id']; ?>">Long Description:</label>
                    <textarea id="long_description_<?php echo $row['id']; ?>" name="long_description" required><?php echo $row['long_description']; ?></textarea>
                    <label for="bloom_months_<?php echo $row['id']; ?>">Bloom months:</label>
                    <select id="bloom_months_<?php echo $row['id']; ?>" name="bloom_months[]" multiple required>
                        <?php
                        $selected_months = explode(',', $row['bloom_months']);
                        $months = [
                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                        ];
                        foreach ($months as $month_num => $month_name) {
                            $selected = in_array($month_num, $selected_months) ? 'selected' : '';
                            echo "<option value=\"$month_num\" $selected>$month_name</option>";
                        }
                        ?>
                    </select>
                    <label for="picture_url_<?php echo $row['id']; ?>">Picture URL:</label>
                    <input type="text" id="picture_url_<?php echo $row['id']; ?>" name="picture_url" value="<?php echo $row['picture_url']; ?>" required>
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete">Delete</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include('includes/footer.php'); ?>
