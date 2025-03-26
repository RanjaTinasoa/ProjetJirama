<?php
require_once __DIR__ . '/vendor/autoload.php';

// Initialiser mPDF
$mpdf = new \Mpdf\Mpdf();

ob_start();
include('facturePage');
// Contenu du div (HTML que tu veux convertir)
$html = ob_get_clean();

// Ajouter le HTML dans le PDF
$mpdf->WriteHTML($html);

// Enregistrer le fichier PDF sur le serveur
$mpdf->Output('public/factures/facture.pdf', 'F'); // 'F' pour sauvegarder sur le serveur

// Télécharger le fichier automatiquement
$mpdf->Output('facture.pdf', 'D'); // 'D' pour forcer le téléchargement
