<?php
require_once __DIR__ . "/../models/user.php";
require_once __DIR__ . "/../config/database.php";



/*if(array_key_exists("crud",$_GET)){
    $crud = $_GET['crud'];
    switch( $crud ){
        case 'create':
            Crud::create();
            break;
        case 'delete':
            Crud::delete();
            break;
        case 'update':
            Crud::update();
            break;
    }
}
elseif(array_key_exists('codecli',$_GET)){
    $codecli = $_GET['codecli'];
    Crud::generate_page($codecli);
}*/

class Crud
{
    public static function create()
    {/*
        $userModel = new User();
        $db = $userModel->getDatabase();
        $sql1 = "SELECT codecli FROM CLIENT DESC LIMIT 1";

        $codecli = $db->query($sql1);
        $new_cli = $userModel->incrementClientId($codecli);
        $sql = "INSERT INTO CLIENT(codecli,nom,sexe,quartier,niveau,mail) VALUES('$new_cli','$_POST[nom]','$_POST[sexe]','$_POST[quartier]','$_POST[niveau]','$_POST[mail]')";
        $result = $db->query($sql);*/

        $userModel = new User();
        $db = $userModel->getDatabase();

        // Récupérer le dernier code client
        $sql1 = "SELECT codecli FROM CLIENT ORDER BY codecli DESC LIMIT 1";
        $result = $db->query($sql1);

        if ($result && $row = $result->fetch_assoc()) {
            $codecli = $row['codecli'];
        } else {
            $codecli = "CLI000"; // Valeur par défaut si aucun client
        }

        // Générer le nouvel ID client
        $new_cli = $userModel->incrementClientId($codecli);

        // Requête préparée pour éviter les injections SQL
        $sql = "INSERT INTO CLIENT (codecli, nom, sexe, quartier, niveau, mail) 
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssss", $new_cli, $_POST['nom'], $_POST['sexe'], $_POST['quartier'], $_POST['niveau'], $_POST['mail']);

        if ($stmt->execute()) {
            echo "Client ajouté avec succès !";
        } else {
            echo "Erreur : " . $stmt->error;
        }
    }

    public static function read()
    {
        $userModel = new User();
        $nom = $_POST['nom_client'] ?? '';
        $order = $_POST['order'] ?? 'codecli';
        $svp = $userModel->getUsers($nom, $order);
        return $svp;
    }
    public static function update()
    {
        $userModel = new User();
        $db = $userModel->getDatabase();
        $sql = "UPDATE CLIENT SET nom='$_POST[nom]', sexe='$_POST[sexe]', quartier='$_POST[quartier]',
                niveau='$_POST[niveau]', mail='$_POST[mail]' WHERE codecli='$_POST[codecli]'";
        $result = $db->query($sql);
        $users = $userModel->getUsers();
    }
    public static function delete()
    {
        $userModel = new User();
        $db = $userModel->getDatabase();
        $sql = "DELETE FROM CLIENT WHERE codecli='$_POST[codecli]'";
        $result = $db->query($sql);
        $users = $userModel->getUsers();
    }
    public static function modify($codecli)
    {
        $userModel = new User();
        /*   $db = $userModel->getDatabase();*/
        return $userModel->getUser($codecli); // ✅ Retourne l'utilisateur
    }
}
