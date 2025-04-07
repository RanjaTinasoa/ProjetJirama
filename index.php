<?php

require_once "controllers/pagesController.php";
require_once "controllers/utilities.php";
require_once "controllers/crudController.php";
require_once "controllers/CompteurController.php";
require_once "controllers/factureController.php";
require_once "controllers/payerController.php";



//print_r($_GET);
//echo ($_GET["page"]);



try {
    if (empty($_GET['page'])) {
        $page = 'accueil';
    } else {
        $path = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $path[0];

        // Récupérer tous les paramètres GET pour les transmettre correctement
        // $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    }




    switch ($page) {
        case "accueil":
            homePage();
            break;
        case "connexion":
            require_once("views/loginPage.php");
            break;
        case "client":
            $users = Crud::read();
            clientsPage();

            break;
        case "ajouter-client":
            Crud::create();
            Crud::read();
            clientsPage();
            break;
        case "menu-ajout-client":
            Crud::read();
            clientsPage();
        case "modifier-client":
            $cli = $_POST["id"];
            Crud::read();
            modifierClient($cli);
            break;
        case "confirmer-modifier-client":
            /*showArray($_POST);*/
            crud::update();
            Crud::read();
            clientsPage();
            break;
        case "supprimer-client":
            $cli = $_POST["ide"];
            supprimerClient($cli);
            /*  showArray($_POST);*/
            break;
        case "confirme-supprimer-client":
            crud::delete();
            Crud::read();
            clientsPage();
            break;
        case "search-order-client":
            Crud::read();
            clientsPage();
            break;

        /*----------------------------------------------------compteurPage------------------------------------------------------------ */
        case "compteur":
            compteursPage();
            break;
        case "menu-ajout-compteur":
            Crudcompteur::create();
            compteursPage();
        case "search-order-compteur":
            compteursPage();
        case "modifier-compteur":
            $compteur = $_POST['codec'];
            modifierCompteur($compteur);
            /*  compteursPage();*/
        case "confirmer-modifier-compteur":
            Crudcompteur::update();
            compteursPage();
            break;
        case "supprimer-compteur":
            $compteur = $_POST["codecor"];
            supprimerCompteur($compteur);
            #compteursPage();
            /*  showArray($_POST);*/
            break;
        /*-----------------------------------------------------factturePage---------------------------------------------------------------*/
        case "facture":
            Facture::viewFacture($_POST['ide_f']);
            break;

        case "compteurbrouillon":
            compteurRelevePage();
            break;
        case "imprimer-pdf":

            //   showArray($_POST['active_index']);
            Facture::imprimerPdf();
            // Récupérer les données de la facture à partir de la requête POST
            //   $mois = $_POST['mois'] ?? '';
            //  $reference = $_POST['codecli'] ?? '';

            break;


        /*----------------------------------------------------relevePage------------------------------------------------------------ */

        case "releve":
            releveElecDiv();
            break;
        case "search-order-releve-elec":
            ReleveElec::read();
            releveElecDiv();
            break;

        case "ajouter-releve-elec":
            ReleveElec::create();
            releveElecDiv();
            break;
        case "modifier-releve-elec":
            modifierElec();
            break;
        case "confirmer-modifier-releve-elec":
            ReleveElec::update();
            ReleveElec::read();
            releveElecDiv();
            break;
        case "supprimer-releve-elec":
            supprimerElec();
            break;

        case "confirme-supprimer-releve-elec":
            ReleveElec::delete();
            ReleveElec::read();
            releveElecDiv();
            /*----releveEau----------------*/

            /*---------------------------------Eau------------------*/
        case "releve_eau":
            releveEeauDiv();
            break;
        case "search-order-releve-eau";
            Releve_Eau::read();
            releveEeauDiv();
            break;
        case "ajouter-releve-eau":
            Releve_Eau::create();
            Releve_Eau::read();
            releveEeauDiv();
            break;
        case "modifier-releve-eau":
            modifierEau();
            break;
        case "supprimer-releve-eau":
            supprimerEau();
            break;
        case "confirmer-modifier-releve-eau":
            Releve_Eau::update();
            Releve_Eau::read();
            releveEeauDiv();
            break;
        case "confirmer-supprimer-releve-eau":
            Releve_Eau::delete();
            releveEeauDiv();
            break;
        /*----------------------------------------Payer-------------------------------------------*/
        case "paiement":
            paiementPage();
            break;
        case "search-order-payer";
            PayerCrud::read();
            paiementPage();
        case "ajouter-paiement":
            PayerCrud::create();
            paiementPage();
            break;

        case "modifier-paiement":
            modifierPaiement();
            break;

        case "supprimer-paiement":
            supprimerPaiement();
            break;


        case "confirmer-modifier-paiement":
            PayerCrud::update();
            paiementPage();
            break;
        case "confirmer-supprimer-paiement":
            PayerCrud::delete();
            paiementPage();
            break;
        default:
            throw new Exception("La page n'existe pas ! ");
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
