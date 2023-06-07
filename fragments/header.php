<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="/css/general.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/styles.css">

    <script
        type="module"
        src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
        nomodule=""
        src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>
    <script defer src="/scripts/seeAll.js"></script>
    <title><?php if(isset($pageTitle)){echo $pageTitle;} else {echo 'Home';}?> </title>
</head>

<body>

<header class="header">
    <a href="/index.php" id="logo">
        <h1><strong><em>IT.Experts.Blog</em></strong></h1>
    </a>
    <nav class="main-nav">
        <ul class="main-nav-list">
            <?php if(isset($_SESSION["name"])) { ?>
                <li class="Welcome">Welcome,<br> <?= $_SESSION["name"] ?></li>
            <?php } ?>
            <li><a class="main-nav-link" href="/articles_crud/addArticle.php">Add An Article</a></li>
            <li><a class="main-nav-link" href="/Blog.php">Blogs</a></li>
            <?php  if(isset($_SESSION["user"])) {?>
                <li><a href="/authentication/logout.php" class="btn btn--full margin-right-sm">Log out</a></li>
            <?php }  else { ?>
                <li><a href="/authentication/signUp.php" class="btn btn--outline">Sign Up</a></li>
                <li><a href="/authentication/login.php" class="btn btn--full margin-right-sm">Log In</a></li>
            <?php  } ?>
        </ul>
    </nav>
</header>

<?php
if(isset($_SESSION["erreur"])){
    $erreur = $_SESSION["erreur"];
    unset($_SESSION["erreur"]);
}
?>


