<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="nazov">Názov hry:</label>
        <input type="text" name="nazov">
        <br>
        <label for="zaner">Žáner hry:</label>
        <input type="text" name="zaner">
        <br>
        <label for="dev">Názov vývojára:</label>
        <input type="text" name="dev">
        <br>
        

    </form>
    <?php 
    $server_conn = new mysqli("localhost", "root", "root");
    $createDB = "CREATE DATABASE IF NOT EXISTS herna_databaza;";
    $query = mysqli_query($server_conn, $createDB);

    $conn = mysqli_connect("localhost", "root", "root", "herna_databaza");

    if (!$conn){
        echo "Nepodarilo sa pripojiť k databáze.";
    } else{
        echo "Pripojene k databaze.";
    }

    $hra = "CREATE TABLE IF NOT EXISTS hra(
    hra_id int primary key auto_increment,
    nazov varchar(30) unique not null, 
    zaner varchar(30) not null,
    dev_nazov varchar(30) unique not null,
    
    foreign key (dev_nazov) references dev(dev_nazov);"

    $dev = "CREATE TABLE IF NOT EXISTS dev(
    dev_id int primary key auto_increment,
    dev_nazov varchar(30) unique not null,
    krajina varchar(30) not null,
    typ varchar(15) not null);"
    ?>
</body>
</html>