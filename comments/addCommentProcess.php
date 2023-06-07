<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
include_once ("database_access/CommentRepository.php");
$rep=new CommentRepository("comment");
$rep->Create($_POST);
$previousPage = $_SERVER['HTTP_REFERER'];
header("Location: $previousPage");
?>
