<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $experience = htmlspecialchars($_POST['experience']);
    $motivations = htmlspecialchars($_POST['motivations']);

    // Validation simple
    if (!empty($nom) && !empty($email) && !empty($telephone) && !empty($experience) && !empty($motivations)) {

        // Destinataire (vous pouvez mettre l'adresse e-mail de votre choix)
        $to = "email@sammartini.org";

        // Sujet de l'e-mail
        $subject = "Nouvelle candidature de " . $nom;

        // Corps de l'e-mail
        $message = "
            Vous avez reçu une nouvelle candidature : \n\n
            Nom et prénom : $nom\n
            Email : $email\n
            Téléphone : $telephone\n
            Expérience chorale : $experience\n
            Motivations : $motivations\n
        ";

        // En-têtes de l'e-mail (pour que l'e-mail soit bien formaté et que l'expéditeur soit l'adresse fournie par l'utilisateur)
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        // Envoyer l'e-mail
        if (mail($to, $subject, $message, $headers)) {
            echo "Votre message a bien été envoyé.";
        } else {
            echo "Une erreur est survenue lors de l'envoi de votre message.";
        }

    } else {
        // Message d'erreur si des champs sont manquants
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}
?>
