<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

function clean_input(string $value): string
{
    return trim(strip_tags($value));
}

$name = clean_input((string)($_POST['name'] ?? ''));
$phone = clean_input((string)($_POST['phone'] ?? ''));
$emailRaw = trim((string)($_POST['email'] ?? ''));
$email = filter_var($emailRaw, FILTER_VALIDATE_EMAIL) ? $emailRaw : '';
$project = clean_input((string)($_POST['project'] ?? ''));
$message = clean_input((string)($_POST['message'] ?? ''));

// Honeypot anti-spam: bot usually fills hidden inputs.
$website = trim((string)($_POST['website'] ?? ''));
if ($website !== '') {
    http_response_code(400);
    exit('Spam detected');
}

if ($name === '' || $email === '' || $message === '') {
    http_response_code(400);
    exit('Uzupełnij wymagane pola formularza.');
}

$to = 'natalia.swebo@gmail.com';
$subject = 'Nowa wiadomość ze strony GREENCRAFT';

$body = "Imie i nazwisko: {$name}\n";
$body .= "Telefon: {$phone}\n";
$body .= "E-mail: {$email}\n";
$body .= "Rodzaj projektu: {$project}\n\n";
$body .= "Wiadomosc:\n{$message}\n";

// IMPORTANT: use your real domain mailbox in production.
$fromAddress = 'kontakt@twojadomena.pl';
$encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
$headers = [
    'From: GREENCRAFT <' . $fromAddress . '>',
    'Reply-To: ' . $email,
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
];

$sent = mail($to, $encodedSubject, $body, implode("\r\n", $headers));
if ($sent) {
    header('Location: /?sent=1#kontakt');
    exit;
}

http_response_code(500);
echo 'Nie udalo sie wyslac wiadomosci. Sprobuj ponownie pozniej.';
