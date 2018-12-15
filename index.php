<?php
/**
 * Created by PhpStorm.
 * @author : IsaacNgeno
 * Date: 12/15/18
 */

session_start();

if (!isset($_SESSION['user'])){
    header('Location: pages/logout.php');
    exit;
}else{
    $user = $_SESSION['user'];
    echo "Welcome ".$user;
}
