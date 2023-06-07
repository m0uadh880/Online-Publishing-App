<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
require_once('database_access/ConnexionPDO.php');
require_once('UploadedFile.php');

$upload = new UploadedFile($_FILES["my_image"]["tmp_name"]);

if($upload->isImage()){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $subTitle = $_POST['subTitle'];
    $category = $_POST['category'];
    $article_content = $_POST['article_content'];

    $upload->compressImageIfPossible();

    $query = "INSERT INTO article (title, author, subTitle, category, image, article_content)
              VALUES (:title, :author, :subTitle, :category, :image, :article_content)";
    $statement = ConnexionPDO::getInstance()->prepare($query);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':author', $author);
    $statement->bindParam(':subTitle', $subTitle);
    $statement->bindParam(':category', $category);
    $image_blob = file_get_contents($upload->path);
    $statement->bindParam(':image', $image_blob);
    $statement->bindParam(':article_content', $article_content);
    $statement->execute();
    header("Location: /Blog.php");

}
else{
    $_SESSION["erreur"] = 'Please enter an image file.';
    header("Location: addArticle.php");
}
?>
