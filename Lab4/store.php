<?php
    session_start();
    require_once 'DataBase.php';
    global $db;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $room = $_POST['room'];
    $ext = $_POST['ext'];
    $image = $_FILES['image']['name'];
    $target = "images/";

    // validate the form
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if (empty($confirm_password)) {
        $errors[] = "Confirm Password is required";
    }
    if (empty($room)) {
        $errors[] = "Room is required";
    }
    if (empty($ext)) {
        $errors[] = "Ext is required";
    }
    if (empty($image)) {
        $errors[] = "Image is required";
    }
    if ($password != $confirm_password) {
        $errors[] = "Password and Confirm Password must be the same";
    }

    // check if email is already taken
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $errors[] = "Email is already taken";
    }

    // if there are errors, redirect back to the create page
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: create.php");
        exit();
    }

    // if there are no errors, insert the new user into the database
    unset($_SESSION['errors']);
     // give image a unique name
    $image = time().'_'.$image;


    $query = "INSERT INTO users (name, email, password, room, ext, image) VALUES ('$name', '$email', '$password', '$room', '$ext', '$image')";
    $db->exec($query);

    // upload the image with the unique name
    move_uploaded_file($_FILES['image']['tmp_name'], $target.$image);


    // redirect to the home page

    header("Location: index.php");
    exit();
?>


