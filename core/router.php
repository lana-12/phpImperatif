<?php
$page = 'home.php';

if(isset($_GET['page'])){
    switch ($_GET['page']){
        
        case 'quiSommesNous':
            $page = 'about.php';
            break;
        
        case 'membres':
            $page = 'teams.php';
            break;

        case 'connexion':
            $page = 'login.php';
            break;

        case 'deconnexion':
            $page = 'logout.php';
            break;

        case 'creation':
            $page = 'createUser.php';
            break;

        case 'delete':
            $page = 'delete.php';
            break;

        case 'update':
            $page = 'update.php';
            break;

        default:
            $page = 'home.php';
            break;
    }
}

require_once(dirname(__FILE__) . '/../views/' . $page);