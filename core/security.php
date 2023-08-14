<?php
require_once(dirname(__FILE__).'/../src/models/user.php');
require_once(dirname(__FILE__).'/../src/utils/functions.php');


/**
 * To start a session if successful Authentication
 * calling a function search_user(email, pwd) verify user credentials
 *
 * @return void
 */
function connect()
{
    // session_start();
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
}



/**
 * Read user data from a CSV file and return it as an associative array.
 * creates an associative array where the email addresses are used as keys and the corresponding hashed passwords are used as values.
 *
 * @return array
 */
function read_users()
{
    if ($fp = fopen(dirname(__FILE__) . '/../src/datas/users.csv', 'r')) {
        while ($user = fgetcsv($fp, null, ';')) {

            //HERE we retrieve the email key + mdp value
            // dump('key email + value MDP : '.$user[2] = $user[3]);
            $result[$user[2]]= $user[3];
        }
        fclose($fp);
        return $result;
    } else {
        echo 'Erreur pendant l\'ouverture du fichier<br>';
    }
}


/**
 * Check if user credentials are valid.
 *
 * @param string $email The user's email address.
 * @param string $pwd The user's password.
 *
 * @return bool Returns true if the user's credentials are valid, false otherwise.
 */
function search_user($email, $pwd)
{
      // Read user data to validate against.
    $users = read_users();

    // Check if user array exists, if email exists as a key, and if the provided password matches the hashed password.
    if (is_array($users) && array_key_exists($email, $users) &&  password_verify($pwd, $users[$email])) {
        return true;
    }
    return false;
}


/**
 * Search a user by email
 * @param string $email
 * @return bool
 */
function searchByEmail($email)
{
    $users = read_users();
    if (array_key_exists($email, $users)) {
        return true;
    }
    return false;
}


/**
 * Add new user in file => users.csv
 *
 * @param string $firstname
 * @param string $lastname
 * @param string $email
 * @param string $pwd
 * @return bool
 */
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
 * Format new datas remove spaces + hash pwd
 * @param array $user
 * @return array $newUser
 */
function formatUser($user){
    if($user[3] !== ""){
        $hash = password_hash($user[3], PASSWORD_DEFAULT);
    }
    $newUser= [
        trim($user[0]),
        trim($user[1]),
        trim($user[2]),
        trim($hash)
    ];
    return $newUser;
}