<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
require_once('UploadedFile.php');

$id = htmlentities($_POST['id']);
$title = htmlentities($_POST['title']);
$subTitle = htmlentities($_POST['subTitle']);
$author = htmlentities($_POST['author']);
$category = htmlentities($_POST['category']);
$article_content = htmlentities($_POST['article_content']);

$params = array(
    'title' => $title,
    'subTitle' => $subTitle,
    'author' => $author,
    'category' => $category,
    'article_content' => $article_content,
);

$tmp_upload_path = $_FILES['my_image']['tmp_name'];

//Updating a recipe doesn't require changing the picture
if(file_exists($tmp_upload_path)
    && is_uploaded_file($tmp_upload_path)) {
    $upload = new UploadedFile($tmp_upload_path);

    if($upload->isImage()){
        $upload->compressImageIfPossible();
        $params['image'] = file_get_contents($upload->path);
    }
    else{
        $_SESSION["erreur"] = "You uploaded an invalid image. Other modifications will still take effect.";
    }
}

require_once ('database_access/ArticlesRepository.php');
$rep= new ArticlesRepository();
$article = $rep->UpdateById($id,$params);

header("Location: /Blog.php");
