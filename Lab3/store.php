<?php
session_start();


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



$last_line = exec('tail -n 1 users.txt');
$last_line_array = explode(',', $last_line);
// if the file is empty, set the id to 1
if (empty($last_line)) {
    $id = 0;
}else{
    $id = $last_line_array[0];
}


$handle = fopen('users.txt', 'r');

// loop through the file
while (($line = fgets($handle)) !== false) {
    // convert the line into an array
    $line_array = explode(',', $line);
    // check if the email matches the email in the file
    if ($email == $line_array[2]) {
        $errors[] = "Email is already taken";
        break;
    }
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

// save the data to the file
// open the file
$handle = fopen('users.txt', 'a');
// write the data to the file
fwrite($handle, ((int)$id + 1).','.$name.','.$email.','.$password.','.$room.','.$ext.','.$image."\n");

// upload the image with the unique name
move_uploaded_file($_FILES['image']['tmp_name'], $target.$image);


// redirect to the home page

header("Location: login.php");
exit();
?>