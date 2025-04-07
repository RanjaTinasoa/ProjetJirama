<?php
/*
require_once __DIR__ . '/vendor/autoload.php';

// Initialiser mPDF
$mpdf = new \Mpdf\Mpdf();

ob_start();
include('views/facturePage.php');
// Contenu du div (HTML que tu veux convertir)
$html = ob_get_clean();

// Ajouter le HTML dans le PDF
$mpdf->WriteHTML($html);

// Enregistrer le fichier PDF sur le serveur
$mpdf->Output('public/factures/facture.pdf', 'F'); // 'F' pour sauvegarder sur le serveur

// Télécharger le fichier automatiquement
$nomFichier = 'facture-' . $reference . "-" . $mois . '.pdf';
$mpdf->Output($nomFichier, 'D'); // 'D' pour forcer le téléchargement
*/

require_once __DIR__ . '/vendor/autoload.php';

// Récupérer les valeurs passées par FactureController
$reference = $_POST['codecli'] ?? 'inconnu';
$mois = $_POST['mois'] ?? 'inconnu';

// Initialiser mPDF
$mpdf = new \Mpdf\Mpdf();

// Charger la facture en HTML
ob_start();
include('views/facturePage.php');
$html = ob_get_clean();

// Ajouter le HTML dans le PDF
$mpdf->WriteHTML($html);

// Définir le dossier et le nom du fichier
$dossier_factures = __DIR__ . '/public/factures/';
$nomFichier = 'facture-' . $reference . '-' . $mois . '.pdf';
$cheminFichier = $dossier_factures . $nomFichier;

// Enregistrer le fichier PDF sur le serveur
$mpdf->Output($cheminFichier, 'F'); // 'F' pour sauvegarde
