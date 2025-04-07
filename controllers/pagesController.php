<?php
require_once "controllers/utilities.php";
require_once __DIR__ . "/../models/user.php";
/*require_once __DIR__ . "/../models/releveElec.php";*/
require_once __DIR__ . "/releveElecController.php";
require_once __DIR__ . "/CompteurController.php";
require_once __DIR__ . "/releveEauController.php";





function homePage()
{

    $datas_page = [
        "description" => "page home",
        "title" => "page d'accueil",
        "view" => "views/homePage.php",
        // "content" => ob_get_clean(),
        "layout" => "views/components/layout.php",

    ];
    drawPage($datas_page);
}

function clientPage($divActive, $plus = "")
{
    $searchValue = $_POST['nom_client'] ?? $_SESSION['nom_recherche'] ?? "";
    $userss =  Crud::read();
    $datas_page = [
        "description" => "page des clients",
        "title" => "page clients",
        "view" => "views/clientsPage.php",
        // "content" => ob_get_clean(),
        "layout" => "views/components/layout.php",
        "divActive" => $divActive,
        "user" => $plus,
        "users" => $userss,
        "PostNom" => $searchValue


    ];
    drawPage($datas_page);
}

function clientsPage()
{

    $divActive = 'div1';
    clientPage($divActive);
}

function modifierClient($cli)
{
    $codecli = crud::modify($cli);
    $divActive = 'div3';
    clientPage($divActive, $codecli);
}

function supprimerClient($cli)
{
    $divActive = 'div4';
    $user = ['codecli' => $cli]; // Passe un tableau associatif
    clientPage($divActive, $user);
}

function clientsPage2()
{
    $divActive = 'div2'; // Récupération du paramètre div
    clientPage($divActive);
}



function compteurRelevePage()
{

    $datas_page = [
        "description" => "page des compteur et relevé",
        "title" => "page de compteur et relevé ",
        "view" => "views/compteurRelevePage.php",
        // "content" => ob_get_clean(),
        "layout" => "views/components/layout.php",

    ];
    drawPage($datas_page);
}

function compteurPage($divActive, $plus = "")
{
    $compteurs =  Crudcompteur::read();
    $datas_page = [
        "description" => "page des compteur",
        "title" => "page Compteur",
        "view" => "views/compteurPage.php",
        "layout" => "views/components/layout.php",
        "divActive" => $divActive,
        "compteur" => $plus,
        "compteurs" => $compteurs


    ];
    drawPage($datas_page);
}

function compteursPage()
{
    $dicvActive = 'div1';
    compteurPage($dicvActive);
}

function modifierCompteur($compteur)
{

    $codecompteur = Crudcompteur::modify($compteur);
    $divActive = 'div3';
    compteurPage($divActive, $codecompteur);
}

function supprimerCompteur($compteur)
{
    $divActive = 'div1';
    $compteur = ['codecompteur' => $compteur]; // Passe un tableau associatif
    Crudcompteur::delete();
    compteurPage($divActive,);
}

function relevePage($divActive, $divPrincipal, $type_releve, $plus = "")
{
    $datas_page = [
        "description" => "page des relevés",
        "title" => "page relevés",
        "view" => "views/relevePage.php",
        // "content" => ob_get_clean(),
        "layout" => "views/components/layout.php",
        "divActive" => $divActive,
        "divPrincipal" => $divPrincipal,
        "releve" => $plus,
        "list" => $type_releve


    ];
    drawPage($datas_page);
}

function releveElecDiv()
{
    $type_releve = ReleveElec::read();
    $divPrincipal = 'divElec';
    $divActive = 'div1';
    relevePage($divActive, $divPrincipal, $type_releve);
}

function releveEeauDiv()
{
    $type_releve = Releve_Eau::read();
    $divPrincipal = 'divEau';
    $divActive = 'div1';
    relevePage($divActive, $divPrincipal, $type_releve);
}


function modifierElec()
{
    $type_releve = ReleveElec::read();
    # $type_releve = "";
    $Elec = ReleveElec::modify($_POST['codeEl1']);
    $divPrincipal = 'divElec';
    $divActive = 'div3';

    relevePage($divActive, $divPrincipal, $type_releve, $Elec);
}

function supprimerElec()
{
    $divActive = 'div4';
    $Elec = ['codeElec' => $_POST['codeEl']]; // Passe un tableau associatif
    $divPrincipal = 'divElec';
    $type_releve = ReleveElec::read();

    relevePage($divActive, $divPrincipal, $type_releve, $Elec);
}

/*-------------------------------ReleveEau----------------------------------------------------------*/


function modifierEau()
{
    $type_releve = Releve_Eau::read();
    $Eau = Releve_Eau::modify($_POST['codeEau']);
    $divPrincipal = 'divEau';
    $divActive = 'div3';

    relevePage($divActive, $divPrincipal, $type_releve, $Eau);
}

function supprimerEau()
{
    $divActive = 'div4';
    $Eau = ['codeEau' => $_POST['codeEau']]; // Passe un tableau associatif
    $divPrincipal = 'divEau';
    $type_releve = Releve_Eau::read();

    relevePage($divActive, $divPrincipal, $type_releve, $Eau);
}

/*----------------------------------facturePage------------------------------------------------------*/
function facturePage($plus = "")
{
    $datas_page = [
        "description" => "page facture",
        "title" => "page des factures",
        "view" => "views/facturePage.php",
        // "content" => ob_get_clean(),
        "layout" => "views/components/layout.php",
        "facture" => $plus

    ];
    //showArray($datas_page['facture']);
    drawPage($datas_page);
}


/*----------------------------PayerPage--------------------------------------------------------*/
function payerPage($divActive, $plus = "")
{

    $paiements =  PayerCrud::read();
    $datas_page = [
        "description" => "page des paiement",
        "title" => "page paiement",
        "view" => "views/payerPage.php",
        "layout" => "views/components/layout.php",
        "divActive" => $divActive,
        "paie" => $plus,
        "paiements" => $paiements


    ];
    drawPage($datas_page);
}

function paiementPage()
{
    $divActive = 'div1';
    payerPage($divActive);
}

function modifierPaiement()
{
    $dicvActive = "div3";
    $codepaie = PayerCrud::modify($_POST['id']);
    /*payerPage($dicvActive, $codepaie);*/
    $paiements =  PayerCrud::read();
    $datas_page = [
        "description" => "page des paiement",
        "title" => "page paiement",
        "view" => "views/payerPage.php",
        "layout" => "views/components/layout.php",
        "divActive" => $dicvActive,
        "paie" => $codepaie,
        "paiements" => $paiements


    ];
    drawPage($datas_page);
}

function supprimerPaiement()
{
    $divActive = 'div4';
    $idpaye = ['idpaye' => $_POST['ide']]; // Passe un tableau associatif
    payerPage($divActive, $idpaye);
}
