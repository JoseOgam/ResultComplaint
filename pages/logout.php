<?php
/**
 * Created by PhpStorm.
 * @author : IsaacNgeno
 * Date: 12/15/18
 */
session_start();

if (isset($_SESSION['user'])){
    unset($_SESSION['user']);
    session_destroy();
    header('Location: login.php');
    exit;
}else{
    header('Location: login.php');
    exit;
}