<?php
// Run from CLI only. Transport is mocked; nothing is sent to the live CRM.
namespace AmzCrmTests;
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require dirname(__DIR__) . '/includes/functions.php';
$GLOBALS['CONFIG'] = ['crm' => ['base_url' => 'https://crm.example.test', 'api_key' => str_repeat('a', 64)], 'site_url' => 'https://press.example.test'];
$transport = ['status' => 200, 'body' => '{"success":true,"lead_id":"test-123"}', 'error' => 0];
function curl_init($url) { $GLOBALS['test_url'] = $url; return new \stdClass(); }
function curl_setopt_array($ch, $options) { $GLOBALS['test_options'] = $options; return true; }
function curl_exec($ch) { return $GLOBALS['transport']['body']; }
function curl_getinfo($ch, $key) { return $GLOBALS['transport']['status']; }
function curl_errno($ch) { return $GLOBALS['transport']['error']; }
function curl_close($ch) {}
eval('namespace AmzCrmTests;' . substr(file_get_contents(dirname(__DIR__) . '/includes/Crm.php'), 5));
$checks = 0;
function check($ok, $message) { global $checks; ++$checks; if (!$ok) throw new \RuntimeException($message); }
foreach (['home', 'contact', 'quote', 'service', 'landing'] as $source) {
    [$ok, $id] = Crm::send($source, ['name' => 'Test', 'email' => 'test@example.test', 'help' => 'Editing', 'project' => '<test>', 'utm_source' => 'qa'], 'https://press.example.test/contact');
    check($ok && $id === 'test-123', $source . ' delivery');
    $payload = json_decode($GLOBALS['test_options'][CURLOPT_POSTFIELDS], true);
    check($GLOBALS['test_url'] === 'https://crm.example.test/api/custom-lead', 'Exact endpoint');
    check($payload['type'] === 'form' && $payload['source'] === 'php-' . $source . '-form' && $payload['data']['form_type'] === $source, 'Payload contract');
    check($payload['data']['fields']['utm_source'] === 'qa' && $payload['data']['url'] === 'https://press.example.test/contact', 'Attribution');
    check(in_array('x-crm-api-key: ' . str_repeat('a', 64), $GLOBALS['test_options'][CURLOPT_HTTPHEADER], true), 'Auth header');
    check($GLOBALS['test_options'][CURLOPT_SSL_VERIFYPEER] === true && $GLOBALS['test_options'][CURLOPT_FOLLOWLOCATION] === false, 'Secure transport');
}
foreach (['{}', '{"success":false,"lead_id":"test"}', '{"success":true,"lead_id":123}', '{"success":true,"lead_id":""}', '<html>Bad gateway</html>'] as $body) {
    $transport['body'] = $body;
    check(Crm::send('contact', [])[0] === false, 'Reject invalid response');
}
$transport['body'] = '{"success":true,"lead_id":"test"}';
$transport['status'] = 401;
check(Crm::send('contact', [])[0] === false, 'Reject unauthorized response');
$transport['status'] = 500;
check(Crm::send('contact', [])[0] === false, 'Reject server failure');
$transport['status'] = 200;
$transport['error'] = 28;
check(Crm::send('contact', [])[0] === false, 'Reject timeout');
$transport['error'] = 0;
$GLOBALS['CONFIG']['crm']['api_key'] = '';
check(Crm::send('contact', [])[0] === false, 'Reject missing credentials');
check(Crm::pageUrl('https://press.example.test/contact?utm_source=test#form') === 'https://press.example.test/contact?utm_source=test', 'Strip fragment');
foreach (['https://other.example/contact', 'http://press.example.test/contact', 'https://user:pass@press.example.test/contact', 'https://press.example.test:444/contact', '/contact', 'javascript:alert(1)'] as $url) {
    check(Crm::pageUrl($url) === null, 'Reject unsafe or foreign referrer');
}
require dirname(__DIR__) . '/includes/EmailTemplates.php';
$GLOBALS['DATA']['site'] = ['name' => 'AMZ United Press'];
$GLOBALS['CONFIG']['base_path'] = '';
[$html, $text] = \EmailTemplates::confirmation('<img>', '<script>');
check(str_contains($html, '&lt;img&gt;') && str_contains($html, '&lt;script&gt;'), 'Escape email input');
check(!str_contains($html, '<script>') && str_contains($text, 'one business day'), 'Safe confirmation template');
echo "Passed $checks CRM and email checks. No live leads or emails sent.\n";