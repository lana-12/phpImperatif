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


<h2>Notre équipe </h2>
    <div class="row">
        <div class="col-12 cardUser">
        <?php
            $level = 1;
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><a href="#">Prénom</a></th>
                            <th scope="col"><a href="#">Nom</a></th>
                            <th scope="col"><a href="#">Email</a></th>
                        </tr>
                    </thead>
                    <tbody>
                ';
        ?>

        <?php
        // foreach ($users as $user) {

            // dump('Dans teams :  ' . $user["lastname"]);
            // echo 'ici '.$user;

            foreach ($users as $users) {
                echo '
                <tr>
      <th scope="row">'.$level++. '</th>
      <td>' . $users['firstname'] . '</td>
      <td>' . $users['lastname'] . '</td>
      <td>@' . $users['email'] . '</td>
    </tr>
                ';
                // echo "\n" . ' <tr>';
                // echo "\n" . '   <td>' . $users['firstname'] . '</td>';
                // echo "\n" . '   <td>' . $users['lastname'] . '</td>';
                // echo "\n" . '   <td>' . $users['email'] . '</td>';
                
                // echo "\n" . ' </tr>';
            }
            echo '</tbody>';
            echo '</table>';

        ?>

    </div>
</div>








