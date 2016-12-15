<?php
$access_token = 'ecSSSh4xNn+Ku1HctPBfLytO+DX+nQiugW8Nkqopalvo3c33Auaho90Uct8SA8122v3N7KW+tVPMGV1VXSGqLFqKEM4XjQUtNXAwBbIBz/sWitLy0X5xZDDHmM/q40RBY3RlOaEyxI7kAtKM1JTviQdB04t89/1O/w1cDnyilFU=';
$url = 'https://api.line.me/v1/oauth/verify';
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;

