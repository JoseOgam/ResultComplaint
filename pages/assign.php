<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 4/16/19
 * Time: 6:57 AM
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

if (isset($_POST['assign'])){
    $assignee = $_POST['assignee'];
    $id = $_POST['id'];
    $admId = $_SESSION['user'];
    $progress = "running";
    $remarks = $_POST['remarks'];
    if (!empty($assignee)){
        $stm = $pdo->prepare("INSERT INTO `issue_progress`(`issue_id`, `admin_id`, `progress`, `remarks`) VALUES ( ?, ?, ?, ?)");
        if ($stm->execute(array($id, $admId, $progress, $remarks))){

            $state = $pdo->prepare("UPDATE `issues` SET `status`=? WHERE `id`=?");
            $state->execute(array($progress, $id));
            //echo "<div class='alert alert-success'>Issue has been successfully assigned to {$assignee}</div>";
            header("Location:index.php");
        }else{
            echo "<div class='alert alert-info'>Error issue couldn't be assigned to {$assignee}</div>";
        }

    }
}