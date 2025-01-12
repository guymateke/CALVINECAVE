<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation des champs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide.";
        exit;
    }

    // Préparation de l'email
    $to = "gestioncalvinecave2025@gmail.com"; // Remplacez par votre adresse email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $emailBody = "Vous avez reçu un nouveau message depuis votre formulaire de contact :\n\n";
    $emailBody .= "Nom : $name\n";
    $emailBody .= "Email : $email\n";
    $emailBody .= "Sujet : $subject\n";
    $emailBody .= "Message :\n$message\n";

    // Envoi de l'email
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "Votre message a été envoyé avec succès. Merci de nous avoir contactés.";
    } else {
        echo "Une erreur est survenue lors de l'envoi de votre message. Veuillez réessayer.";
    }
} else {
    // Rediriger vers la page principale si la requête n'est pas POST
    header("Location: /");
    exit;
}
?>
