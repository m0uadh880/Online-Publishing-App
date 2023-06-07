<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
$comment_id = htmlentities($_GET['comment_id']);

echo $comment_id;

include_once ("database_access/CommentRepository.php");
$rep=new CommentRepository("comment");

$rep->DeleteById($comment_id);

