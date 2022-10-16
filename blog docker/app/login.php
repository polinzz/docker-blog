<?php
session_start();
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require 'database.php'; //require connection script

$_SESSION['userid'] = '';

//if(isset($_POST['submit']))
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    try {
        $user = 'root';
        $pass = 'password';
        $dbname = 'db';

        $pdo = new PDO("mysql:host=$dbname:3306;dbname=data", "$user", "$pass");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

        $query = "SELECT userid, email, password FROM user WHERE email = :email";
        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            echo '<script>alert("Le compte n\'existe pas")</script>';
        } else {


            $userEmail = $_POST['email'];
            $userPwd = $_POST['password'];

            if (!$user) {
                echo "l'utilisateur n'existe pas";
                die;
            }

            if ($user['password'] !== $userPwd) {
                echo "le mot de passe est incorrect";
                die;
            }

            $_SESSION['userid'] = $email;
            echo '<script>window.location.replace("index.php");</script>';
            exit;
        }
    }catch(PDOException $e){
        $error = "Error: ".$e->getMessage();
        echo '<script>alert("'.$error.'")</script>';
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<div id="container">
    <form action="login.php" method="POST">
        <h1>Connexion</h1>

        <label><b>Mail</b></label>
        <input type="email" placeholder="Entrer l'email de l'utilisateur" name="email" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <input type="submit" id='submit' value='Se connecter'>
    </form>
</div>
</body>
</html>