<?php
error_reporting(E_ALL);
require_once __DIR__ . "/vendor/autoload.php";
use \LINE\LINEBot;
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$access_token = 'ecSSSh4xNn+Ku1HctPBfLytO+DX+nQiugW8Nkqopalvo3c33Auaho90Uct8SA8122v3N7KW+tVPMGV1VXSGqLFqKEM4XjQUtNXAwBbIBz/sWitLy0X5xZDDHmM/q40RBY3RlOaEyxI7kAtKM1JTviQdB04t89/1O/w1cDnyilFU=';

$httpClient = new CurlHTTPClient($access_token);
$bot = new LINEBot($httpClient, ['channelSecret' => 'b8a878b50708ee96de46ed1a3fb4b505']);

//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

/*if (!is_null($events['events'])) {
	$replyToken = $event['replyToken'];
	$text = $event['message']['text'];	
	$response = $bot->replyText($replyToken, $text);
	
	if ($response->isSucceeded()) {
   		echo 'Succeeded!';
    		return;
	}

// Failed
	echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
}*/

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			//
			$textMessageBuilder = new TextMessageBuilder($text);
			
		
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			//$url = 'https://api.line.me/v2/bot/message/reply';
			
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			
			$response = $bot->replyText($replyToken, $textMessageBuilder);
			if ($response->isSucceeded()) {
				echo 'Succeeded!';
				return;
			}
			echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
			/*$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";*/
		}
	}
}
echo "OK";
