<?php
require(dirname(__FILE__) . '/../src/utils/functions.php');
require(dirname(__FILE__) . '/../src/models/user.php');

$users  = getUsers();

// dump($users);
// dump('Dans teams :  '.getUsers());

// foreach ($users as $user) {

//     dump('Dans teams :  ' . $user["lastname"]);
//     // echo 'ici '.$user;
// }
?>


<h2>Notre équipe</h2>
<div class="row">
    <div class="col-12 cardUser">
        <?php
        echo '<table class="table">';
        echo "\n" . ' <tr>';
        echo "\n" . '   <th><a href="#">Prénom</a></th>';
        echo "\n" . '   <th><a href="#">Nom</a></th>';
        echo "\n" . '   <th><a href="#">Email</a></th>';
        echo "\n" . ' </tr>';
        ?>

        <?php
        // foreach ($users as $user) {

            // dump('Dans teams :  ' . $user["lastname"]);
            // echo 'ici '.$user;

            foreach ($users as $users) {
                echo "\n" . ' <tr>';
                echo "\n" . '   <td>' . $users['firstname'] . '</td>';
                echo "\n" . '   <td>' . $users['lastname'] . '</td>';
                echo "\n" . '   <td>' . $users['email'] . '</td>';
                
                echo "\n" . ' </tr>';
            }
            echo '</table>';

        ?>

    </div>
</div>





