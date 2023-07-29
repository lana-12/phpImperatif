<?php
require_once(dirname(__FILE__). '/../core/security.php');

postLog();
?>

<h2>Me connecter</h2>

    <form action="index.php?page=connexion" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        
        <input type="submit" class="btn btn-primary" value="Envoyer">
        
    </form>