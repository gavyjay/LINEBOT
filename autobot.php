<?php
// /callback/index.php
// Show all errors for testing
error_reporting(E_ALL);

// SDK is installed via composer
require_once __DIR__ . "/vendor/autoload.php";

use \LINE\LINEBot;
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;



// Set these
define("LINEBOT_CHANNEL_SECRET", 'b8a878b50708ee96de46ed1a3fb4b505');
define("LINEBOT_CHANNEL_TOKEN", 'ecSSSh4xNn+Ku1HctPBfLytO+DX+nQiugW8Nkqopalvo3c33Auaho90Uct8SA8122v3N7KW+tVPMGV1VXSGqLFqKEM4XjQUtNXAwBbIBz/sWitLy0X5xZDDHmM/q40RBY3RlOaEyxI7kAtKM1JTviQdB04t89/1O/w1cDnyilFU=');



$httpClient = new CurlHTTPClient(LINEBOT_CHANNEL_TOKEN);
$bot = new LINEBot($httpClient, ['channelSecret' => LINEBOT_CHANNEL_SECRET]);

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
$replyToken = $event['replyToken'];
$response = $bot->replyText($replyToken, 'hello!');

?>
