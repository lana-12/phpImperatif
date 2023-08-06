<?php
require_once(dirname(__FILE__) . '/../utils/functions.php');
require_once(dirname(__FILE__) . '/../../core/security.php');


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
        // fclose($file_pointer);
        return $users;
    } else {
        echo 'Oups, une erreur est survenue lors de l\'ouverture du fichier !!!';
    }
}



function setUser()
{
    $errors=[];
    // dump($_POST);

    if(isset($_POST['submit'])){

        if(isset($_POST['firstname']) && $_POST['firstname'] !== ''){

            if(isset($_POST['lastname']) && $_POST['lastname'] !== ''){
                if(isset($_POST['password']) && $_POST['password'] !== ''){

                    $user = searchByEmail($_POST['email']);
                    if($user === true){
                        $errors[]= "L'email existe déjà !!";
                    }else{
                        if(addUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'] )){
                            // echo 'Uutilisateur bien enregistré';
                            echo '
                            <div class="alert alert-success mt-5" role="alert">
                            <p class="text-center ">Utilisateur bien enregistré</p>
                            <a href="/index.php?page=accueil">Connecter vous !!</a>
                            </div>';
                            
                        } else {
                            echo 'Une erreur est survenue lors de l\' enregistrement';
                        }
                    }

                }else{
                    $errors= 'Mot de passe obligatoire !!';
                }


            } else {
                $errors = 'Votre nom est obligatoire !!';
            }

        }else {
            $errors = 'Votre prénom est obligatoire !!';
        }

    }


    //Marche pas les erreurs ne sont tte ds le array il y a que la première

    // dump($errors);
    if(count($errors) > 0){
        foreach($errors as $error){
            echo '<div class="alert alert-danger mt-5" role="alert">
                <p class="text-center ">'.$error.'</p>
            </div>';
        }
    }
}



function deleteUsers(&$users, $index)
{
    $file_path = dirname(__FILE__) . '/../datas/users.csv';
    if (file_exists($file_path)) {

        $file_pointer = fopen($file_path, 'w');
        foreach ($users as $i => $user) {
            if ($index != $user['email']) {
                fwrite($file_pointer, $user["firstname"] . ';' . $user["lastname"] . ';'  . $user["email"] . ';' . $user["password"] . PHP_EOL);
            } else unset($users);
        }
        fclose($file_pointer);
    }
}


function updateUserByEmail($email, $data)
{
    $newData = formatUser($data);
    // dump($newData);

    $file = dirname(__FILE__) . '/../datas/users.csv';
    $tempFile = dirname(__FILE__) . '/../datas/users_temp.csv';
    $updateSuccessful = false;

    // Lire le contenu du fichier CSV et le stocker dans un tableau
    $users = [];
    // if (file_exists($file)) {

    if (($file_pointer = fopen($file, 'r')) !== false) {
        while (($data = fgetcsv($file_pointer, null, ';')) !== false) {
            $users[] = $data;
        }
        // dump($users); //display chaque users
        fclose($file_pointer);


            foreach ($users as $key => $user) {
                $currentUserEmail = $user[2]; // L'adresse e-mail est à l'indice 2
                if ($currentUserEmail === $email) {
                    // Mettre à jour les données de l'utilisateur
                    // dump($users[$key]);
                    $users[$key] = $newData;
                    // dump($newData);
                    // dump($users[$key][0]);

                    // ici $users[$key] stock les modif
                    // dump('current : '. $currentUserEmail);
                    // dump('email : '. $email);
                    $updateSuccessful = true;
                    // break; // Sortir de la boucle une fois l'utilisateur mis à jour
                }
            }
            if ($updateSuccessful) {
                // Ouvrir le fichier temporaire pour écrire les données mises à jour
                if (($tempHandle = fopen($tempFile, 'w')) !== false) {
                    foreach ($users as $user) {
                        fputcsv($tempHandle, $user, ';');
                    }
                    fclose($tempHandle);

                    // Remplacer l'ancien fichier par le fichier temporaire mis à jour
                    rename($tempFile, $file);
                    return true;
                } else {
                    // Gérer l'erreur si le fichier temporaire ne peut pas être ouvert
                    return false;
                }
            } else {
                // Si l'utilisateur n'a pas été trouvé
                return false;
            }
    } else {
            echo 'Une erreur n\'est produite lors de l\'ouverture du fichier';

        return false;
    }

}
// else {
//     echo 'Le fichier n\'existe pas';
// }
// }
