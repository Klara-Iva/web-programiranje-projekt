<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// SQL query to fetch flowers sorted by bloom months
$sql = "SELECT name, bloom_months FROM items ORDER BY 
        FIND_IN_SET('12', bloom_months),
        FIND_IN_SET('11', bloom_months),
        FIND_IN_SET('10', bloom_months),
        FIND_IN_SET('9', bloom_months),
        FIND_IN_SET('8', bloom_months),
        FIND_IN_SET('7', bloom_months),
        FIND_IN_SET('6', bloom_months),
        FIND_IN_SET('5', bloom_months),
        FIND_IN_SET('4', bloom_months),
        FIND_IN_SET('3', bloom_months),
        FIND_IN_SET('2', bloom_months),
        FIND_IN_SET('1', bloom_months)";
$result = $conn->query($sql);
?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="styles/style.css">

<div class="container">
    <h2>Flower Bloom Times</h2>
    <div class="bloom-chart">
        <table>
            <thead>
                <tr>
                    <th>Flower</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $bloom_months = explode(',', $row['bloom_months']);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        for ($month = 1; $month <= 12; $month++) {
                            if (in_array(strval($month), $bloom_months)) {
                                echo "<td class='blooming'></td>";
                            } else {
                                echo "<td></td>";
                            }
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No flowers found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<style>
.bloom-chart {
    width: 100%;
    overflow-x: auto;
}

.bloom-chart table {
    width: 100%;
    border-collapse: collapse;
}

.bloom-chart th, .bloom-chart td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.bloom-chart th {
    background-color: #f2f2f2;
}

.blooming {
    background-color: #ffeb3b;
}
</style>
