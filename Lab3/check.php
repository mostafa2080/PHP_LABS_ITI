<?php

    $email = $_POST['email'];
    $password = $_POST['password'];
    session_start();

    // validate the form
    $errors = [];
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // if there are errors, redirect back to the login page
    if (count($errors) > 0) {
        $_SESSION['login_errors'] = $errors;
        header("Location: login.php");
        exit();
    }

    // if there are no errors, check if the user exists
    unset($_SESSION['login_errors']);
    $handle = fopen('users.txt', 'r');

    // loop through the file
    while (($line = fgets($handle)) !== false) {

        $line_array = explode(',', $line);

        if ($email == $line_array[2] && $password == $line_array[3]) {
            $_SESSION['user'] = $line_array;
            header("Location: welcome.php");
            exit();
        }
    }

    // if the user does not exist, redirect back to the login page
    $errors[] = "Invalid email or password";
    $_SESSION['login_errors'] = $errors;
    header("Location: login.php");
    exit();

    ?>
