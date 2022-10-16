<?php
$blogid ="";
if (isset($_GET['blogid'])) {
    $blogid = $_GET['blogid'];

}
$post = selectOne($blogid);

?>