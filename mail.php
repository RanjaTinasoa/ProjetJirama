<?php
$to = "ranjatinasoa@gmail.com"; // L'adresse email du destinataire
$subject = "Test Email"; // Le sujet de l'email
$message = "Bonjour Ranja's Gari"; // Le contenu du message
$headers = "From: ekenarakotoson16@gmail.com"; // L'adresse email de l'expéditeur

// Envoi de l'email
if(mail($to, $subject, $message, $headers)) {
    echo "Email envoyé avec succès!";
} else {
    echo "Échec de l'envoi de l'email.";
}
?>
