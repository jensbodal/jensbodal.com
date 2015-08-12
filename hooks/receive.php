<?php
require('/var/www/scripts/jensbodal.com/keys.php');

$headers = getallheaders();
$hubSignature = $headers['X-Hub-Signature'];
 
// Split signature into algorithm and hash
list($algo, $hash) = explode('=', $hubSignature, 2);
 
// Get payload
$payload = file_get_contents('php://input');
 
// Calculate hash based on payload and the secret
$payloadHash = hash_hmac($algo, $payload, $cv_secret);
 
// Check if hashes are equivalent
if ($hash !== $payloadHash) {
    // Kill the script or do something else here.
    die('Bad secret');
}
 
// Your code here.
$data = json_decode($payload);

exec('/var/www/scripts/jensbodal.com/pdf.sh');

?>
