<?php
/**
 * Created by PhpStorm.
 * @author: IsaacNgeno
 * Date: 12/17/18
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
        <h2>Trello</h2>
        <form action="admin.php" method="post" role="form">
            <?php
            if (isset($_POST['login'])) {
                $username = sanitize($_POST['username']);
                $password = $_POST['password'];

                if (empty($username)) {
                    echo '<div class="alert alert-warning" ><strong>Warning!</strong> Please enter a Username</div>';
                } elseif (empty($password)) {
                    echo '<div class="alert alert-warning" ><strong>Warning!</strong> Please enter a password</div>';
                } else {
                    if (!empty($username) && !empty($password)) {
                        $db = new Database();
                        $pdo = $db->getConnection();

                        $statement = $pdo->prepare("SELECT * FROM `admins` WHERE `username`=?");
                        $statement->execute(array($username));
                        $user = $statement->fetch();
                        if ($password == $user['password']) {
                            session_start();
                            $_SESSION['user'] = $user['username'];
                            header("Location: index.php");
                            exit;
                        } else {
                            echo '<div class="alert alert-warning" ><strong>Warning!</strong> Incorrect login credentials</div>';
                        }

                    }
                }
            }

            function sanitize($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            ?>
            <input type="text" class="form-control" name="username" placeholder="Username">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <button type="submit" name="login" class="form-control btn btn-link">Sign In</button>
        </form>
    </div>
</div>

<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</body>
</html>


