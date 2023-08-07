<?php
session_start();
require_once(dirname(__FILE__) . '/../core/security.php');
require_once(dirname(__FILE__) . '/../src/utils/functions.php');
require_once(dirname(__FILE__) . '/../src/models/user.php');

$users = getUsers();

if(isset($_POST['submit'])){
    $newUserData = [$_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']]; 
    $updateResult = updateUserByEmail($_POST['email'], $newUserData);
    if ($updateResult) {
        header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=membres');
    } else {
        echo "L'utilisateur n'a pas été trouvé.";
    }
}
?>
<h2>Modification de compte</h2>

<?php
    foreach ($users as $user) {
?>
    <form action="index.php?page=update&update=<?= $user['email'] ?>" method="POST">
<?php
        if ($user['email'] === $_GET['update']) {
    ?>
            <div class="mb-3">
                <label for="firstname" class="form-label">Votre Prénom</label>
                <input type="firstname" class="form-control" id="firstname" name="firstname" aria-describedby="firstnameHelp" value=" <?= $user['firstname'] ?> ">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Votre Nom</label>
                <input type="lastname" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp" value=" <?= $user['lastname'] ?> ">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Votre Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value=" <?= $user['email'] ?> ">
            </div>
            <div class=" mb-3">
                <label for="password" class="form-label">Votre Mot de Passe</label>
                <input type="password" class="form-control" id="password" name="password" value=" <?= $user['password'] ?> ">
            </div>

            <input type="submit" class="btn btn-primary" name='submit' value="Modifier votre compte">
    <?php
        }
    }
    ?>
</form>