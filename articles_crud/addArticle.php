<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
$pageTitle = 'Write a blog';
include 'fragments/header.php';
include 'authentication/requireAuthenticated.php';
?>




<form action="addArticleProcess.php" method="post" enctype="multipart/form-data" class="article-form">
    <h2>Write An Article</h2>

    <label for="title">Title</label>
    <input type="text" name="title" id="title" maxlength="64" required />

    <label for="subTitle">Sub-Title</label>
    <input id="subTitle" name="subTitle" rows="10"></input>

    <label for="author">Author</label>
    <input type="text" name="author" id="author" readonly required value="<?= $_SESSION["name"] ?>"/>

    <label for="category">Category</label>
    <select id="category" name="category" required>
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
        <option value="DevOps">Mobile App Development</option>
    </select>

    <label for="image">Image</label>
    <input id="image" type="file" name="my_image" accept="image/*" required>

    <label for="article_content">Article Content</label>
    <textarea id="article_content" name="article_content" rows="10"></textarea>

    <button type="submit">SUBMIT</button>

</form>

<script>
    function applyFormatting() {
        var textarea = document.getElementById("article_content");
        var text = textarea.value;
        text = text.replace(/\n/g, "<br>");
        textarea.value = text;
    }
</script>
<?php
include 'fragments/footer.php';
?>
