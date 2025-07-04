<?php
function generate_jwt($payload, $secret = 'rahasia') {
    $header = base64_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
    $body = base64_encode(json_encode($payload));
    $signature = hash_hmac('sha256', "$header.$body", $secret, true);
    return "$header.$body." . base64_encode($signature);
}

function verify_jwt($jwt, $secret = 'rahasia') {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) return false;

    list($header, $body, $signature) = $parts;
    $valid_sig = base64_encode(hash_hmac('sha256', "$header.$body", $secret, true));
    if ($valid_sig !== $signature) return false;

    return json_decode(base64_decode($body), true);
}
?>
