<?php
/**
 * Created by PhpStorm.
 * @author : IsaacNgeno
 * Date: 12/18/18
 */

require_once('../config/database.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: logout.php');
    exit;
} else {
    $db = new Database();
    $pdo = $db->getConnection();
}

if (isset($_GET['cardId'])){
    $id = $_GET['cardId'];
    $statement = $pdo->prepare("SELECT * FROM `issues` WHERE `id`=?");
    $statement->execute(array($id));
    $result = $statement->fetch();
    if ($result['status'] == 'complete'){
        $status = "in_que";
    }elseif ($result['status'] != 'complete'){
        $status = "complete";
    }
    $statement = $pdo->prepare("UPDATE `issues` SET `status`=? WHERE `id`=?");
    if ($statement->execute(array($status, $id))){
        header("Location: index.php");
        exit;
    }

}

if (isset($_GET['issueId'])){
    $issueId = $_GET['issueId'];
    $stm = $pdo->prepare("");
    $stm->execute();
    $result = $stm->fetch();
}

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
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="collapsed navbar-toggle" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">School</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <p class="navbar-text navbar-right">
                Signed in as <a href="#" class="navbar-link">User</a>
            </p>
            <a href="#" class="btn btn-success navbar-btn navbar-right">Sign out</a>
        </div>
    </div>
</nav>

<div class="container">

    <!-- CONTENT HERE -->


</div>

<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</body>
</html>

