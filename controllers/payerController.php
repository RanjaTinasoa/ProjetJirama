<?php
require_once __DIR__ . "/../models/payer.php";

class PayerCrud
{
    public static function create()
    {
        /* $payerModel = new PayerModel();
        $db = $payerModel->getDatabase();
        $sql = 'INSERT INTO payer(idpaye,codecli,datepaye,montant) VALUES("$_POST[idpaye]","$_POST[codecli]","$_POST[datepaye]","$_POST[montant]")';
        $result = $db->query($sql);*/
        $payeModel = new PayerModel();
        $db = $payeModel->getDatabase();

        // Récupérer le dernier code client
        $sql1 = "SELECT idpaye FROM payer ORDER BY idpaye DESC LIMIT 1";
        $result = $db->query($sql1);

        if ($result && $row = $result->fetch_assoc()) {
            $idpaye = $row['idpaye'];
        } else {
            $idpaye = "PY001"; // Valeur par défaut si aucun client
        }

        // Générer le nouvel ID client
        $new_idpaye = $payeModel->incrementPaiementId($idpaye);

        // Requête préparée pour éviter les injections SQL
        $sql = "INSERT INTO payer (idpaye, codecli,date_paie , montant) 
            VALUES (?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssss", $new_idpaye, $_POST['codecli'], $_POST['date_paie'], $_POST['montant']);

        if ($stmt->execute()) {
            echo "payement ajouté avec succès !";
        } else {
            echo "Erreur : " . $stmt->error;
        }
    }
    public static function read()
    {
        $payerModel = new PayerModel();
        $codecli = $_POST['nom_client'] ?? '';
        $order = $_POST['order'] ?? 'idpaye';
        $result = $payerModel->getpayes($codecli, $order);
        return $result;
    }
    public static function modify($idpaye)
    {
        $payerModel = new PayerModel();
        return $payerModel->getpaye($idpaye);
    }

    public static function update()
    {
        $payerModel = new PayerModel();
        $db = $payerModel->getDatabase();
        $sql = "UPDATE FROM payer SET codecli='$_POST[codecli]',
        datepaie='$_POST[datepaie]',montant='$_POST[montant]'
         WHERE idpaye='$_POST[idpaye]'";
        $result = $db->query($sql);
    }
    public static function delete()
    {
        $payerModel = new PayerModel();
        $db = $payerModel->getDatabase();
        $sql = "DELETE FROM payer WHERE idpaye='$_POST[idpaye]'";
        $result = $db->query($sql);
    }
}
