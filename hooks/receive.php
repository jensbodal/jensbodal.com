<!-- Taken from http://isometriks.com/verify-github-webhooks-with-php -->

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
 
// executable code here

// currently don't care about the json data from the github POST request
$data = json_decode($payload);

// grab most recent pdf and generate thumbnail
exec('/var/www/scripts/jensbodal.com/pdf.sh');

?>
