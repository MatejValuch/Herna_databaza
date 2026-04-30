<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <a href="index.php" style="text-decoration: none;">
            <button type="button">Späť</button>
        </a>
    </form>
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "hernabaza");

        if (isset($_POST['delete_id'])) {
            $deletid = $_POST['delete_id'];
            $delete_hra = "DELETE FROM hra WHERE hra_id = '$deletid'";
            $query = mysqli_query($conn, $delete_hra);
        }

        $select = "SELECT hra.hra_id, hra.nazov, hra.zaner, dev.dev_nazov, dev.krajina, dev.typ FROM hra INNER JOIN dev ON hra.dev_id = dev.dev_id;";
        $query = mysqli_query($conn, $select);
        while ($row = mysqli_fetch_assoc($query)) {
            echo "Hra: " . $row['nazov'] . " | Žáner: " . $row['zaner'] . " | Vývojár: " . $row['dev_nazov'] . " | Krajina: " . $row["krajina"] . "| Typ: " . $row["typ"];
            ?>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?php echo $row['hra_id'];?>">
                <button type="submit">Delete</button>
            </form>

            <form action="uprava.php" method="GET" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $row['hra_id'];?>">
                <button type="submit">Upraviť</button>
            </form>
            <?php
            echo "<br>";
        }
    ?>
</body>
</html>