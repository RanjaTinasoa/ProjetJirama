<?php
require_once __DIR__ . "/../models/facture.php";
require_once "controllers/pagesController.php";
require_once __DIR__ . '/../vendor/autoload.php';


use Mpdf\Mpdf;

class Facture
{
    public static function viewFacture($codecli = null)
    {


        #$datas = array($mois,$nom,$date_presentation,$date_limite_paie,$quartier,$codecompteur);
        $facture_model = new FactureModel();
        $mois = $facture_model->getMonth($codecli);
        $montant_total = $facture_model->get_total_releve_elec($codecli) + $facture_model->get_total_releve_eau($codecli);
        $datas = $facture_model->getDatas($codecli);
        $pu_elec = $facture_model->get_pu_elec($codecli);
        $pu_eau = $facture_model->get_pu_eau($codecli);
        $valeur_elec = $facture_model->get_valeur_elec($codecli);
        $valeur_eau = $facture_model->get_valeur_eau($codecli);
        $compteur = $facture_model->get_compteur($codecli);

        $facture_datas = [
            "montant_total" => $montant_total,
            "datas" => $datas,
            "pu_elec" => $pu_elec,
            "pu_eau" => $pu_eau,
            "valeur_elec" => $valeur_elec,
            "valeur_eau" => $valeur_eau,
            "mois" => $mois,
            "compteur" => $compteur

        ];
        facturePage($facture_datas);
    }


