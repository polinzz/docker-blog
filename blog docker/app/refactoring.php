<?php

function getPDO()
{
    $user = 'root';
    $pass = 'password';
    $dbname = 'db';

    $pdo = new PDO("mysql:host=$dbname:3306;dbname=data", "$user", "$pass");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}


function selectOne($blogid)
{
    $pdo = getPDO();
    $query = $pdo->prepare('SELECT * FROM article WHERE blogid = :blogid');
    $query->execute(['blogid' => $blogid]);

    $post = $query->fetch();
    return $post;
}
