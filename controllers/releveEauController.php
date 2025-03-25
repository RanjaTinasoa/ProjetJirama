<?php
require_once __DIR__ . "/../models/releveEau.php";
require_once __DIR__ . "/../config/database.php";

class Releve_Eau
{

    public static function create()
    {
        $releve_eauModel = new Eau();
        $db = $releve_eauModel->getDatabase();
        $sql = 'INSERT INTO releve_eau(codeEau,codecompteur,valeur2,date_releve2,date_presentation2,date_limite_paie2) VALUES("$_POST[codeEau]","$_POST[codecompteur]","$_POST[valeur2]","$_POST[date_releve2]","$_POST[date_presentation2]","$_POST[date_limite_paie2]")';
        $result = $db->query($sql);
    }
    public static function read()
    {
        $releve_eauModel = new Eau();
        $db = $releve_eauModel->getDatabase();
        $sql = 'SELECT * FROM releve_eau';
        $result = $db->query($sql)->fetch_all();
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
        $sql = 'UPDATE FROM releve_eau SET codecompteur="$_POST[codecompteur]",
        valeur2="$_POST[valeur2]",date_releve2="$_POST[date_releve2]",
        date_presentation2="$_POST[date_presentation2]",date_limite_paie2="$_POST[date_limite_paie2]"
         WHERE codeEau="$_POST[codeEau]"';
        $result = $db->query($sql);
    }
    public static function delete()
    {
        $releve_eauModel = new Eau();
        $db = $releve_eauModel->getDatabase();
        $sql = 'DELETE FROM releve_eau WHERE codeEau="$_POST[codeEau]"';
        $result = $db->query($sql);
    }
}