    public static function imprimerPdf()
    {
        $i = $_POST['active_index'] ?? null;
        if (!is_numeric($i)) {
            die("Index invalide");
        }

        $reference = $_POST['codecli'] ?? '';
        $facture_model = new FactureModel();

        $montant_total = $facture_model->get_total_releve_elec($reference) + $facture_model->get_total_releve_eau($reference);
        $datas = $facture_model->getDatas($reference);
        $pu_elec = $facture_model->get_pu_elec($reference);
        $pu_eau = $facture_model->get_pu_eau($reference);
        $valeur_elec = $facture_model->get_valeur_elec($reference);
        $valeur_eau = $facture_model->get_valeur_eau($reference);
        $mois_data = $facture_model->getMonth($reference);
        $compteur = $facture_model->get_compteur($reference);

        $facture = [
            "montant_total" => $montant_total,
            "datas" => $datas,
            "pu_elec" => $pu_elec,
            "pu_eau" => $pu_eau,
            "valeur_elec" => $valeur_elec,
            "valeur_eau" => $valeur_eau,
            "mois" => $mois_data,
            "compteur" => $compteur
        ];

        if (!$facture) {
            die('Facture non trouvée');
        }

        $mois = $facture['mois'][$i][0];

        // Charger la bibliothèque mPDF
        require_once __DIR__ . "/../vendor/autoload.php";
        $mpdf = new \Mpdf\Mpdf([
            'debug' => true,
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
        $mpdf->showImageErrors = true;

        /*
        try {
            ob_start();
            include(__DIR__ . '/../views/uniqueInvoice.php');
            $html = ob_get_clean();
        } catch (Throwable $e) {
            echo "Erreur dans la vue : " . $e->getMessage();
            exit;
        }

        // ob_end_clean(); // Empêcher tout autre contenu parasite
        file_put_contents('debug.html', $html);
        $html = mb_convert_encoding($html, 'UTF-8', 'HTML-ENTITIES');
        // $html_content = file_get_contents('debug.html');
        //  $mpdf->WriteHTML($html_content);
*/
        $html = '
<div class="unique-facture-container">
    <div class="facture">
        <div class="table-facture">
            <div class="facture-card">
                <div class="titre">
                    <h1>JI<span>RO</span> SY RA<span>NO</span> MALA<span>GASY</span></h1>
                    <h2>Facture de : ' . htmlspecialchars($facture["mois"][$i][0]) . '</h2>
                </div>
            </div>

            <div class="donnees">
                <label>Titulaire : ' . htmlspecialchars($facture["datas"][$i][0]) . '</label>
                <label>Date présentation : ' . htmlspecialchars($facture["datas"][$i][3]) . '</label>
            </div>

            <div class="donnees">
                <label>Réf. client : ' . htmlspecialchars($facture["datas"][$i][1]) . '</label>
                <label>Date limite : ' . htmlspecialchars($facture["datas"][$i][4]) . '</label>
            </div>

            <div class="info">
                <label>Adresse : ' . htmlspecialchars($facture["datas"][$i][2]) . '</label>
                <label>Type : ' . htmlspecialchars($facture["datas"][$i][5]) . '</label>
                <label>N° compteur : ' . htmlspecialchars($facture["datas"][$i][6]) . '</label>
                <label>Réf. eau : ' . htmlspecialchars($facture["datas"][$i][7]) . ' | Réf. élec : ' . htmlspecialchars($facture["datas"][$i][8]) . '</label>
            </div>

            <div class="titre-tab">
                <h3>Détail facture</h3>
            </div>

            <div class="tab-facture">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Électricité</th>
                            <th>Eau</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PU (Ar)</td>
                            <td>' . htmlspecialchars($facture["pu_elec"]) . '</td>
                            <td>' . htmlspecialchars($facture["pu_eau"]) . '</td>
                        </tr>
                        <tr>
                            <td>Valeur</td>
                            <td>' . htmlspecialchars($facture["valeur_elec"][$i][0]) . '</td>
                            <td>' . htmlspecialchars($facture["valeur_eau"][$i][0]) . ' m<sup>3</sup></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>' . number_format((int)$facture["pu_elec"] * (int)$facture["valeur_elec"][$i][0], 0, ",", " ") . '</td>
                            <td>' . number_format((int)$facture["pu_eau"] * (int)$facture["valeur_eau"][$i][0], 0, ",", " ") . '</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="montant">
                <h3>Total à payer : ' . number_format($facture["montant_total"][$i][0], 0, ",", " ") . ' Ar</h3>
            </div>
        </div>
    </div>
</div>

<style>
  .unique-facture-container {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
}

.facture {
    background: #fff;
    padding: 20px;
    border-left: 3px solid orange;
    border-right: 3px solid orange;
    margin-bottom: 15px;
    border-radius: 8px 8px 0px 0px;
 
    font-size: 14px;
    border: 1px solid #ccc;
}

.titre h1 {
    text-align: center;
    font-size: 20px;
    text-transform: uppercase;
    margin-bottom: 5px;
    color: #000;
}

.titre span {
    color: orange;
}

.titre h2,
.titre h3 {
    text-align: center;
    font-size: 16px;
    font-weight: normal;
    margin-bottom: 10px;
}

/* Informations client */
.donnees {
    margin-bottom: 5px;
    font-size: 13px;
}

.donnees label {
    display: inline-block;
    width: 48%;
    vertical-align: top;
    margin-bottom: 5px;
}

.info label {
    display: block;
    font-size: 13px;
    margin-bottom: 3px;
}

label {
    font-weight: bold;
    display: block;
}

/* Titre du tableau */
.titre-tab {
    margin-top: 15px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
}

/* Tableau des détails */
.tab-facture {
    margin-top: 10px;
    text-align: center;
}

.tab-facture table {
    width: 100%;
    border-collapse: collapse;
}

.tab-facture th,
.tab-facture td {
    padding: 8px;
    text-align: center;
    border: 1px solid orange;
    background-color: #fff;
    font-size: 13px;
}

.tab-facture th {
    background-color: rgb(255, 140, 0);
    color: white;
}

/* Montant total */
.montant {
    margin-top: 15px;
    text-align: center;
}

.montant h3 {
    padding: 8px 15px;
    background-color: #ff9d00;
    color: white;
    font-size: 14px;
    font-weight: bold;
    display: inline-block;
}

</style>
';

        $mpdf->WriteHTML($html);

        // $mpdf->WriteHTML($html);

        $fileName = "{$reference}_{$mois}.pdf";
        $filePath = __DIR__ . "/../public/factures/" . $fileName;

        $mpdf->Output($filePath, "F");

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        readfile($filePath);
    }
}
