<?php
/**
 * Created by PhpStorm.
 * @author : jose
 * Date: 12/15/18
 */
require_once('config/database.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: pages/logout.php');
    exit;
} else {
    $user = $_SESSION['user'];
    $db = new Database();
    $pdo = $db->getConnection();
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Title</title>

        <link rel="stylesheet" type="text/css" href="fonts/roboto/roboto.css">
        <link rel="stylesheet" type="text/css" href="fonts/material/material-icons.css">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body id="index">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="collapsed navbar-toggle" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Result Complaint</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <p class="navbar-text navbar-right">
                    Signed in as <a href="#" class="navbar-link"><?= $user ?></a>
                </p>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php"><i class="material-icons">home</i></a></li>
                    <li><a href="#createIssue">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#createIssue">Create Issue
                            </button>
                        </a></li>
                    <li><a href="pages/logout.php"><i class="material-icons">exit_to_app</i></a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">

        <!-- CONTENT HERE -->
        <div class="row text-center">
            <div class="col-lg-4 grey"><h3>In Que</h3></div>
            <div class="col-lg-4 amber"><h3>Running</h3></div>
            <div class="col-lg-4 green"><h3>Complete</h3></div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?php
                $stm = $pdo->prepare("SELECT * FROM `issues` WHERE `status`=? AND `regno`=?");
                $stm->execute(array("in_que", $_SESSION['user']));
                if ($stm->rowCount() > 0) {
                    $issues = $stm->fetchAll();

                    foreach ($issues as $issue) {
                        echo "<div class='card item-card'>
                                <h5>{$issue['title']}</h5>
                                <p>{$issue['description']}</p>
                              </div>";
                    }
                }else{
                    echo "<div class='alert alert-info'><strong>Info!</strong>No Issues yet</div>";
                }
                ?>
            </div>
            <div class="col-lg-4">
                <?php
                $stm = $pdo->prepare("SELECT * FROM `issues` WHERE `status`=? AND  `regno`=?");
                $stm->execute(array("running", $user));
                if ($stm->rowCount() > 0) {
                    $issues = $stm->fetchAll();

                    foreach ($issues as $issue) {
                        echo "<div class='card item-card'>
                                <h5>{$issue['title']}</h5>
                                <p>{$issue['description']}</p>
                              </div>";
                    }
                }else{
                    echo "<div class='alert alert-info'><strong>Info!</strong>No Issues yet</div>";
                }
                ?>
            </div>
            <div class="col-lg-4">
                <?php
                $stm = $pdo->prepare("SELECT * FROM `issues` WHERE `status`=? AND `regno`=?");
                $stm->execute(array("complete", $user) );
                if ($stm->rowCount() > 0) {
                    $issues = $stm->fetchAll();

                    foreach ($issues as $issue) {
                        echo "<div class='card item-card'>
                                <h5>{$issue['title']}</h5>
                                <p>{$issue['description']}</p>
                              </div>";
                    }
                }else{
                    echo "<div class='alert alert-info'><strong>Info!</strong>No Issues yet</div>";
                }
                ?>
            </div>
        </div>

        <!-- Modal -->
        <div id="createIssue" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create Issue</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-horizontal">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                                      placeholder="Description"></textarea>
                            <button type="submit" name="create" class="btn btn-success form-control">Create Issue
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    </body>
    </html>
<?php
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $username = $_SESSION['user'];
    $description = $_POST['description'];

    if (!empty($title) && !empty($username) && !empty($description)) {
        $statement = $pdo->prepare("INSERT INTO `issues`( `title`, `description`, `regno`, `status`) VALUES (?, ?, ?, ?)");
        if ($statement->execute(array($title, $description, $username, "in_que"))) {
            // header("Location: index.php");
        }
    }
}

