<?php
require_once __DIR__ . "/../models/compteur.php";
require_once __DIR__ . "/../config/database.php";


class Crudcompteur
{
    public static function create()
    {
        $compteurModel = new Compteur();
        $db = $compteurModel->getDatabase();

        // Récupérer le dernier code client
        $sql1 = "SELECT codecompteur FROM COMPTEUR ORDER BY codecompteur DESC LIMIT 1";
        $result = $db->query($sql1);

        if ($result && $row = $result->fetch_assoc()) {
            $codecompteur = $row['codecompteur'];
        } else {
            $codecompteur = "COMPTEUR000"; // Valeur par défaut si aucun client
        }

        // Générer le nouvel ID client
        $new_compteur = $compteurModel->incrementCompteurId($codecompteur);

        // Requête préparée pour éviter les injections SQL
        $sql = "INSERT INTO COMPTEUR (codecompteur,`type`,pu,codecli) 
            VALUES (?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssss", $new_compteur, $_POST['type'], $_POST['pu'], $_POST['codecli']);

        if ($stmt->execute()) {
            echo "Compteur ajouté avec succès !";
        } else {
            echo "Erreur : " . $stmt->error;
        }
    }

    public static function read()
    {
        $compteurModel = new Compteur();
        $codecli = $_POST['nom_client'] ?? '';
        $order = $_POST['order'] ?? 'codecompteur';
        $svp = $compteurModel->getCompteur($codecli, $order);
        return $svp;
    }
    public static function update()
    {
        $compteurModel = new Compteur();
        $db = $compteurModel->getDatabase();
        $sql = "UPDATE COMPTEUR set `type`='$_POST[type]',pu='$_POST[pu]',codecli='$_POST[codecli]' WHERE codecompteur='$_POST[codecompteur]'";
        $result = $db->query($sql);
        $compteur = $compteurModel->getCompteur();
        return $compteur;
    }
    public static function delete()
    {
        $compteurModel = new Compteur();
        $db = $compteurModel->getDatabase();
        $sql = "DELETE FROM COMPTEUR WHERE codecompteur='$_POST[codecompteur]'";
        $result = $db->query($sql);
        $users = $compteurModel->getcompteur();
    }
    public static function modify($codecompteur)
    {
        $compteurModel = new Compteur();
        /*   $db = $compteurModel->getDatabase();*/
        return $compteurModel->getCompteurById($codecompteur); // ✅ Retourne l'utilisateur
    }
}
