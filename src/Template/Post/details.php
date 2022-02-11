<?php
use App\Entity\Comment;
use App\Entity\Post;
include_once './src/Template/header.php';
/** @var Post $post */
?>

<main class="container mt-5">
    <div class="row">
        <div class="col">
            <h1>Bienvenue sur <?php echo $post->getTitle() ?>!</h1>
            <ul class="list-group">
            <?php 
                /** @var Comment $comment */
                if(!$comments) echo "<p>Il n'y a pas de commentaire sous ce post</p>";
                foreach ($comments as $comment) {
            ?>
                <li class="list-group-item">
                    Auteur: <span class="fw-bold"><?php echo $comment->getUser()->getUsername() ?></span></br>
                    Role: <span class="fst-italic"><?php echo $comment->getUser()->getRole()->getTitle() ?></span></br> 
                    <?php echo $comment->getMessage() ?>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</main>

<?php
include_once './src/Template/header.php';
?>