<?php
require('vendor/autoload.php');

use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

//先ほど取得したチャネルシークレットとチャネルアクセストークンを以下の変数にセット
$channel_access_token = 'HQEtK6VqoIjXZZgQSVi/8hI1AAT2DYpoopwOjoyJUZEawQoQ7bV+ymifHyEVO/yLdv92YSVZgpJkmZBhyntpZd8e/soWNPuHjyVJW4He69xqW5uGRDSvs4yjPN0Jihrai+qMLPm5HDAdGZ+oLzTaeAdB04t89/1O/w1cDnyilFU=';
$channel_secret = '8c81e774ab6bf15f41029c6583d534ad';

$http_client = new CurlHTTPClient($channel_access_token);
$bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);
$signature = $_SERVER['HTTP_'.HTTPHeader::LINE_SIGNATURE];
$http_request_body = file_get_contents('php://input');
$events = $bot->parseEventRequest($http_request_body, $signature);
$event = $events[0];

$reply_token = $event->getReplyToken();
$reply_text = $event->getText();
$bot->replyText($reply_token, $reply_text);