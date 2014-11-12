<?php
    require 'inc/config.inc.php';
    if (array_key_exists('submit', $_POST)) {
        createTopic($_POST['subject'], $_GET['id'], $_SESSION['login']);
    }
    $aCategory = getCategoryFromId($_GET['id']);
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

    <h1><?= $aCategory['name']; ?>
        <small>derniers sujets</small>
    </h1>


    <table class="table table-striped table-hover">
        <?php foreach (getTopicsFromCategory($aCategory['id']) as $aTopic): ?>
            <tr>
                <td><span class="badge"><?= $aTopic['total']; ?></span></td>
                <td><?= formatDate($aTopic['date']); ?></td>
                <td><a href="topic.php?id=<?= $aTopic['id']; ?>"><?= $aTopic['subject']; ?></a></td>
                <td><?= $aTopic['user']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (false !== getLogin()) : ?>
    <div class="topic">
        <h2>Créer un nouveau topic :</h2>

        <form class="form-horizontal" role="form" method="post" action="">
            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">Sujet</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </form>
    </div>
    <?php else : ?>
        <p><a href="login.php">Identifiez-vous pour répondre</a>.</p>
    <?php endif; ?>
</div>
</body>
</html>