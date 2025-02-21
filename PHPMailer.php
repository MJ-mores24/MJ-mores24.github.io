<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if(isset($_POST['form_submit'])){
  $form_name = $_POST['form_name'];
  $form_email = $_POST['form_email'];
  $form_subject = $_POST['form_subject'];
  $form_message = $_POST['form_message'];
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host       = 'mail.fcgroup.ph';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'it_bpi@fcgroup.ph';
    $mail->Password   = 'floorcenter';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom($form_email, $form_name);
    $mail->addAddress('marvinmoresca@gmail.com', '');
    $mail->addReplyTo($form_email, $form_name);
    $mail->isHTML(true);
    $mail->Subject = $form_subject;
    $mail->Body    = $form_message;
    $mail->AltBody = $form_message;
    $mail->send();
    $_SESSION['icon'] = "success";
    $_SESSION['message'] = "Your message was sent.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } catch (Exception $e) {
    $_SESSION['icon'] = "error";
    $_SESSION['message'] = "Error in sending message.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
?>