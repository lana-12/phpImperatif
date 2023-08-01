<?php
require_once(dirname(__FILE__) . '/../core/security.php');

// postLog();
connect();
?>

<h2>Me connecter</h2>

<?php if (isset($_SESSION["user"]) && ($_SESSION["user"])) : ?>
    <div class="alert alert-success mt-5" role="alert">
        <p class="text-center ">Vous êtes déjà connecté</p>
        <a href="/index.php?page=deconnexion">Se déconnecter</a>
    </div>

<?php else : ?>
    <form action="index.php?page=connexion" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="password" name="password">
            <input type="hidden" value="connect" name="connexion">
        </div>

        <input type="submit" class="btn btn-primary" value="Envoyer">

    </form>

<?php endif ?>