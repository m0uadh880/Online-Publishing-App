<?php
$pageTitle = 'Home';
include 'fragments/header.php';
?>

<main>
    <section class="section-home">
        <div class="home">
            <div class="home-text-box">
                <h1 class="heading-primary">
                    <strong>Unlock the Power of Technology:</strong>
                </h1>
                <h2 class="home-description">
                    Talk about what you're passionate about, in your own way
                </h2>
                <a href="/Blog.php"><button type="button" class="btn btn-outline-dark ExploreBtn">Explore Our Blogs <strong>→</strong></button></a>
            </div>
            <div class="home-img-box">
                <img
                    src="img/img3.jpg"
                    class="home-img"
                    alt="home image"/>
            </div>
        </div>
    </section>
</main>


<?php
include 'fragments/footer.php';
?>

