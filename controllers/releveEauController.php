<?php
require_once __DIR__ . "/../models/releveEau.php";
require_once __DIR__ . "/../config/database.php";

class Releve_Eau
{

    public static function create()
    {
        $releve_eauModel = new Eau();
        $db = $releve_eauModel->getDatabase();

        // Récupérer le dernier code client
        $sql1 = "SELECT codeEau FROM releve_eau ORDER BY codeEau DESC LIMIT 1";
        $result = $db->query($sql1);

        if ($result && $row = $result->fetch_assoc()) {
            $codeEau = $row['codeEau'];
        } else {
            $codeEau = "CLI000"; // Valeur par défaut si aucun client
        }

        // Générer le nouvel ID client
        $new_Eau = $releve_eauModel->incrementEauId($codeEau);

        // Requête préparée pour éviter les injections SQL
        $sql = "INSERT INTO releve_eau(codeEau,codecompteur,valeur2,date_releve2,date_presentation2,date_limite_paie2)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssss", $new_Eau, $_POST['codecompteur'], $_POST['valeur2'], $_POST['date_releve2'], $_POST['date_presentation2'], $_POST['date_limite_paie2']);

        if ($stmt->execute()) {
            echo "releve_eau ajouté avec succès !";
        } else {
            echo "Erreur : " . $stmt->error;
        }
    }
    public static function read()
    {
        $releve_eauModel = new Eau();
        $codeEeau = $_POST['codeEau_s'] ?? '';
        $order = $_POST['order'] ?? 'codeEau';
        $result = $releve_eauModel->getReleveEaux($codeEeau, $order);
        return $result;
    }
    public static function modify($codeEau)
    {
        $eauModel = new Eau();
        /*   $db = $userModel->getDatabase();*/
        return $eauModel->getReleveEau($codeEau); // ✅ Retourne l'utilisateur
    }

    public static function update()
    {
        $releve_eauModel = new Eau();
        $db = $releve_eauModel->getDatabase();
        $sql = "UPDATE releve_eau SET codecompteur='$_POST[codecompteur]',
        valeur2='$_POST[valeur2]',date_releve2='$_POST[date_releve2]',
        date_presentation2='$_POST[date_presentation2]',date_limite_paie2='$_POST[date_limite_paie2]'
         WHERE codeEau='$_POST[codeEau]'";
        $result = $db->query($sql);
    }
    public static function delete()
    {
        $releve_eauModel = new Eau();
        $db = $releve_eauModel->getDatabase();
        $sql = "DELETE FROM releve_eau WHERE codeEau='$_POST[codeEau]'";
        $result = $db->query($sql);
    }
}
