<?php
require_once(dirname(__FILE__) . '/../utils/functions.php');

// dump(dirname(__FILE__)); //"C:\xampp\htdocs\mes-sites\diginamic\phpTP\src\utils"
// dump(dirname(__FILE__). '/datas'); //"C:\xampp\htdocs\mes-sites\diginamic\phpTP\src\utils/datas"


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
                'mpd' => $data[3]

            ];
        }
        // dump($users[3]['email']);
        return $users;
    } else {
        echo 'Oups, une erreur est survenue lors de l\'ouverture du fichier !!!';
    }
}
