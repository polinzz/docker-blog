<?php
    require_once 'refactoring.php';
    include 'traitement.php';
    $pdo = require __DIR__ . "/database.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Article</title>
</head>

<body>
<?php //include('/header.php') ?>

<div class="page-container">
    <div class="container">
        <div class="">
            <div class="main-content single">
                <h1 class="post-title"><?php echo $post['title']; ?></h1>
                <div class="post-content">
                    <?php echo html_entity_decode($post['description']); ?>
                </div>
            </div>
            <h1>Les commentaires</h1>
            <div class="comments">
                <?php foreach ($comments as $comment): ?>

                    <div class="comment">
                        <h3 class="auteur">Ecrit par <?php echo $comment['userid']; ?> : </h3>
                        <p class="contenu" ><?php echo $comment['comment']; ?><br>
                            <i class="far fa-calendar"> <?php echo date('d F, Y', strtotime($comment['date'])); ?></i>
                            <a class="sup" href="single.php?id=<?php echo $blogid ?>&amp;id_comment_delete=<?php echo $comment['id']; ?>">Supprimer</a>
                        </p>
                        <br>
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <form action="single.php"  method="post">
                <input type="hidden" name="id" value="<?php echo $blogid ?>">
                <div>
                    <label>Votre Prenom:</label>
                    <input type="text" name="author" class="text-input">
                </div>
                <div>
                    <label>Body:</label>
                    <textarea name="comment" id="body" cols="130" rows="15"></textarea>
                </div><br>
                <div>
                    <button type="submit" name="add-comment" class="btn btn-big">Commentez</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php //include('inc/footer.php') ?>

</body>

</html>