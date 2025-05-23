<?php
require_once __DIR__ . "/../config/database.php";
class Compteur
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
    public function getCompteur($codecli = '', $order = 'codecompteur')
    {
        $result = $this->db->query("SELECT compteur.*, c.nom FROM compteur join client c on c.codecli=compteur.codecli 
        WHERE c.nom LiKE '%$codecli%' OR compteur.codecompteur LIKE '%$codecli%' OR c.codecli LIKE '%$codecli%'  ORDER BY $order");
        return $result->fetch_all();
    }


    function incrementCompteurId($lastId)
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

    public function getCompteurById($codecompteur)
    {
        $result = $this->db->query("SELECT * FROM compteur WHERE codecompteur='$codecompteur'");
        return $result->fetch_assoc();
    }
}
