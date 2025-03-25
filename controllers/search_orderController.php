<?php
/*
require_once __DIR__ ."/../Model/user.php";
$userModel = new User();
if(array_key_exists(("nom"),$_GET) && array_key_exists(("order"),$_GET)){
    if(empty($_GET["nom"])){
        $users = $userModel->getUsers('',$_GET['order']);
    }else{
    $users = $userModel->getUsers($_GET['nom'],$_GET['order']);
    }

}elseif(array_key_exists(('nom'),$_GET)){
    $users = $userModel->getUsers($_GET['nom']);

}elseif(array_key_exists(('order'),$_GET)){
    $users = $userModel->getUsers('',$_GET['order']);
}
require_once __DIR__ .'/../Views/clientsPage.php';*/

require_once __DIR__ . "/../Model/user.php";
$userModel = new User();
if (array_key_exists(("nom"), $_POST) && array_key_exists(("order"), $_POST)) {
    if (empty($_POST["nom"])) {
        $users = $userModel->getUsers('', $_POST['order']);
    } else {
        $users = $userModel->getUsers($_POST['nom'], $_POST['order']);
    }
} elseif (array_key_exists(('nom'), $_POST)) {
    $users = $userModel->getUsers($_POST['nom']);
} elseif (array_key_exists(('order'), $_POST)) {
    $users = $userModel->getUsers('', $_POST['order']);
}
