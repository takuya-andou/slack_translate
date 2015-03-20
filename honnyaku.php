<?php
const APPID = 'Your_App_ID';
$text = $_POST["text"];
//投稿者が日本人の場合
if ($_POST["user_name"] == "Japanese_User_Name" ){
	$to = 'en';
}
//投稿者が英語を書く人の場合
elseif ($_POST["user_name"] == "English_Post_User_Name") {
	$to = 'ja';
}
$ch = curl_init('https://api.datamarket.azure.com/Bing/MicrosoftTranslator/v1/Translate?Text=%27'.urlencode($text).'%27&To=%27'.$to.'%27');
curl_setopt($ch, CURLOPT_USERPWD, APPID.':'.APPID);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = explode('<d:Text m:type="Edm.String">', $result);
$result = explode('</d:Text>', $result[1]);
$result = $result[0];
if ($_POST["token"] != "Your_Slack_Token"): ?>
<h2>無効なトークンです</h2>
<?php endif ?>
{"text":"<?php echo $_POST["user_name"] ?> said : <?php echo $result ?>"}