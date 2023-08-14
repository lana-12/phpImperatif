<?php

require(dirname(__FILE__) . '/../src/utils/functions.php');
require(dirname(__FILE__) . '/../src/models/user.php');

$users  = getUsers();

if (isset($_GET['sort']) && isset($_GET['order'])) {
    sortAlpha($users, $_GET['sort'], $_GET['order']);
}

if (isset($_SESSION['user']) && $_SESSION['user'] && isset($_GET["delete"])) {
    deleteUsers($users, $_GET['delete']);
    header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=membres');
}

?>

<h2>Notre équipe </h2>

<div class="row">
    <div class="col-12">

        <?php
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            echo '<p class="text-muted">Connecté en tant que <span class="user">' . $_SESSION['user']['email'] . ' </span></p>';

            $sorts = getSortOrder();
            $level = 1;
            echo '<table class="table">';
            echo "\n" . '<thead>';
            echo "\n" . ' <tr>';
            echo "\n" . '   <th scope="col">#</th>';
            echo "\n" . '   <th scope="col"><a href="/index.php?page=membres&sort=firstname&order=' . $sorts['firstname'] . '">Prénom</a></th>';
            echo "\n" . '   <th scope="col"><a href="/index.php?page=membres&sort=lastname&order=' . $sorts['lastname'] . '">Nom</a></th>';
            echo "\n" . '   <th scope="col"><a href="/index.php?page=membres&sort=email&order=' . $sorts['email'] . '">Email</a></th>';
            echo "\n" . ' </tr>';
            echo "\n" . ' </thead>';
            echo "\n" . ' <tbody>';
        
            foreach ($users as $user) {
                echo '
                <tr>
                    <th scope="row">' . $level++ . '</th>
                    <td>' . $user['firstname'] . '</td>
                    <td>' . $user['lastname'] . '</td>
                    <td>' . $user['email'] . '</td>
                    <td><a href="/index.php?page=update&update='.$user['email']. '" class="btn btnUpdate btn-warning">Modifier</a></td>
                    <td><a href="/index.php?page=membres&delete='.$user['email'].'" class="btn btnDelete btn-danger">Supprimer</a></td>
                </tr>
                ';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            
            echo '
                <div class="alert alert-danger mt-5" role="alert">
                    <p class="text-center ">Vous devez être connecté</p>
                    <p><a href="/index.php?page=connexion">Se connecter</a></p>
                    <p><a href="/index.php?page=creation">Créer un compte</a></p>
                </div>';
        }
        ?>
    </div>
</div>

