<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fav-icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="./images/telescope-illustration-vector.jpg">
    <link rel="shortcut icon" href="images/telescope-illustration-vector.jpg" type="image/x-icon">
    <!-- remix-icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Swiper.js styles -->
    <link rel="stylesheet" href="swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- custom-styles -->
    <link rel="stylesheet" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>IT.Experts.Blog</title>
</head>
<body>
<!-- header design -->
<header class="header" id="header">
    <!-- main nav -->
    <nav class="navbar container">
        <a href="index.php">
            <h2 class="logo">IT.Experts.Blog</h2>
        </a>
        <div class="menu" id="menu">
            <ul class="list">
                <li class="list-item">
                    <a href="index.php" class="list-link current">Home</a>
                </li>
                <li class="list-item">
                    <a href="/articles_crud/addArticle.php" class="list-link">Add An Article</a>
                </li>
                <li class="list-item">
                    <a href="Blog.php" class="list-link">Blogs</a>
                </li>
                <li class="list-item">
                </li>
                <?php  if(isset($_SESSION["user"])) {?>
                    <li class="list-item">
                        <a href="/authentication/logout.php" class="list-link screen-lg-hidden">Log out</a>
                    </li>
                <?php }  else { ?>
                    <li class="list-item">
                        <a href="/authentication/signUp.php" class="list-link screen-lg-hidden">Sign Up</a>
                    </li>
                    <li class="list-item">
                        <a href="/authentication/login.php" class="list-link screen-lg-hidden">Log In</a>
                    </li>
                <?php  } ?>
            </ul>
        </div>
        <!-- right nav -->
        <div class="list list-right">
            <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
                <i class="ri-menu-3-line open-menu-icon"></i>
                <i class="ri-close-line close-menu-icon"></i>
            </button>
            <a href="#" class="list-link screen-sm-hidden"> Sign in</a>
            <a href="#" class="list-link screen-sm-hidden btn sign-up-btn fancy-border">
                <span> Sign up </span>
            </a>
        </div>
    </nav>
</header>



<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once 'database_access/ArticlesRepository.php';
$rep = new ArticlesRepository();
$articleNameWanted = isset($_GET['search']) ? $_GET['search'] : '';
$currentDate = date('F j, Y');
if ($articleNameWanted) {
    $articles = $rep->searchByName($articleNameWanted);
    if (!$articles) { ?>
        <div style='margin-top: 20px; text-align: center; font-weight: 700; font-size: 30px;'>No Articles to display <i class="fa-solid fa-heart-crack" style="color: #514d47; font-size: 23px;"></i> ..</div>
    <?php } else { ?>
            <?php foreach ($articles as $article) { ?>
            <section class="featured-articles section-header-offset">
                <div class="featured-articles-container container d-grid">
                    <a href="/post.php?id=<?= $article->id; ?>" class="article featured-article featured-article-1">
                        <img class="article-image" src="data:image/jpeg;base64,<?= base64_encode($article->image); ?>" alt="article image">
                        <span class="article-category"><?= $article->category ?></span>
                        <div class="article-data-container">
                            <div class="article-data">

                                <span> <?=$currentDate?></span>
                                <span class="article-data-spacer"></span>
                                <span><strong>Author</strong> : <?= $article->author; ?></span>
                                <span class="Article-visitors" style="color : #444;"><strong>Visits Overall</strong> :
                            <?= $article->visits ?>
                        </span>
                            </div>

                            <h3 class="title article-title"><?= strtoupper($article->title); ?> </h3>
                        </div>
                    </a>
                </div>
            </section>
            <?php } ?>
    <?php } ?>
<?php } ?>
<?php
include 'fragments/footer.php';
?>

<br>
<br>
<br>
<br>

<?php
if (isset($_SESSION["name"])) {
    if ($_SESSION["name"] == $article->author) { ?>
        <button type="button" class="btn btn-danger" style="margin: 20px">
            <form method="post" action="/articles_crud/deleteArticle.php">
                <input type="hidden" name="article_id" value="<?= $article->id; ?>">
                <input class="btn place-items-center screen-lg-hidden menu-toggle-icon" type="submit" name="delete" value="DELETE">
            </form>
        </button>


        <button type="button" class="btn btn-warning">
            <form method="post" action="/articles_crud/updateArticle.php">
                <input type="hidden" name="article_id" value="<?= $article->id; ?>">
                <input class="btn place-items-center screen-lg-hidden menu-toggle-icon" type="submit" name="update" value="UPDATE">
            </form>
        </button>
        <?php
    }
}
?>
<!--Footer-->

<footer class="footer section" >
    <div class="footer-container container d-grid">
        <div class="company-data">
            <a href="index.php">
                <h2 class="logo">IT.Experts.Blog</h2>
            </a>
            <p class="company-description">
                Talk about what you're passionate about,
                in your own way
            </p>
            <ul class="list social-media">
                <li class="list-item">
                    <a href="" class="list-link">
                        <i class="ri-instagram-line"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a href="" class="list-link">
                        <i class="ri-linkedin-line"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a href="" class="list-link">
                        <i class="ri-twitter-line"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a href="" class="list-link">
                        <i class="ri-facebook-circle-line"></i>
                    </a>
                </li>
            </ul>

            <span class="copyright-notice">
                    &copy; 2023 IT.Experts.Blog, All rights reserved
                </span>
        </div>

    </div>
</footer>

<!-- Swiper.js -->
<script src="./js/swiper-bundle.min.js"></script>
<!-- Custom script -->
<script src="./js/main.js"></script>
</body>
</html>
