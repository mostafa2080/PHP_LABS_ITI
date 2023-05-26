<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div style="margin-top: 100px" class="container">
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Welcome <?php echo $_SESSION['user'][1] ?></h1>
        <img src="/images/<?php echo $_SESSION['user'][6] ?>" style="width: 80px; height: 80px" alt="">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    <?php else: ?>
        <h1>You are not logged in</h1>
        <a href="login.php" class="btn btn-primary">Login</a>
        <a href="create.php" class="btn btn-secondary">Register</a>
    <?php endif; ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>    <title>Home Page</title>


</body>
</html>