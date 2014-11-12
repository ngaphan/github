<?php
    require 'inc/config.inc.php';

    $bConnectError = false;
    if (array_key_exists('submit', $_POST)) {
        if (connectUser($_POST['login'], $_POST['pwd'])) {
            header('location:index.php');
            exit;
        } else {
            $bConnectError = true;
        }
    } else {
        // disconnect if already connected
        if (array_key_exists('login', $_SESSION)) {
            unset($_SESSION['login']);
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Forum</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">

    <h1>Connexion</h1>

    <div class="login">
        <?php if ($bConnectError): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Attention!</strong> Impossible de se connecter !
            </div>
        <?php endif; ?>
        <form class="form-horizontal" role="form" method="post" action="">
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">login</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" name="login" placeholder="login">
                </div>
            </div>
            <div class="form-group">
                <label for="pwd" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>