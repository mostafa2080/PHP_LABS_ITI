<?php

    $dsn = 'mysql:host=localhost;dbname=php4';
    $username = 'root';
    $password = 'root';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    try {
        $db = new PDO($dsn, $username, $password, $options);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo $error_message;
        exit();
    }
?>

