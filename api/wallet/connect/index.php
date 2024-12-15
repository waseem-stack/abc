<?php

include '../../../bot/config.php';
include '../../../bot/functions.php';

$MySQLi = new mysqli('localhost',$DB['username'],$DB['password'],$DB['dbname']);
$MySQLi->query("SET NAMES 'utf8'");
$MySQLi->set_charset('utf8mb4');
if ($MySQLi->connect_error) die;
function ToDie($MySQLi){
    $MySQLi->close();
    die;
}

function getAddress($address) {
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => 'https://dton.io/api/address/' . $address,
    CURLOPT_COOKIEJAR => "cooki.txt",
    CURLOPT_COOKIEFILE =>"cooki.txt",
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_AUTOREFERER => TRUE,
    CURLOPT_HEADER => 0,
    CURLOPT_FOLLOWLOCATION => TRUE,
    ]);
    $result = json_decode(curl_exec($curl), true);
    curl_close ($curl);
    return $result['mainnet']['base64urlsafe']['non_bounceable'];
}

$update = json_decode(file_get_contents('php://input'));
file_put_contents('a.txt', json_encode($update));

$payload = $update->proof->payload;

$get_user = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT * FROM `users` WHERE `walletOTP` = '{$payload}' LIMIT 1"));

if(!$get_user){
    http_response_code(300);
    echo json_encode(['ok' => false, 'message' => 'user not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}


$wallet = getAddress($update->wallet->address);

$MySQLi->query("UPDATE `users` SET `wallet` = '{$wallet}' WHERE `walletOTP` = '{$payload}' LIMIT 1");

if($get_user['walletReward'] == 0){
    $MySQLi->query("UPDATE `users` SET `score` = `score` + 15000, `walletReward` = 15000 WHERE `walletOTP` = '{$payload}' LIMIT 1");
}

$MySQLi->close();

echo '{"connected":false,"error_code":"already connected"}';