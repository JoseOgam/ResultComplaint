<?php
/**
 * Created by PhpStorm.
 * @author : IsaacNgeno
 * Date: 12/15/18
 */

require_once('../config/database.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../fonts/roboto/roboto.css">
    <link rel="stylesheet" type="text/css" href="../fonts/material/material-icons.css">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>

    </style>
</head>
<body id="login">
<div class="container-fluid">

    <!-- CONTENT HERE -->
    <div class="wrapper">
        <h2 >Trello</h2>
        <form action="login.php" method="post" role="form">
            <input type="text" class="form-control" name="username" placeholder="Username">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <input type="password" class="form-control" name="pass" placeholder="Confirm Password">
            <button type="submit" class="form-control btn btn-link">Sign In</button>
        </form>
    </div>
</div>

<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</body>
</html>


