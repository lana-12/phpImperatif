<?php

//Ouvre la session
session_start();
//Si aucun user connecté => rediriger vers connexion
if (!isset($_SESSION['user'])) {
    header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=connexion');
    exit;
}


//On supp la session['user']
unset($_SESSION['user']);

// Redirection
header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=connexion');