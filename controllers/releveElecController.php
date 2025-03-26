<?php
require_once __DIR__ . "/../models/releveElec.php";
require_once __DIR__ . "/../config/database.php";



class ReleveElec
{
    public function __construct()
    {
        echo "Classe Releve_Elec chargée.";
    }
    public static function create()
    {
        $releve_elecModel = new Elec();
        $db = $releve_elecModel->getDatabase();

        // Récupérer le dernier code client
        $sql1 = "SELECT codeElec FROM releve_elec ORDER BY codeElec DESC LIMIT 1";
        $result = $db->query($sql1);

        if ($result && $row = $result->fetch_assoc()) {
            $codeElec = $row['codeElec'];
        } else {
            $codeElec = "CLI000"; // Valeur par défaut si aucun client
        }

        // Générer le nouvel ID client
        $new_Elec = $releve_elecModel->incrementElectId($codeElec);

        // Requête préparée pour éviter les injections SQL
        $sql = "INSERT INTO releve_elec(codeElec,codecompteur,valeur1,date_releve,
date_presentation,date_limite_paie)
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssss", $new_Elec, $_POST['codecompteur'], $_POST['valeur1'], $_POST['date_releve'], $_POST['date_presentation'], $_POST['date_limite_paie']);

        if ($stmt->execute()) {
            echo "Client ajouté avec succès !";
        } else {
            echo "Erreur : " . $stmt->error;
        }
    }
    public static function read()
    {
        $releve_elecModel = new Elec();
        $result = $releve_elecModel->getReleveElecs();
        return $result;
    }
    public static function modify($codeElec)
    {
        $elecModel = new Elec();
        /* $db = $userModel->getDatabase();*/
        return $elecModel->getReleveElec($codeElec); // ✅ Retourne l'utilisateur
    }

    public static function update()
    {
        $releve_elecModel = new Elec();
        $db = $releve_elecModel->getDatabase();
        $sql = 'UPDATE FROM releve_elec SET codecompteur="$_POST[codecompteur]",
valeur2="$_POST[valeur1]",date_releve1="$_POST[date_releve]",
date_presentation="$_POST[date_presentation]",date_limite_paie="$_POST[date_limite_paie]"
WHERE codeElec="$_POST[codeElec]"';
        $result = $db->query($sql);
    }
    public static function delete()
    {
        $releve_elecModel = new Elec();
        $db = $releve_elecModel->getDatabase();
        $sql = 'DELETE FROM releve_elec WHERE codeElec="$_POST[codeElec]"';
        $result = $db->query($sql);
    }
}
