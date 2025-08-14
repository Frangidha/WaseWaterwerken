<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST['naam']) ? htmlspecialchars(trim($_POST['naam'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['bericht']) ? htmlspecialchars(trim($_POST['bericht'])) : '';

    $to = 'info@wasewaterwerken.be';
    $subject = 'Nieuw bericht van contactformulier';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $body = "Naam: $name\nE-mail: $email\n\nBericht:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        echo 'Bedankt! We nemen snel contact op.';
    } else {
        http_response_code(500);
        echo 'Er is een fout opgetreden. Probeer opnieuw.';
    }
} else {
    http_response_code(405);
    echo 'Method not allowed';
}
?>
