<?php
require(dirname(__FILE__) . '/../src/utils/functions.php');
require(dirname(__FILE__) . '/../src/models/user.php');


$users  = getUsers();
//Get a queryString + handle errors if not clicked
if(isset($_GET['sort']) && isset($_GET['order']) ){
    sortAlpha($users, $_GET['sort'] ,$_GET['order']);
}

?>

<h2>Notre équipe </h2>
    <div class="row">
        <div class="col-12">

        <?php
        $sorts = getSortOrder();
            $level = 1;
        echo '<table class="table">';
        echo "\n" . '<thead>';
            echo "\n" . ' <tr>';
            echo "\n" . '   <th scope="col">#</th>';
            echo "\n" . '   <th scope="col"><a href="/index.php?page=membres&sort=firstname&order='.$sorts['firstname'].'">Prénom</a></th>';
            echo "\n" . '   <th scope="col"><a href="/index.php?page=membres&sort=lastname&order='.$sorts['lastname'].'">Nom</a></th>';
            echo "\n" . '   <th scope="col"><a href="/index.php?page=membres&sort=email&order='.$sorts['email'].'">Email</a></th>';
            echo "\n" . ' </tr>';
        echo "\n" . ' </thead>';
        echo "\n" . ' <tbody>';
        ?>

        <?php
            foreach ($users as $users) {
                echo '
                <tr>
                    <th scope="row">'.$level++. '</th>
                    <td>' . $users['firstname'] . '</td>
                    <td>' . $users['lastname'] . '</td>
                    <td>' . $users['email'] . '</td>
                </tr>
                ';
            }
        echo '</tbody>';
        echo '</table>';
        ?>
    </div>
</div>








