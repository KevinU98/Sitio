<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// require '/phpMailer/src/Exception';
// require '/phpMailer/src/PHPMailer.php';
// require '/phpMailer/src/SMTP.php';

include_once(FCPATH.'PHPMailer/src/PHPMailer.php');
include_once(FCPATH.'PHPMailer/src/SMTP.php');
include_once(FCPATH.'PHPMailer/src/Exception.php');

  $msj="My complete message";
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  //authentication SMTP enabled
  $mail->SMTPAuth = true; 
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
  $mail->Host = "smtp.gmail.com";
  //indico el puerto que usa Gmail 465 or 587
  $mail->Port = 465; 
  $mail->Username = "kevin.uriegas@tibs.com.mx";
  $mail->Password = "kevinalexis";
  $mail->SetFrom("kevin.uriegas@tibs.com.mx","Saving Plastic");
  $mail->AddReplyTo("kevin.uriegaslo@icloud.com","Kevin Uriegas");
  $mail->Subject = "Test";
  $mail->MsgHTML($msj);
  $mail->AddAddress("kevin.uriegaslo@icloud.com");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}

// Create the email and send the message
// $to = "yourname@yourdomain.com"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
// $subject = "Website Contact Form:  $name";
// $body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
// $header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $header .= "Reply-To: $email";	

// if(!mail($to, $subject, $body, $header))
//   http_response_code(500);
// ?>
