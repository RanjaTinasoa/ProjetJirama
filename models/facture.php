<?php
require_once __DIR__ . "/../config/database.php";
class FactureModel
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        return $this->db;
    }
    public function getDatabase()
    {
        return $this->db;
    }
    public function get_pu_eau($codecli)
    {
        $sql = "SELECT compt.pu FROM compteur compt where type='eau' and codecli='$codecli'";
        if ($this->db->query($sql)->fetch_all()) {
            $result = $this->db->query($sql)->fetch_all();
            $result = $result[0][0];
        } else {
            $result = 'aucun';
        }
        return $result;
    }
    public function get_pu_elec($codecli)
    {
        $sql = "SELECT compt.pu FROM compteur compt where type='électricité' and codecli='$codecli'";
        if ($this->db->query($sql)->fetch_all()) {
            $result = $this->db->query($sql)->fetch_all();
            $result = $result[0][0];
        } else {
            $result = 'aucun';
        }
        return $result;
    }

    public function get_compteur($codecli)
    {
        $sql = "SELECT compt.codecompteur FROM compteur compt where codecli='$codecli'";
        if ($this->db->query($sql)->fetch_all()) {
            $result = $this->db->query($sql)->fetch_all();
        } else {
            $result = 'aucun';
        }
        return $result;
    }
    public function get_valeur_eau($codecli)
    {
        $sql = "SELECT eau.valeur2 FROM releve_eau eau INNER JOIN compteur compt ON compt.codecompteur=eau.codecompteur
         where compt.codecli='$codecli' AND compt.type='eau' order by eau.date_limite_paie2 desc limit 3";
        if ($this->db->query($sql)->fetch_all()) {
            $result = $this->db->query($sql)->fetch_all();
            /* $result = $result[0][0];*/
        } else {
            $result = 'aucun';
        }
        return $result;
    }
    public function get_valeur_elec($codecli)
    {
        $sql = "SELECT elec.valeur1 FROM releve_elec elec INNER JOIN compteur compt ON compt.codecompteur=elec.codecompteur
         where compt.codecli='$codecli' AND compt.type='électricité' order by elec.date_limite_paie desc limit 3";
        if ($this->db->query($sql)->fetch_all()) {
            $result = $this->db->query($sql)->fetch_all();
            /* $result = $result[0][0];*/
        } else {
            $result = 'aucun';
        }
        return $result;
    }
    public function get_total_releve_elec($codecli)
    {
        $sql = "SELECT relec.valeur1*compt.pu as total from releve_elec relec INNER JOIN compteur compt 
        ON compt.codecompteur=relec.codecompteur INNER JOIN client cli on cli.codecli=compt.codecli
        where cli.codecli='$codecli' and compt.type='électricité' order by relec.date_limite_paie desc limit 3";
        if ($this->db->query($sql)->fetch_all()) {
            $res = $this->db->query($sql)->fetch_all();
            /* $res = $result[0][0];*/
        } else {
            $res = 0;
        }
        return $res;
    }



    public function get_total_releve_eau($codecli)
    {
        $sql = "SELECT reau.valeur2*compt.pu as total from releve_eau reau INNER JOIN compteur compt 
        ON compt.codecompteur=reau.codecompteur INNER JOIN client cli on cli.codecli=compt.codecli
        where cli.codecli='$codecli' and compt.type='eau' order by date_limite_paie2 desc limit 3";


        if ($this->db->query($sql)->fetch_all()) {
            $res = $this->db->query($sql)->fetch_all();
            /*   $res = $result[0][0];*/
        } else {
            $res = 0;
        }
        return $res;
    }
    public function getMonth($codecli)
    {
        /* $sql = "SET lc_time_names='fr_FR'";
        "SELECT MONTHNAME(reau.date_limite_paie2) from releve_eau reau join compteur c on c.codecompteur=reau.codecompteur
        join CLIENT cli ON cli.codecli=c.codecli WHERE cli.codecli='$codecli'order by date_limite_paie2 DESC LIMIT 3";*/
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $result = $this->db->query("
    SELECT MONTHNAME(reau.date_releve2) AS mois
    FROM releve_eau reau
    JOIN compteur c ON c.codecompteur = reau.codecompteur
    JOIN CLIENT cli ON cli.codecli = c.codecli
    WHERE cli.codecli = '$codecli'
    ORDER BY reau.date_limite_paie2 DESC
    LIMIT 3
")->fetch_all();
        return $result;
    }
    public function getDatas($codecli)
    {
        /* $sql = "SELECT c.nom, c.codecli, c.quartier, r.date_presentation,r.date_limite_paie,r.codecompteur,reau.codecompteur from compteur join client c on c.codecli=compteur.codecli
         join releve_eau reau on reau.codecompteur=compteur.codecompteur join releve_elec r on r.codecompteur=compteur.codecompteur where
          c.codecli='$codecli' order by date_limite_paie desc limit 3";
        $sql = "SELECT 
    c.nom, 
    c.codecli, 
    c.quartier, 
    COALESCE(re.date_presentation2, rel.date_presentation) AS date_presentation,
    LEAST(IFNULL(re.date_limite_paie2, '9999-12-31'), IFNULL(rel.date_limite_paie, '9999-12-31')) AS date_limite_paiement,
    co.codecompteur,
    re.codeEau AS codereleve_eau,
    rel.codeElec AS codereleve_elec
FROM client c
JOIN compteur co ON c.codecli = co.codecli
LEFT JOIN releve_eau re ON re.codecompteur = co.codecompteur
LEFT JOIN releve_elec rel ON rel.codecompteur = co.codecompteur
WHERE c.codecli = 'C0001'
AND (re.codeEau IS NOT NULL OR rel.codeElec IS NOT NULL)
GROUP BY c.codecli, co.codecompteur, re.codeEau, rel.codeElec
ORDER BY date_limite_paiement";
*/
        $sql = "SELECT 
    c.nom, 
    c.codecli, 
    c.quartier, 
    COALESCE(e.date_presentation2, l.date_presentation) AS date_presentation,
    COALESCE(e.date_limite_paie2, l.date_limite_paie) AS date_limite_paiement,
    CASE 
        WHEN e.codecompteur IS NOT NULL AND l.codecompteur IS NOT NULL THEN 'Eau+Elec'
        WHEN e.codecompteur IS NOT NULL THEN 'Eau'
        ELSE 'Electricité' 
    END AS type_facture,
    COALESCE(e.codecompteur, l.codecompteur) AS codecompteur,
    e.codeEau AS codereleve_eau,
    l.codeElec AS codereleve_elec
FROM client c
LEFT JOIN 
    (SELECT * FROM releve_eau WHERE codecompteur IN (SELECT codecompteur FROM compteur WHERE codecli = 'C0001')) e 
    ON e.codecompteur LIKE 'CMPE%'
LEFT JOIN 
    (SELECT * FROM releve_elec WHERE codecompteur IN (SELECT codecompteur FROM compteur WHERE codecli = 'C0001')) l 
    ON l.codecompteur LIKE 'CMPL%'
WHERE c.codecli = '$codecli'
AND (
    (ABS(DATEDIFF(e.date_limite_paie2, l.date_limite_paie)) <= 2) 
    OR (e.codeEau IS NOT NULL AND l.codeElec IS NULL)
    OR (e.codeEau IS NULL AND l.codeElec IS NOT NULL)
)
ORDER BY date_limite_paiement DESC";
        $result = $this->db->query($sql)->fetch_all();
        return $result;
    }
}
