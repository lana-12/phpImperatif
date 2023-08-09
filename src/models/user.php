<?php
require_once(dirname(__FILE__) . '/../utils/functions.php');
require_once(dirname(__FILE__) . '/../../core/security.php');


/**
 * Display users 
 *
 * @return array $users
 */
function getUsers()
{
    // Creation an empty array
    $users = [];
    $file_path = dirname(__FILE__) . '/../datas/users.csv';

    if (file_exists($file_path)) {
        $file_pointer = fopen($file_path, 'r');

        while ($data = fgetcsv($file_pointer, null, ';')) {

            //Create an array with datas =>Users
            $users[] = [
                'firstname' => $data[0],
                'lastname' => $data[1],
                'email' => $data[2],
                'password' => $data[3]

            ];
        }
        fclose($file_pointer);
        return $users;
    } else {
        echo 'Oups, une erreur est survenue lors de l\'ouverture du fichier !!!';
    }
}

/**
 * Create user with form
 *
 * @return void
 */
function setUser()
{
    $errors=[];
    // dump($_POST);

    if(isset($_POST['submit'])){

        if(isset($_POST['firstname']) && $_POST['firstname'] !== ''){

            if(isset($_POST['lastname']) && $_POST['lastname'] !== ''){
                if(isset($_POST['password']) && $_POST['password'] !== ''){

                    if(isset($_POST['email']) && $_POST['email'] !== ''){
                        $user = searchByEmail($_POST['email']);
                        if ($user === true) {
                            $errors[] = "L'email existe déjà !!";
                        } else {
                            if (addUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
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
                    } else {
                        $errors[] = "L'email est obligatoire!!";
                    }
                }else{
                    $errors[]= 'Mot de passe obligatoire !!';
                }
            } else {
                $errors[] = 'Votre nom est obligatoire !!';
            }
        }else {
            $errors[] = 'Votre prénom est obligatoire !!';
        }
    }


    //Marche pas les erreurs ne sont tte ds le array il y a que la première

    if($errors){
        foreach($errors as $error){
            echo '<div class="alert alert-danger mt-5" role="alert">
                <p class="text-center ">'.$error.'</p>
            </div>';
        }
    }
}


/**
 * Undocumented function
 *
 * @param array $users
 * @param string $index => queryString delete=$index
 * @return void
 */
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

/**
 * Upadte Account User
 *
 * @param [type] $email
 * @param [type] $data
 * @return void
 */
function updateUserByEmail($email, $data)
{
    $newData = formatUser($data);
    // dump($newData);

    $file = dirname(__FILE__) . '/../datas/users.csv';
    $tempFile = dirname(__FILE__) . '/../datas/users_temp.csv';
    $updateSuccessful = false;

    $users = [];
    
    // Lire le contenu du fichier CSV et le stocker dans un tableau
    if (($file_pointer = fopen($file, 'r')) !== false) {
        while (($data = fgetcsv($file_pointer, null, ';')) !== false) {
            $users[] = $data;
        }
        //display chaque users
        // dump($users); 
        fclose($file_pointer);


            foreach ($users as $key => $user) {
                // Email => index 2
                $currentUserEmail = $user[2]; 
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
                    echo 'Une erreur s\'est produite lors de l\'ouverture du fichier Temporaire';
                    return false;
                }
            } else {
                echo 'Une erreur n\'est survenue, Utilisateur non trouvé';
                return false;
            }
    } else {
        echo 'Une erreur s\'est produite lors de l\'ouverture du fichier';
        return false;
    }
}
