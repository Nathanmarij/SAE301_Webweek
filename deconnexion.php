<?php
session_start();
include_once("config/ConfigBDD.php");
include_once("class/Users.php");
$user = new Users('', '', '', '', '', '', '');
// déconnecter l'utilisateur
$user->deconnecter();
?>