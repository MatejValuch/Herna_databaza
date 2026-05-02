<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upraviť hru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $id_hry = $_POST["id_hry"];
        $nazov = $_POST["nazov"];
        $zaner = $_POST["zaner"];
        $dev_nazov = $_POST["dev"];
        $krajina = $_POST["krajina"];
        $typ = $_POST["typ"];
        $dev_id = $_POST["dev_id"];

        $update_dev = "UPDATE dev SET dev_nazov='$dev_nazov', krajina='$krajina', typ='$typ' WHERE dev_id='$dev_id'";
        mysqli_query($conn, $update_dev);

        $update_hra = "UPDATE hra SET nazov='$nazov', zaner='$zaner' WHERE hra_id='$id_hry'";

        if (mysqli_query($conn, $update_hra)) {
            header("Location: kniznica.php?msg=upravene");
            exit();
        }
    }
    ?>
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">Upraviť hru: <?php echo $data['nazov']; ?></h2>
                <a href="kniznica.php" class="btn btn-secondary fs-5">Zrušiť</a>
            </div>

            <form method="POST">
                <input type="hidden" name="id_hry" value="<?php echo $data['hra_id']; ?>">
                <input type="hidden" name="dev_id" value="<?php echo $data['dev_id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Názov hry:</label>
                    <input type="text" name="nazov" class="form-control" value="<?php echo $data['nazov']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Žáner hry:</label>
                    <input type="text" name="zaner" class="form-control" value="<?php echo $data['zaner']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Názov vývojára:</label>
                    <input type="text" name="dev" class="form-control" value="<?php echo $data['dev_nazov']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sídlo vývojára:</label>
                    <input type="text" name="krajina" class="form-control" value="<?php echo $data['krajina']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Typ vývojára:</label>
                    <input type="text" name="typ" class="form-control" value="<?php echo $data['typ']; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-success w-100">Uložiť zmeny</button>
            </form>
        </div>
    </div>
</body>
</html>