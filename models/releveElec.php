<?php
require_once __DIR__ . "/../config/database.php";
class Elec
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function getDatabase()
    {
        return $this->db;
    }
    public function getReleveElecs($nom = '', $order = 'rc.codeElec')
    {
        $result = $this->db->query("SELECT rc.*, c.codecli, c.nom FROM releve_elec rc join compteur co on co.codecompteur=rc.codecompteur
         join client c on c.codecli=co.codecli  WHERE rc.codeElec LiKE '%$nom%' OR rc.codecompteur LIKE '%$nom%' 
         OR c.codecli LIKE '%$nom%' OR c.nom LIKE '%$nom%' ORDER BY $order");
        return $result->fetch_all();
    }
    /*    public function getUser($codecli){
        $result = $this->db->query("SELECT * FROM CLIENT WHERE codecli='$codecli'");
        return $result->fetch_assoc();
    }*/
    public function getReleveElec($codeElec)
    {
        $stmt = $this->db->prepare("SELECT * FROM releve_elec WHERE codeElec = ?");
        $stmt->bind_param("s", $codeElec);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    function incrementElectId($lastId)
    {
        // Vérifier s'il y a un nombre dans la chaîne
        preg_match('/(\d+)$/', $lastId, $matches);

        if ($matches) {
            // Extraire le nombre et l'incrémenter
            $number = intval($matches[1]) + 1;

            // Remplacer l'ancien nombre par le nouveau, en conservant les zéros à gauche
            return preg_replace('/\d+$/', str_pad($number, strlen($matches[1]), '0', STR_PAD_LEFT), $lastId);
        } else {
            // Si aucun nombre trouvé, ajouter "001" à la fin
            return $lastId . "001";
        }
    }
}
