<?php
    require_once 'DataBase.php';
    global $db;

    $id = $_GET['id'];


    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = $db->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $image = $row['image'];
    unlink("images/$image");


    $query = "DELETE FROM users WHERE id = '$id'";
    $db->exec($query);

    header("Location: index.php");
    exit();
?>

