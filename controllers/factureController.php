<?php
require_once __DIR__ . "/../models/facture.php";
require_once "controllers/pagesController.php";
class Facture
{
    public static function viewFacture($codecli)
    {

        #$datas = array($mois,$nom,$date_presentation,$date_limite_paie,$quartier,$codecompteur);
        $facture_model = new FactureModel();
        $montant_total = $facture_model->get_total_releve_elec($codecli) + $facture_model->get_total_releve_eau($codecli);
        $datas = $facture_model->getDatas($codecli);
        $pu_elec = $facture_model->get_pu_elec($codecli);
        $pu_eau = $facture_model->get_pu_eau($codecli);
        $valeur_elec = $facture_model->get_valeur_elec($codecli);
        $valeur_eau = $facture_model->get_valeur_eau($codecli);
        facturePage();
    }
}
