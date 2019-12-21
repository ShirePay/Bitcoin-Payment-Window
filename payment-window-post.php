<?php

$configs = include('config.php');

define('AES_128_ECB', 'aes-128-ecb');

$description = $_GET['description'];
$symbol = $_GET['symbol'];
$requestedAmount= $_GET['requestedAmount'];

$data = '{"description":"'.$description.'", "symbol": "'.$symbol.'", "requestedAmount":'.$requestedAmount.'}';
$encrypted = openssl_encrypt($data, AES_128_ECB, $configs['secret'], 0);

$postData = array(
    'encrypted' => $encrypted
);

$url = $configs['shirepayapi'];

$options = array(
        'http' => array(
        'header'  => "Authorization: Bearer ".$configs['token']."\r\n",
        'method'  => 'POST',
        'Content-Type: application/json\r\n',
        'content' => json_encode($postData),
    )
);

$context  = stream_context_create($options);
$result = file_get_contents( $url, false, $context );
$json = json_decode($result);

$data = $json;

echo json_encode($json);
?>

