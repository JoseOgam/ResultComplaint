<?php
/**
 * Created by PhpStorm.
 * @author : jose
 * Date: 03/22/19
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
<body id="login" class="btn-sm">
<h2 class="">RESULT COMPLAINT MANAGEMENT SYSTEM</h2>
<div class="form-control-static container-fluid">

    <div class="wrapper">

    <form action="index.html">
        <table id="title">
            <tr>
                <td>Reg No:</td>
                <td><input type="text" name="regno" /></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Sign Up" /></td>
            </tr>
        </table>
    </form>

        <?php
        if (isset($_POST['submit']))
        {
            require_once('../config/database.php');      ;

            $regno=$_POST['regno'];
            $email=$_POST['email'];
            $password=$_POST['password'];

            mysql_query("INSERT INTO users(regno,email,password) 
         VALUES ('$regno','email','$password')");
        }

        function sanitize($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        ?>
    </div>
    </div>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</body>
</html>


