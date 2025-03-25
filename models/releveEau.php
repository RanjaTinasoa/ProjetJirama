<?php
require_once __DIR__ . "/../config/database.php";
class Eau
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
    public function getReleveEaux($nom = '', $order = 'codeEau')
    {
        $result = $this->db->query("SELECT * FROM releve_eau WHERE nom LiKE \"%$nom%\" ORDER BY $order");
        return $result->fetch_all();
    }
    /*    public function getUser($codecli){
        $result = $this->db->query("SELECT * FROM CLIENT WHERE codecli='$codecli'");
        return $result->fetch_assoc();
    }*/
    public function getReleveEau($codeEau)
    {
        $stmt = $this->db->prepare("SELECT * FROM releve_eau WHERE $codeEau = ?");
        $stmt->bind_param("s", $codeEau);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /* function incrementClientId($lastId)
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
        */
}
