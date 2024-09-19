<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome page</title>
  </head>
  <body>
    <h1 style="text-align: center;">Bem vindo!
        <?php echo $_SESSION['username'];?> :)
    </h1>
    <div class="mt-5" style="text-align: center;">
    <img id="gif" src="caracol.gif" alt="Caracol dando oi">
    </div>
  </body>
</html>