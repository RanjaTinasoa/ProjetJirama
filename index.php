<?php

require_once "controllers/pagesController.php";
require_once "controllers/utilities.php";
require_once "controllers/crudController.php";
require_once "controllers/CompteurController.php";

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
            Crudcompteur::read();
            compteursPage();
            break;
        case "menu-ajout-compteur":
<<<<<<< HEAD
            #Crudcompteur::read();
=======
            showArray($_POST);
            Crudcompteur::create();
            Crudcompteur::read();
>>>>>>> 57d8373296ef3c04c48b57734f42289fc65d2354
            compteursPage();
        case "search-order-compteur":
            Crudcompteur::read();
            compteursPage();
        case "modifier-compteur":
            $compteur = $_POST["codecompteur"];
            Crudcompteur::read();
            modifierCompteur($compteur);
            /*  compteursPage();*/
            break;
        case "supprimer-compteur":
            $compteur = $_POST["codecompteur"];
            supprimerCompteur($compteur);
            #compteursPage();
            /*  showArray($_POST);*/
            break;


        case "compteurbrouillon":
            compteurRelevePage();
            break;

        /*----------------------------------------------------relevePage------------------------------------------------------------ */

        case "releve":
            releveElecDiv();
            break;

        default:
            throw new Exception("La page n'existe pas ! ");
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

