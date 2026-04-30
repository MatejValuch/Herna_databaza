<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upraviť hru</title>
</head>
<body>
    <?php 
    $conn = mysqli_connect("localhost", "root", "root", "hernabaza");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT hra.*, dev.dev_nazov, dev.krajina, dev.typ 
                FROM hra 
                INNER JOIN dev ON hra.dev_id = dev.dev_id 
                WHERE hra.hra_id = '$id'";
        
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
    }
    ?>
    <div>
        <div>
            <div>
                <h2>Upraviť hru: <?php echo $data['nazov']; ?></h2>
                <a href="kniznica.php">Zrušiť</a>
            </div>

            <form method="POST">
                <input type="hidden" name="id_hry" value="<?php echo $data['hra_id']; ?>">
                <input type="hidden" name="dev_id" value="<?php echo $data['dev_id']; ?>">

                <div>
                    <label>Názov hry:</label>
                    <input type="text" name="nazov" value="<?php echo $data['nazov']; ?>" required>
                </div>
                <div>
                    <label>Žáner hry:</label>
                    <input type="text" name="zaner" value="<?php echo $data['zaner']; ?>" required>
                </div>
                <div>
                    <label>Názov vývojára:</label>
                    <input type="text" name="dev" value="<?php echo $data['dev_nazov']; ?>" required>
                </div>
                <div>
                    <label>Sídlo vývojára:</label>
                    <input type="text" name="krajina" value="<?php echo $data['krajina']; ?>" required>
                </div>
                <div>
                    <label>Typ vývojára:</label>
                    <input type="text" name="typ" value="<?php echo $data['typ']; ?>" required>
                </div>
                <button type="submit" name="update">Uložiť zmeny</button>
            </form>
        </div>
    </div>
</body>
</html>