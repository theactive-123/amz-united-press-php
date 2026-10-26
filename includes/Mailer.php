<?php
/**
 * Sends email through SMTP (PHPMailer) or PHP's mail() function, depending on includes/config.php.
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

final class Mailer
{
    /** @return array{0:bool,1:string} [success, error message] */
    public static function send(string $toEmail, string $toName, string $subject, string $html, string $text, ?string $replyTo = null, ?string $replyName = null): array
    {
        $m = cfg('mail');
        if (empty($m['enabled'])) return [false, 'Email sending is switched off in config.php.'];

        $lib = __DIR__ . '/lib/PHPMailer/';
        if (!is_file($lib . 'PHPMailer.php')) return [false, 'PHPMailer files are missing from includes/lib/PHPMailer.'];
        require_once $lib . 'Exception.php';
        require_once $lib . 'PHPMailer.php';
        require_once $lib . 'SMTP.php';

        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            if (($m['driver'] ?? 'smtp') === 'smtp') {
                $mail->isSMTP();
                $mail->Host       = $m['host'];
                $mail->Port       = (int)$m['port'];
                $mail->SMTPAuth   = ($m['username'] ?? '') !== '';
                $mail->Username   = $m['username'] ?? '';
                $mail->Password   = $m['password'] ?? '';
                $enc = strtolower((string)($m['encryption'] ?? ''));
                $mail->SMTPSecure = $enc === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : ($enc === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : '');
                $mail->SMTPAutoTLS = $enc !== '';
                $mail->Timeout    = 15;
                if (!empty($m['debug'])) { $mail->SMTPDebug = 2; $mail->Debugoutput = function ($s) { @file_put_contents(ROOT . '/storage/mail-error.log', '[' . date('c') . '] ' . trim($s) . "\n", FILE_APPEND); }; }
            } else {
                $mail->isMail();
            }
            $mail->setFrom($m['from_email'], $m['from_name']);
            $mail->addAddress($toEmail, $toName);
            if ($replyTo) $mail->addReplyTo($replyTo, $replyName ?: $replyTo);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $html;
            $mail->AltBody = $text;
            $mail->send();
            return [true, ''];
        } catch (MailException $ex) {
            return [false, $mail->ErrorInfo ?: $ex->getMessage()];
        } catch (\Throwable $ex) {
            return [false, $ex->getMessage()];
        }
    }
}
