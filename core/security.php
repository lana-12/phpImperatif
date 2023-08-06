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

    session_start();
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
            $result[$user[2]]= $user[3];
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



function searchByEmail($email)
{
    $users = read_users();
    if (array_key_exists($email, $users)) {
        return true;
    }
    return false;
}


function addUser($firstname, $lastname, $email, $pwd)
{
    // "a" ouvrir en pointant à la fin du fichier
    if ($fp = fopen(dirname(__FILE__) . '/../src/datas/users.csv', 'a')) {
        if (fputcsv($fp, [$firstname, $lastname, $email, password_hash($pwd, PASSWORD_DEFAULT)], ';')) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

// recupere les user sous forme de array les index sont les users
// ex openUser()[0]=> return le first, [1]=> le second etc...
function openUser()
{
    // $result = [];
    if ($fp = fopen(dirname(__FILE__) . '/../src/datas/users.csv', 'r')) {
        $i = 0;
        while ($user = fgetcsv($fp, null, ';')) {
            $result[$i] = $user;
            // dump($result[$i]);
            $i++;            
            
        }
        fclose($fp);
        return $result;
    } else {
        echo 'Erreur pendant l\'ouverture du fichier<br>';
    }
}


/**
 * Undocumented function
 * Formater les new datas enlever les espace + hash
 * @param array $user
 * @return void
 */
function formatUser($user){
    // dump($user[3]);
    if($user[3] !== ""){
        $hash = password_hash($user[3], PASSWORD_DEFAULT);
    }
    // dump($hash);
    $newUser= [
        trim($user[0]),
        trim($user[1]),
        trim($user[2]),
        trim($hash)
    ];
    return $newUser;
}