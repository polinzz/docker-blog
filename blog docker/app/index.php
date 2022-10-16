<?php
session_start();
?>

<?php
require_once 'refactoring.php';



?>
<!DOCTYPE html>
<html>
<head>
    <title>blog php</title>
    <meta charset="UTF-8">
</head>
<body>

<?php
$user = 'root';
$pass = 'password';
$dbname = 'db';

$pdo = new PDO("mysql:host=$dbname:3306;dbname=data", "$user", "$pass");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$results = $pdo->query('SELECT * FROM article ORDER BY date DESC');
$posts = $results->fetchAll();


if (isset($_SESSION["userid"])):
?>


    <h1>Blog php</h1>

    <header>
        <p><a href="logout.php">Déconnexion</a></p>
    </header>

    <main>
        <div class="posts">
            <div class="posts-container">
                <?php foreach ($posts as $post): ?>
                    <div class="posts-container-post">
                        <div class="posts-container-post-info">
                            <h4><a href="single.php?id=<?php echo $post['blogid']; ?>"><?php echo $post['titre']; ?></a></h4>
                            <p><?php echo $post['description']; ?></p>
                            <i > <?php echo $post['userid']; ?></i>

                            <i > <?php echo date('d F, Y', strtotime($post['date'])); ?></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

<?php else: ?>

    <p><a href="login.php">Connectez-vous</a> ou <a href="signup.html">créez un compte</a></p>

<?php endif; ?>

</body>
</html>
