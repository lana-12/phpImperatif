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

        default:
            $page = 'home.php';
            break;
    }
}

require_once(dirname(__FILE__) . '/../views/' . $page);