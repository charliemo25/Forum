<?php
include_once './src/Template/header.php';
?>

<main class="container mt-5">
    <div class="row">
        <div class="col">
            <form action="/connexion" method="POST">
                <h1 class="h3 mb-3 fw-normal">Se connecter au scuffed forum</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</main>

<?php
include_once './src/Template/header.php';
?>