<?php
use App\Entity\Post;
include_once './src/Template/header.php';
?>

<main class="container mt-5">
    <div class="row">
        <div class="col">
            <h1>Bienvenue sur la page post !</h1>
            <?php
            /** @var Post $post */
            foreach($posts as $post){
            ?>
            <div class="card mt-3">
                <h5 class="card-header"><?php echo $post->getTitle() ?></h5>
                <div class="card-body">
                    <h5 class="card-title">Auteur: <span class="fw-bold"><?php echo $post->getUser()->getUsername() ?></span></h5>
                    <p class="card-text"><?php echo $post->getDescription() ?></p>
                    <a href="#" class="btn btn-outline-primary">Consulter la discussion <span class="fw-bold"><?php echo $post->getTitle() ?></span></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php
include_once './src/Template/header.php';
?>