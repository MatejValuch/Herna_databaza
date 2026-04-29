<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4">Pridať novú hru</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Názov hry:</label>
                <input type="text" name="nazov" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Žáner hry:</label>
                <input type="text" name="zaner" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Názov vývojára:</label>
                <input type="text" name="dev" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Sídlo vývojára:</label>
                <input type="text" name="krajina" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Typ vývojára:</label>
                <input type="text" name="typ" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Pridaj!</button>
        </form>
    </div>
</div>
    <?php 
    $server_conn = new mysqli("localhost", "root", "root");
    $createDB = "CREATE DATABASE IF NOT EXISTS hernabaza;";
    $query = mysqli_query($server_conn, $createDB);

    $conn = mysqli_connect("localhost", "root", "root", "hernabaza");

    if (!$conn){
        echo "Nepodarilo sa pripojiť k databáze.";
    } else{
        echo "Pripojene k databaze.";
    }

    $hra = "CREATE TABLE IF NOT EXISTS hra(
    hra_id int primary key auto_increment,
    nazov varchar(30) unique not null, 
    zaner varchar(30) not null,
    dev_id int,
    
    foreign key (dev_id) references dev(dev_id));";

    $dev = "CREATE TABLE IF NOT EXISTS dev(
    dev_id int primary key auto_increment,
    dev_nazov varchar(30) unique not null,
    krajina varchar(30) not null,
    typ varchar(15) not null);";

    $query = mysqli_query($conn, $dev);
    $query = mysqli_query($conn, $hra);
    
    $dummy_dev = "INSERT IGNORE INTO dev (dev_nazov, krajina, typ) VALUES ('VALVe', 'USA', 'corporation');";
    $dummy_hra = "INSERT IGNORE INTO hra (nazov, zaner, dev_id) VALUES ('Team Fortress 2', 'FPS shooter', '1');";
    
    $query = mysqli_query($conn, $dummy_dev);
    $query = mysqli_query($conn, $dummy_hra);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nazov = $_POST["nazov"];
        $zaner = $_POST["zaner"];
        $dev = $_POST["dev"];
        $krajina = $_POST["krajina"];
        $typ = $_POST["typ"];

        $adata_dev = "INSERT INTO dev (dev_nazov, krajina, typ) VALUES ('$dev', '$krajina', '$typ');";
        $query = mysqli_query($conn, $adata_dev);

        $idecko = mysqli_query($conn, "SELECT dev_id FROM dev WHERE dev_nazov = '$dev'");
        $row = mysqli_fetch_assoc($idecko);
        $dev_id = $row['dev_id'];

        $adata_hra = "INSERT INTO hra (nazov, zaner, dev_id) VALUES ('$nazov', '$zaner', '$dev_id');";

        $query = mysqli_query($conn, $adata_hra);
    }
    ?>
</body>
</html>