<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

include_once ("database_access/ArticlesRepository.php");
$id = $_POST['article_id'];

include_once ("database_access/CommentRepository.php");
$rep2=new CommentRepository("comment");
$comments = $rep2->findByArticleId($id);


$rep1= new ArticlesRepository();

if ($comments){
    $rep2->DeleteByArticleID($id);
}

$article = $rep1->DeleteById($id);
header("Location: /Blog.php");
exit();
?>