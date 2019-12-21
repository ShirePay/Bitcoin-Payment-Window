<?php

$configs = include('config.php');

// This page returns a status code 200 OK back to the ShirePay servers
// By responding with a status code 200, no other callbacks will be sent in regards to this Bitcoin Address

define('AES_128_ECB', 'aes-128-ecb');

// incoming encrypted content
$encryptedContent = file_get_contents("php://input");

// decrypt the incoming message
$decrypted = openssl_decrypt($encryptedContent, AES_128_ECB, $configs['secret'], 0);

// place your automated ordering mysql or stored procedure insert here
// use this to update Opencart, WooCommerce, Shopify etc

// you can view the decrypted json array within the ngrok http://localhost:4040/inspect/http inspection page
echo $decrypted;

