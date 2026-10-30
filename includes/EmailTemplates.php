<?php
/** Branded email layout shared by team notifications and visitor confirmations. */
final class EmailTemplates
{
    public static function layout(string $title, string $content): string
    {
        return '<!doctype html><html lang="en"><head><meta charset="utf-8"><title>' . e($title) . '</title></head>'
            . '<body style="margin:0;background:#f6f4ee;font-family:Arial,sans-serif;color:#141413">'
            . '<table role="presentation" width="100%" cellspacing="0" cellpadding="0"><tr><td style="padding:32px 16px">'
            . '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;margin:auto;background:#fff;border-top:5px solid #f29102">'
            . '<tr><td style="padding:28px"><p style="font-size:13px;font-weight:bold;letter-spacing:2px">' . e(site('name')) . '</p>'
            . '<h1 style="font-size:26px;line-height:1.3">' . e($title) . '</h1><div style="font-size:15px;line-height:1.7">' . $content . '</div>'
            . '<p style="border-top:1px solid #eee;padding-top:20px;font-size:12px">' . e(site('name')) . ' &bull; <a href="' . e(abs_url('/')) . '">Visit our website</a></p>'
            . '</td></tr></table></td></tr></table></body></html>';
    }

    public static function confirmation(string $name, string $help): array
    {
        $first = explode(' ', $name)[0];
        $text = "Hi $first,\n\nThanks for getting in touch with " . site('name') . ". We have received your message and will reply within one business day.\n\nYour request: $help\n\n" . site('name');
        $html = self::layout('Thank you for your enquiry', '<p>Hi ' . e($first) . ',</p><p>Thanks for getting in touch with ' . e(site('name')) . '. We have received your message and will reply within one business day.</p><p><strong>Your request:</strong> ' . e($help) . '</p><p>We look forward to hearing more about your book.</p>');
        return [$html, $text];
    }
}