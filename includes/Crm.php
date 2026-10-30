<?php
/** Server-side adapter for The Active Solutions custom-lead API. */
final class Crm
{
    /** @return array{0:bool,1:?string,2:string} */
    public static function send(string $source, array $fields, ?string $pageUrl = null): array
    {
        $base = rtrim((string)cfg('crm.base_url', ''), '/');
        $key = (string)cfg('crm.api_key', '');
        $parts = parse_url($base);
        if (!$parts || ($parts['scheme'] ?? '') !== 'https' || empty($parts['host'])
            || isset($parts['user']) || isset($parts['pass']) || !preg_match('/^[a-f0-9]{64}$/', $key)) {
            return [false, null, 'CRM server configuration is missing or invalid.'];
        }
        if (!function_exists('curl_init')) return [false, null, 'PHP cURL extension is required.'];
        $data = ['form_type' => $source, 'fields' => $fields];
        if ($pageUrl !== null) $data['url'] = $pageUrl;
        $payload = json_encode(['type' => 'form', 'source' => 'php-' . $source . '-form', 'data' => $data], JSON_INVALID_UTF8_SUBSTITUTE);
        $endpoint = 'https://' . $parts['host'] . (isset($parts['port']) ? ':' . $parts['port'] : '') . '/api/custom-lead';
        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Accept: application/json', 'x-crm-api-key: ' . $key],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ]);
        $body = curl_exec($ch);
        $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $networkError = curl_errno($ch);
        curl_close($ch);
        // Do not log response bodies or headers: they may contain personal data or secrets.
        if ($body === false || $networkError) return [false, null, 'CRM network error (' . $networkError . ').'];
        if ($status < 200 || $status >= 300) return [false, null, 'CRM HTTP ' . $status . '.'];
        $result = json_decode($body, true);
        if (!is_array($result) || ($result['success'] ?? null) !== true || !is_string($result['lead_id'] ?? null) || $result['lead_id'] === '') {
            return [false, null, 'Unexpected CRM response.'];
        }
        return [true, $result['lead_id'], ''];
    }

    /** Only forward a referrer from this website, without credentials or a fragment. */
    public static function pageUrl(string $referrer): ?string
    {
        $page = parse_url($referrer);
        $origin = parse_url(site_url());
        if (!$page || !$origin || !in_array($page['scheme'] ?? '', ['http', 'https'], true)
            || isset($page['user']) || isset($page['pass'])
            || strtolower($page['host'] ?? '') !== strtolower($origin['host'] ?? '')
            || $page['scheme'] !== ($origin['scheme'] ?? '')
            || ($page['port'] ?? ($page['scheme'] === 'https' ? 443 : 80)) !== ($origin['port'] ?? (($origin['scheme'] ?? '') === 'https' ? 443 : 80))) return null;
        return explode('#', $referrer, 2)[0];
    }
}