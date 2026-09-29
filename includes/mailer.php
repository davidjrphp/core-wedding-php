<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

function rsvp_email_content(string $status, string $fullName): array {
  $name = htmlspecialchars($fullName, ENT_QUOTES);
  if ($status === 'acknowledged') {
    return [
      'subject' => "Your RSVP is confirmed – Ketty & Musa's Wedding",
      'body' => "<p>Hi {$name},</p>"
        . "<p>Thank you for your RSVP! We're delighted to confirm you'll be joining us to celebrate our wedding. We can't wait to see you there.</p>"
        . "<p>With love,<br>Ketty &amp; Musa</p>",
    ];
  }
  return [
    'subject' => "We received your RSVP – Ketty & Musa's Wedding",
    'body' => "<p>Hi {$name},</p>"
      . "<p>Thank you for letting us know. We're sorry you won't be able to join us, but we really appreciate you taking the time to respond. We'll be thinking of you on the day.</p>"
      . "<p>With love,<br>Ketty &amp; Musa</p>",
  ];
}

/**
 * Sends a best-effort RSVP status notification. Never throws — failures are
 * logged and swallowed so an SMTP hiccup can't block the admin's RSVP update.
 */
function send_rsvp_status_email(array $guest, string $status, array $config): bool {
  if (empty($guest['email'])) return false;

  $mail = $config['mail'] ?? [];
  if (empty($mail['smtp_user']) || empty($mail['smtp_pass'])) return false;

  ['subject' => $subject, 'body' => $body] = rsvp_email_content($status, $guest['full_name']);
  $altBody = trim(str_replace(['<br>', '</p><p>', '<p>', '</p>'], ["\n", "\n\n", '', ''], $body));
  $altBody = html_entity_decode(strip_tags($altBody), ENT_QUOTES);

  $mailer = new PHPMailer(true);
  try {
    $mailer->isSMTP();
    $mailer->Host = $mail['smtp_host'] ?? 'smtp.gmail.com';
    $mailer->Port = (int)($mail['smtp_port'] ?? 587);
    $mailer->SMTPAuth = true;
    $mailer->Username = $mail['smtp_user'];
    $mailer->Password = $mail['smtp_pass'];
    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailer->setFrom($mail['smtp_user'], $mail['from_name'] ?? 'Wedding RSVP (No Reply)');
    $mailer->addAddress($guest['email'], $guest['full_name']);
    $mailer->isHTML(true);
    $mailer->Subject = $subject;
    $mailer->Body = $body;
    $mailer->AltBody = $altBody;
    $mailer->send();
    return true;
  } catch (PHPMailerException $e) {
    error_log('RSVP notification email failed: ' . $mailer->ErrorInfo);
    return false;
  }
}
