<?php
$ch = curl_init('http://127.0.0.1:8000/password/email');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'email' => 'test@example.com',
    '_token' => 'test',
]));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "HTTP Code: $httpCode\n";
if ($httpCode >= 400) {
    echo "Response: " . substr($response, 0, 500) . "\n";
}
curl_close($ch);
