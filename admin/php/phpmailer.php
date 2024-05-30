<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure la classe PHPMailer
require 'admin/php/PHPMailer-master/src/PHPMailer.php';
require 'admin/php/PHPMailer-master/src/Exception.php';
require 'admin/php/PHPMailer-master/src/SMTP.php';

include("./php/config.php");

// Sélectionner les contacts à contacter depuis la base de données
$sql = "SELECT * FROM les_contacts WHERE envoye = 0"; // Supposons que vous ayez une colonne "envoye" qui est définie sur 0 si l'e-mail n'a pas été envoyé
$result = $conn->query($sql);

// Vérifier s'il y a des contacts à contacter
if ($result->num_rows > 0) {
    // Configuration de PHPMailer
    $mail = new PHPMailer(true); // True active les exceptions

    try {
        // Paramètres SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'ma234961@gmail.com'; // Votre adresse e-mail Gmail
        $mail->Password = 'NEYMAR23119'; // Mot de passe de votre adresse e-mail Gmail
        $mail->SMTPSecure = 'tls'; // Chiffrement TLS
        $mail->Port = 587; // Port SMTP

        // Destinataire
        $mail->setFrom('psycho11path@gmail.com', 'ENIGJR');
        $mail->addReplyTo('psycho11path@gmail.com', 'ENIGJR');

        // Parcourir les résultats de la requête SQL
        while ($row = $result->fetch_assoc()) {
            $mail->addAddress($row['email']); // Ajouter le destinataire

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Sujet de votre e-mail';
            $mail->Body = 'Contenu de votre e-mail'; // Vous pouvez personnaliser le contenu ici

            // Envoyer l'e-mail
            $mail->send();

            // Marquer l'e-mail comme envoyé dans la base de données
            $contactId = $row['id'];
            $sqlUpdate = "UPDATE les_contacts SET envoye = 1 WHERE id = $contactId";
            $conn->query($sqlUpdate);

            // Effacer les adresses
            $mail->clearAddresses();
        }

        echo 'Tous les e-mails ont été envoyés avec succès.';
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
    }
} else {
    echo "Aucun contact à contacter.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
