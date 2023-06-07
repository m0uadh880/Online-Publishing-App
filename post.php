<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
$id = htmlentities($_GET['id']);

require_once ('database_access/ArticlesRepository.php');
$rep= new ArticlesRepository();
$article = $rep->findById($id);

$image=$article->image;
$dataUri = 'data:image/jpeg;base64,' . base64_encode($image);


$id = $_GET["id"];
$visits = $rep->findVisitsById($id);
$rep->UpdateVisitsByOne($visits->visits,$id);

$currentDate = date('F j, Y');

?>

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
    <!-- Blog post -->

    <section class="blog-post section-header-offset">
        <div class="blog-post-container container">
            <div class="blog-post-data">
                <h3 class="title blog-post-title">
                    <?= strtoupper($article->title) ?>
                </h3>
                <div class="article-data">
                    <span><?=$currentDate?></span>
                    <span class="article-data-spacer"></span>
                    <span><strong>Author</strong> : <?= $article->author; ?></span>
                </div>
                <img style="width: 50%; height: auto; border-radius: 8px; margin: 40px;" src="data:image/jpeg;base64,<?= base64_encode($article->image); ?>" alt="article image">

            </div>
            <div class="container">
                <p>
                    <?= $article->article_content; ?>
                </p>
            </div>
        </div>
    </section>

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
<?php
include 'comments/comments.php';
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