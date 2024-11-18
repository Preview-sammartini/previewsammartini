<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $sujet = trim(htmlspecialchars($_POST['sujet']));
    $message = trim(htmlspecialchars($_POST['message']));

    // Adresse email où les messages seront envoyés
    $to = "email@sammartini.org"; // Remplacez par votre adresse e-mail
    $subject = "Nouveau message de contact: " . $sujet;

    // Construire le message du mail
    $message_content = "Nom: $name\nEmail: $email\nSujet: $sujet\nMessage:\n$message";

    // Headers pour l'email
    $headers = "MIME-Version: 1.0\r\n"; // Ajout de l'en-tête MIME-Version
    $headers .= "From: no-reply@sammartini.org\r\n"; // Utilisez une adresse cohérente
    $headers .= "Reply-To: $email\r\n"; // Pour que la réponse aille vers l'email de l'utilisateur
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envoyer l'email au destinataire principal
    if (mail($to, $subject, $message_content, $headers)) {
        // Maintenant, envoyez une copie à l'utilisateur
        $user_subject = "Copie de votre message: " . $sujet;
        $user_message_content = "Bonjour $name,\n\nMerci d'avoir contacté notre service.\nVoici une copie de votre message:\n\n$message_content"; // Personnalisation du message pour l'utilisateur
        
        $user_headers = "MIME-Version: 1.0\r\n";
        $user_headers .= "From: no-reply@sammartini.org\r\n"; // Adresse de l'expéditeur
        $user_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoyer l'email à l'utilisateur
        if (mail($email, $user_subject, $user_message_content, $user_headers)) {
            echo "Message envoyé avec succès. Une copie a été envoyée à votre adresse email.";
        } else {
            echo "Message envoyé avec succès, mais une erreur est survenue lors de l'envoi de la copie.";
        }
    } else {
        echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    }
} else {
    echo "Méthode non autorisée.";
}
