<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
require_once 'database_access/ArticlesRepository.php';
include 'authentication/requireAuthenticated.php';
$rep = new ArticlesRepository();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- remix-icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Swiper.js styles -->
    <link rel="stylesheet" href="swiper-bundle.min.css"/>
    <!-- custom-styles -->
    <link rel="stylesheet" href="style.css">
    <title>Blogs</title>
</head>

<body>
<!-- header design -->
<header class="header" id="header">
    <!-- main nav -->
    <nav class="navbar container">
        <a href="/index.php">
            <h2 class="logo">IT.Experts.Blog</h2>
        </a>
        <div class="menu" id="menu">
            <ul class="list">
                <li class="list-item">
                    <a href="/index.php" class="list-link current">Home</a>
                </li>
                <li class="list-item">
                    <a href="/articles_crud/addArticle.php" class="list-link">Add An Article</a>
                </li>
                <li class="list-item">
                    <a href="/Blog.php" class="list-link">Blogs</a>
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
            <button class="btn place-items-center" id="theme-toggle-btn">
                <i class="ri-sun-line sun-icon"></i>
                <i class="ri-moon-line moon-icon"></i>
            </button>
            <button class="btn place-items-center" id="search-icon">
                <i class="ri-search-line"></i>
            </button>
            <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
                <i class="ri-menu-3-line open-menu-icon"></i>
                <i class="ri-close-line close-menu-icon"></i>
            </button>

        </div>
    </nav>
</header>
<!-- search -->
<div class="search-form-container container" id="search-form-container">
    <div class="form-container-inner">
        <form action="searchArticle.php" method="get" class="form">
            <input type="text" class="form-input" name="search" placeholder="what are you looking for?">
            <button class="btn form-btn" type="submit">
                <i class="ri-search-line"></i>
            </button>
        </form>
        <span class="form-note">or press ESC to close.</span>
    </div>
    <button class="btn form-close-btn place-items-center" id="form-close-btn">
        <i class="ri-close-line"></i>
    </button>
</div>
<!--    Featured articles-->
<?php
$articles = $rep->findAll();
$currentDate = date('F j, Y');

foreach ($articles as $article) {
?>
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



<!--Footer-->

<footer class="footer section">
    <div class="footer-container container d-grid">
        <div class="company-data">
            <a href="/index.php">
                <h2 class="logo">IT.Experts.Blog    </h2>
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
<script src="/js/swiper-bundle.min.js"></script>
<!-- Custom script -->
<script src="/js/main.js"></script>
</body>
</html>