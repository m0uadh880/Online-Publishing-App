<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
$pageTitle = 'Update-Article';
include 'fragments/header.php';

$id = $_POST['article_id'];
require_once ('database_access/ArticlesRepository.php');
$rep= new ArticlesRepository();
$article = $rep->findById($id);
$image = $article->image;
$DataUri='data:image/jpeg;base64,' . base64_encode($image)
?>

<form action="updateArticleProcess.php" method="post" enctype="multipart/form-data" class="article-form">
    <h2>Write An Article</h2>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" maxlength="64" value="<?= $article->title ?>" required />

    <label for="subTitle">Sub-Title</label>
    <input id="subTitle" name="subTitle" rows="10" value="<?= $article->subTitle ?>"></input>

    <label for="author">Author</label>
    <input type="text" name="author" id="author" readonly required value="<?= $_SESSION["name"] ?>"/>

    <label for="category">Category</label>
    <select id="category" name="category" required>
        <option selected><?=$article->category?></option>
        <option selected disabled>Open this select menu</option>
        <option value="cyber security">cyber security</option>
        <option value="Artificial Intelligence">Artificial Intelligence</option>
        <option value="Web Development">Web Development</option>
        <option value="DevOps">DevOps</option>
        <option value="DevOps">Blockchain</option>
        <option value="DevOps">Cloud computing</option>
        <option value="DevOps">Internet of Things (IoT)</option>
        <option value="DevOps">Networks</option>
        <option value="DevOps">Big Data and Data Analytics</option>
    </select>

    <label for="image">Image</label>
    <img src="<?= $DataUri ?>" height="100" width="100"  style="margin:20px;" alt="article image">
    <input id="image-upload" type="file" name="my_image" accept="image/*">

    <label for="article_content">Article Content</label>
    <textarea id="article_content" name="article_content" rows="10" ><?= $article->article_content ?></textarea>

    <input hidden="hidden" name="id" type="number" class="form-control" value="<?=$article->id?>" >

    <button type="submit" name="submit">UPDATE</button>

</form>
