<?php
require_once __DIR__ . "/../Model/user.php";

class HomeController
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->getUsers();
        require_once __DIR__ . "/../Views/clientsPage.php";
    }
}
