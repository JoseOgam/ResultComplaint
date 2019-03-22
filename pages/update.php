<?php
/**
 * Created by PhpStorm.
 * @author : jose
 * Date: 01/1/19
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

if (isset($_GET['cardId'])) {
    $id = $_GET['cardId'];
    $statement = $pdo->prepare("SELECT * FROM `issues` WHERE `id`=?");
    $statement->execute(array($id));
    $result = $statement->fetch();
    if ($result['status'] == 'complete') {
        $status = "in_que";
    } elseif ($result['status'] != 'complete') {
        $status = "complete";
    }
    $statement = $pdo->prepare("UPDATE `issues` SET `status`=? WHERE `id`=?");
    if ($statement->execute(array($status, $id))) {
        header("Location: index.php");
        exit;
    }

}

if (isset($_GET['issueId'])) {
    $issueId = $_GET['issueId'];
    $stm = $pdo->prepare("SELECT * FROM `issues` WHERE `id`=?");
    $stm->execute(array($issueId));
    $issue = $stm->fetch();
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
    <div class="row">
        <div class="col-lg-4"><h4>Title</h4></div>
        <div class="col-lg-8"><?php echo "<div >{$issue['title']}</div>" ?></div>
    </div>
    <div class="row">
        <div class="col-lg-4"><h4>Description</h4></div>
        <div class="col-lg-8"><?php echo "<div >{$issue['description']}</div>" ?></div>
    </div>
    <div class="row">
        <div class="col-lg-4"><h4>Date Created</h4></div>
        <div class="col-lg-8"><?php echo "<div >{$issue['date_raised']}</div>" ?></div>
    </div>
    <div class="row">
        <div class="col-lg-4"><h4>Raised by</h4></div>
        <div class="col-lg-8"><?php echo "<div >{$issue['regno']}</div>" ?></div>
    </div>
    <h4>Assign Issue</h4>

    <form action="update.php" method="post" class="form-horizontal">
        <?php
        if (isset($_POST['assign'])){
            $assignee = $_POST['assignee'];
            $id = $issueId;
            $admId = $_SESSION['user'];
            $progress = "running";
            $remarks = $_POST['remarks'];
            if (!empty($assignee)){
                $stm = $pdo->prepare("INSERT INTO `issue_progress`(`issue_id`, `admin_id`, `progress`, `remarks`) VALUES (?, ?, ?, ?, ?)");
                if ($stm->execute(array($id, $admId, $progress, $remarks))){

                    $state = $pdo->prepare("UPDATE `issues` SET `status`=? WHERE `id`=?");
                    $state->execute(array($progress, $id));
                    echo "<div class='alert alert-success'>Issue has been successfully assigned to {$assignee}</div>";
                }

            }
        }
        ?>
        <select class="form-control" name="assignee" id="assign" >
            <?php
            $statement = $pdo->prepare("SELECT * FROM `admins`");
            $statement->execute();
            if ($statement->rowCount() > 0){
                $admins = $statement->fetchAll();

                foreach ($admins as $admin){
                    echo "<option value='{$admin['username']}' class='form-control'>{$admin['username']}</option>";
                }
            }else{
                echo "<div class='alert alert-info'>No admins yet</div>";
            }
            ?>
        </select>
        <textarea name="remarks" id="remarks" cols="15" rows="5" class="form-control"></textarea>
        <button type="submit" name="assign" class="btn btn-default">Assign</button>
    </form>

    <h4>Issue Progress Report</h4>
</div>

<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
</body>
</html>

