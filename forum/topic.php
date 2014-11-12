<?php
    require 'inc/func.inc.php';
    if (array_key_exists('submit', $_POST)) {
        createReply($_POST['message'], $_GET['id'], $_POST['user']);
    }
    $aTopic = getTopicFromId($_GET['id']);
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

    <?php include('inc/menu.php'); ?>

    <h1><?= $aTopic['subject']; ?></h1>

    <h2>sujet créé par <?= $aTopic['user']; ?>
        <small>le <?= formatDate($aTopic['date']); ?></small>
    </h2>

    <table class="table table-striped table-hover">
        <?php foreach (getRepliesFromTopic($aTopic['id']) as $aReply): ?>
            <tr>
                <td><?= formatDateTime($aReply['date']); ?></td>
                <td><?= $aReply['content']; ?></td>
                <td><?= $aReply['user']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="reply">
        <h2>Répondre :</h2>

        <form class="form-horizontal" role="form" method="post" action="">
            <div class="form-group">
                <label for="user" class="col-sm-2 control-label">Utilisateur</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user" name="user" placeholder="Utilisateur"/>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Message</label>

                <div class="col-sm-10">
                    <textarea class="form-control" id="message" name="message"></textarea>
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