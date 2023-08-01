<?php
require_once(dirname(__FILE__).'/../src/models/user.php');
require_once(dirname(__FILE__).'/../src/utils/functions.php');

// TODOLIST
    // 1.   Function findUser
    // 2.   Function findByFirstname
    // 3.   Function findByLastname
    // 4.   Function findByEmail

    // 5.   Function connect
    // 6.   Function disconnect



function postLog()
{
    if(isset($_POST['email'])  && isset($_POST['password']) ){
        echo $_POST['email'];
        echo $_POST['password'];
        echo $_POST['connexion'];
    }
}

function connect()
{
    //Start test
// $users = read_users();

//     // dump(read_users());
//     // dump(search_user($_POST['email']));
//     if (search_user($_POST['email'], $_POST['password']) === true) {
//         echo 'Youpy';

    
//     } else {
//         echo 'putain de MERDE';
//     }
    //End test



    session_start();
    // Soit l'utilisateur vient de renseigner le formulaire et on vérifie que le couple login/mdp est
    if (isset($_POST['connexion']) && $_POST['connexion'] === 'connect') {
        session_destroy();
        if (isset($_POST['email']) && isset($_POST['password'])) {
            if (search_user($_POST['email'], $_POST['password']) === true) {
                session_start();
                $_SESSION['user'] = [
                    'connect'=> true,
                    'email' =>  $_POST['email'],
                ];

                header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=accueil');
            } else {
                echo '
                <div class="alert alert-danger mt-5" role="alert">
                    <p class="text-center ">Utilisateur Inconnu</p>
                </div>
                ';
            }
        }
    } 
    // else {
    //     session_destroy();
    // }
}




function read_users()
{
    // $result = [];
    if ($fp = fopen(dirname(__FILE__) . '/../src/datas/users.csv', 'r')) {
        while ($user = fgetcsv($fp, null, ';')) {

            // $email = $user[0] = $user[2];
            // dump('email : ' . $email);

            // $mdp = $user[0] = $user[3];
            // dump('mdp : ' . $mdp);


            //ICI on recup la clé email + value du mdp
            // dump('key email + value MDP : '.$user[2] = $user[3]);
            $result[$user[2] ]= $user[3];
        }
        fclose($fp);
        return $result;
    } else {
        echo 'Erreur pendant l\'ouverture du fichier<br>';
    }
}

function search_user($email, $pwd)
{
    $users = read_users();
    if (is_array($users) && array_key_exists($email, $users) &&  password_verify($pwd, $users[$email])) {
        return true;
    }
    return false;
}

