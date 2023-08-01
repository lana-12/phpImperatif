<?php
require_once(dirname(__FILE__) . '/../utils/functions.php');

// dump(dirname(__FILE__)); //"C:\xampp\htdocs\mes-sites\diginamic\phpTP\src\utils"
// dump(dirname(__FILE__). '/datas'); //"C:\xampp\htdocs\mes-sites\diginamic\phpTP\src\utils/datas"

// TODOLIST
    // 1.   Function getUser
    // 2.   Function createUser
    // 3.   Function updateUser
    // 4.   Function deleteUser
    // 5.   Function searchUser


function getUsers()
{
    // Creation an empty array
    $users = [];
    $file_path = dirname(__FILE__) . '/../datas/users.csv';

    if (file_exists($file_path)) {
        $file_pointer = fopen($file_path, 'r');

        while ($data = fgetcsv($file_pointer, null, ';')) {
            //Vérif ce que je récupère
            // dump($data[0]);

            //Create an array with datas =>Users
            $users[] = [
                'firstname' => $data[0],
                'lastname' => $data[1],
                'email' => $data[2],
                'password' => $data[3]

            ];
        }
        // dump($users[3]['email']);
        fclose($file_pointer);
        return $users;
    } else {
        echo 'Oups, une erreur est survenue lors de l\'ouverture du fichier !!!';
    }
}



// function searchUser($email, $pwd)
// {   
//     $users = getUsers();
//     // dump($users);
//     //Verifie si $var est un array => is_array($var)
// if(array_key_exists($email, $users)){
//     echo 'ok';
// }else {
//     echo 'oups ';
// }
//     // if(is_array($users)){
//     //     dump('It\'s an array');
//     //     foreach ($users as $user) {
//     //         dump($user['email']);
//     //         // dump($value);

//     //         // if($key['email'] === $email && password_verify($pwd, $key['password'])){
//     //         //     echo 'Vous êtes identifié';
//     //         //     return true;
//     //         // } else {
//     //         //     echo 'L\'identifiant et/ou le mot de passe n\'existe pas !!';
//     //         //     return false;
//     //         // }
//     //     }
//     //     // return true ;
//     // } else {
//     //     dump('not an array');
//     //     // return false;
//     // }
// }





