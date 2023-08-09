<?php
require(dirname(__FILE__). '/../src/models/user.php');
setUser();

?>

<h2 class="my-5">Création de compte</h2>

<form action="index.php?page=creation" method="POST">


    <div class="mb-3">
        <label for="firstname" class="form-label">Votre Prénom</label>
        <input type="firstname" class="form-control" id="firstname" name="firstname" aria-describedby="firstnameHelp" placeholder="Bob">
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Votre Nom</label>
        <input type="lastname" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp" placeholder="Dylan">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Votre Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="exemple@exemple.fr">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Votre Mot de Passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <input type="submit" class="btn btn-primary" name='submit' value="Créer un compte">

</form>