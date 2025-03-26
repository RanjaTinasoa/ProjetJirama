<?php
require_once __DIR__ . '/vendor/autoload.php';

// Initialiser mPDF
$mpdf = new \Mpdf\Mpdf();

// Contenu du div (HTML que tu veux convertir)
$html = '
<div style="font-family: Arial; padding: 20px; border: 1px solid black;">
    <h1 style="color: blue;">Titre du document</h1>
    <p>Ceci est un exemple de contenu HTML converti en PDF.</p>
</div>
';

// Ajouter le HTML dans le PDF
$mpdf->WriteHTML($html);

// Enregistrer le fichier PDF sur le serveur
$mpdf->Output('mon_fichier.pdf', 'F'); // 'F' pour sauvegarder sur le serveur

// Télécharger le fichier automatiquement
$mpdf->Output('mon_fichier.pdf', 'D'); // 'D' pour forcer le téléchargement

?>
