<?php 
if (!isset($_GET["ajax"])) {
    die();
}


$Car_name = isset($_POST['title']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
    "", $_POST['title']) : "";
    
define("RECIPIENT_NAME", "WordPress");
define("EMAIL_SUBJECT", "Visitor Message From CarDealer Plugin About: ".$Car_name);

$success = false;
$recipient_email = isset($_POST['CarDealer_recipientEmail']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
    "", $_POST['CarDealer_recipientEmail']) : "";

$senderName = isset($_POST['CarDealer_senderName']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/",
    "", $_POST['CarDealer_senderName']) : "";
$senderEmail = isset($_POST['CarDealer_senderEmail']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
    "", $_POST['CarDealer_senderEmail']) : "";
$message = isset($_POST['CarDealer_sendermessage']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/",
    "", $_POST['CarDealer_sendermessage']) : "";


if ($senderName && $senderEmail && $message && $recipient_email) {
    $recipient = RECIPIENT_NAME . " <" . $recipient_email . ">";
    $headers = "From: " . $senderName . " <" . $senderEmail . ">";
    $success = mail($recipient_email, EMAIL_SUBJECT, $message, $headers);
}

echo $success ? "success" : "error"; ?>