<?php
require_once __DIR__ ."/../config/database.php";
class FactureModel{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance();
        return $this->db;
    }
    public function getDatabase(){
        return $this->db;
    }
    public function get_pu_eau($codecli){
        $sql="SELECT compt.pu FROM compteur compt where type='eau' and codecli='$codecli'";
        if ($this->db->query($sql)->fetch_all()){
            $result = $this->db->query($sql)->fetch_all();
            $result = $result[0][0];
            
        }
        else{
            $result='aucun';
        }
        return $result;
    }
    public function get_pu_elec($codecli){
        $sql="SELECT compt.pu FROM compteur compt where type='electricite' and codecli='$codecli'";
        if ($this->db->query($sql)->fetch_all()){
            $result = $this->db->query($sql)->fetch_all();
            $result = $result[0][0];
            
        }
        else{
            $result='aucun'; 
        }
        return $result;
    }
    public function get_valeur_eau($codecli){
        $sql = "SELECT eau.valeur2 FROM releve_eau eau INNER JOIN compteur compt ON compt.codecompteur=eau.codecompteur
         where compt.codecli='$codecli' AND compt.type='eau' order by eau.date_limite_paie2 desc limit 3";
        if ($this->db->query($sql)->fetch_all()){
            $result = $this->db->query($sql)->fetch_all();
            $result = $result[0][0];
        }
        else{
            $result='aucun';
        }
        return $result;
    }
    public function get_valeur_elec($codecli){
        $sql = "SELECT elec.valeur1 FROM releve_elec elec INNER JOIN compteur compt ON compt.codecompteur=elec.codecompteur
         where compt.codecli='$codecli' AND compt.type='electricite' order by elec.date_limite_paie desc limit 3";
        if ($this->db->query($sql)->fetch_all()){
            $result = $this->db->query($sql)->fetch_all();
            $result = $result[0][0];
        }
        else{
            $result='aucun';
        }
        return $result;
    }
    public function get_total_releve_elec($codecli){
        $sql = "SELECT relec.valeur1*compt.pu as total from releve_elec relec INNER JOIN compteur compt 
        ON compt.codecompteur=relec.codecompteur INNER JOIN client cli on cli.codecli=compt.codecli
        where cli.codecli='$codecli' and compt.type='electricite' order by relec.date_limite_paie desc limit 3";
        if ($this->db->query($sql)->fetch_all()){
        $result = $this->db->query($sql)->fetch_all();
        $res = $result[0][0];
        }
        else{
            $res = 0;
        }
        return $res;
    }
    
    

    public function get_total_releve_eau($codecli){
        $sql = "SELECT reau.valeur2*compt.pu as total from releve_eau reau INNER JOIN compteur compt 
        ON compt.codecompteur=reau.codecompteur INNER JOIN client cli on cli.codecli=compt.codecli
        where cli.codecli='$codecli' and compt.type='eau' order by date_limite_paie2 desc limit 3";

        
    if ($this->db->query($sql)->fetch_all()){
    $result = $this->db->query($sql)->fetch_all();
    $res = $result[0][0];
    }
    else{
        $res = 0;
    }
    return $res;
}
    public function getDatas($codecli){
        $sql = "SELECT c.nom, c.codecli, c.quartier, r.date_presentation,r.date_limite_paie,r.codecompteur,reau.codecompteur from compteur join client c on c.codecli=compteur.codecli
         join releve_eau reau on reau.codecompteur=compteur.codecompteur join releve_elec r on r.codecompteur=compteur.codecompteur where
          codecli='$codecli' order by date_limite_paie desc limit 3";
          $result = $this->db->query($sql)->fetch_all();
    }
}


//----------------test-----------------//
    $instance = new FactureModel();
    $result = $instance->get_pu_elec('cli1');
    echo($result);

    


