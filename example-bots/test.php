<?php
error_reporting(0);
set_time_limit(0);
ob_start();
$token			= "5146614420:AAFYZYHjQxEWt_rl7r6lcHWMJERYBRIYt58";
$admin			= 5177196243;
$channel		= "iNeoTeam";
if(!file_exists("iTelegram.php")){
	copy("https://raw.githubusercontent.com/iNeoTeam/iTelegram/main/iTelegram.phar", "iTelegram.php");
}
require_once("iTelegram.php");
use iTelegram\Bot;
define('API_KEY', $token);
$bot		= new Bot();
$bot->Authentification(API_KEY);
$text		= $bot->Text();
$chat_id	= $bot->getChatId();
$message_id	= $bot->MessageId();
$first_name	= $bot->getChatFirstname();
$getMe		= $bot->TelegramAPI('getMe');
$inputType	= $bot->InputMessageType();
$update		= $bot->Update();
$button		= $bot->SingleInlineUrlKeyboard("💥طراحی و توسعه توسط آی نئو تیم", "https://t.me/".$channel);
$users		= file_get_contents("users.txt");
$_users		= explode("\n", $users);
if($text == "/start"){
	if(!in_array($chat_id, $_users)){
		$users .= $chat_id."\n";
		file_put_contents("users.txt", $users);
	}
	$message = "🖐<b>Hello dear friend.</b>
❤️Welcome to the anonymous robot.
➖➖➖➖➖➖➖➖
✅<b>With this bot, you can delete your media quotes.</b>

For just forward a post or media for the robot
➖➖➖➖➖➖➖➖
📣 @".$channel;
	$r = $bot->sendMessage($chat_id, $message, "HTML", true, $message_id, $button);
}else{
	
	$caption = $update['message']['caption'];
	if($inputType == "photo"){
		$r = $bot->sendPhoto($chat_id, $fileId='https://t.me/testtttsy/529', $caption, "HTML", null, $message_id, $button);
	}elseif($inputType == "audio"){
		$r = $bot->sendAudio($chat_id, $fileId, $caption, null, null, null, null, "HTML", null, $message_id, $button);
	}elseif($inputType == "text"){
		$r = $bot->sendMessage($chat_id, $text, "HTML", true, $message_id, $button);
	}elseif($inputType == "document"){
		$r = $bot->sendDocument($chat_id, $fileId, $caption, null, "HTML", null, $message_id, $button);
	}elseif($inputType == "voice"){
		$r = $bot->sendVoice($chat_id, $fileId, $caption, "HTML", null, $message_id, $button);
	}elseif($inputType == "video"){
		$r = $bot->sendVideo($chat_id, $fileId, $caption, "HTML", null, $message_id, $button);
	}elseif($inputType == "sticker"){
		$r = $bot->sendSticker($chat_id, $fileId, null, $message_id);
	}else{
		$r = $bot->sendMessage($chat_id, "❗️<b>ورودی مورد نظر نامعتبر است.</b>\n➖➖➖➖➖➖➖➖\n📣 @".$channel, "HTML", true, $message_id, $button);
	}
}
unlink("error_log");

?>
