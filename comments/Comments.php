<div class="comment_container">
    <?php
    set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
    include_once ("database_access/CommentRepository.php");
    $rep = new CommentRepository("comment");
    ?>

    <?php
    if ($rep->findNumberByArticleId($article->id)) { ?>
        <h3>Comments - <?= ($rep->findNumberByArticleId($article->id)) ?></h3>
    <?php } else { ?>
        <h3>Comments - 0 </h3>
    <?php } ?>

    <?php
    include_once ("database_access/CommentRepository.php");
    $rep = new CommentRepository("comment");
    $comments = $rep->findByArticleId($article->id);
    $currentDate = date('F j, Y');
    foreach($comments as $comment){
        ?>

        <div class="comment">
            <div class="comment-header"">
                <span class="comment-author">
                    <?php
                    if (isset($_SESSION["name"])){
                        if ($_SESSION["name"] == $comment->author) { ?>
                            You
                            <?php
                        } else { ?>
                            <?php echo $comment->author ?>
                        <?php }
                    } else { ?>
                        <?php echo $comment->author ?>
                    <?php } ?>
                </span>
            <span class="comment-date"><?=$currentDate?></span>
        </div>
          <p class="comment-text"><?php echo $comment->text ?></p>
        </div>
        <?php
    }
    ?>
</div>


<?php
if(isset($_SESSION["user"]))
{
    ?>
    <div class="comment-form">
        <h2 class="form-title">Leave a Comment</h2>
        <form action="/comments/addCommentProcess.php" method="post" enctype="multipart/form-data">

            <label for="title"></label>
            <textarea rows=7 type="text" name="text" id="text" required></textarea>
            <br>
            <button class="submit-button" type="submit">Add</button>
            <input hidden="hidden" name="author" type="text"  value="<?=$_SESSION["name"]?>" >
            <input hidden="hidden" name="articleID" type="number"  value="<?=$article->id?>" >
        </form>
    </div>

    <?php
}
?>

<style>
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #353535;
        color: #fff;
        border-radius: 4px;
    }
    .submit-button {
        background-color: #555;
        color: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .submit-button:hover {
        background-color: #777;
    }
</style>

