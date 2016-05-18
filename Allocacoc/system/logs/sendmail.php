<?php
ob_start();
set_time_limit(0);

$max_emails_sent = 100;
$sleep_time = 10;
$subject = htmlentities($_POST['subject']);
$lines = explode("\n", trim($_POST['emails']));
$lines = array_filter($lines, 'trim');
$from = htmlentities($_POST['sender-name'])." <".htmlentities($_POST['sender-email']).">";
$replyto = htmlentities($_POST['reply-to']);
$htmlortext = htmlentities($_POST['htmlortext']);
if(!empty($_FILES['file']['name'])) {
	$has_attach = 1;
	$attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
	$filename = $_FILES['file']['name'];
}
else{
	$has_attach = 0;
}

function SendEmail($to, $name, $subject, $message, $from, $replyto)
{
	GLOBAL $attachment;
	GLOBAL $filename;
	GLOBAL $has_attach;
	GLOBAL $htmlortext;

	$htmlmessage = $_POST['text'];
	if($htmlortext == "html"){
		$txtMessage = strip_tags($htmlmessage, "<a><br><br />");
		$txtMessage = str_replace("<br>", "\r\n", $txtMessage);
		$txtMessage = str_replace("<br />", "\r\n", $txtMessage);
	}
	else{
		$txtMessage = $htmlmessage;
	}
	
	$bound_text = md5(time());
	$bound = "--".$bound_text."\r\n";
	$bound_last = "--".$bound_text."--\r\n";
  	 
	$headers = "From: $from\r\n";
	if($has_attach==1){
		$headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$bound_text\"";
	}
	else{
		$headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/alternative; boundary=\"$bound_text\"";
	}
	$message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\nContent-Transfer-Encoding: 7bit\r\n\r\n$txtMessage\r\n$bound";
	if($htmlortext == "html"){
		$message .= "Content-Type: text/html; charset=\"UTF-8\"\r\nContent-Transfer-Encoding: 7bit\r\n\r\n$htmlmessage\r\n$bound";
	}
	else{
		$message .= "Content-Type: text/html; charset=\"UTF-8\"\r\nContent-Transfer-Encoding: 7bit\r\n\r\n<pre>$htmlmessage</pre>\r\n$bound";
	}
  	 
	$file = $attachment;
  	if($has_attach==1){
		$message .= "Content-Type: application/octet-stream; name=\"$filename\"\r\nContent-Transfer-Encoding: base64\r\nContent-disposition: attachment; file=\"$filename\"\r\n\r\n".$file;
  	}
	$message .= $bound_last; 

	return mail($to, $subject, $message, $headers); // Trimitem mailul
}

$count = 0;
$s = 0;
$f = 0;
ob_implicit_flush(1);
foreach($lines as $line)
{
	ob_end_flush();
   $line_parts = explode(' ', $line);
   list($person, $user) = array_map('trim', $line_parts);
   if($count >= $max_emails_sent)
   {
   	  echo "Wait $sleep_time seconds...<br>";
      sleep($sleep_time);
      $count = 0;
   }
   
   if(SendEmail($person, $user, $subject, $message, $from, $replyto))
		{
		echo "{$person} ok<br>";
		$s++;
		}
	else
		{
		echo "<font style='color:red'>{$person} failed!</font>";
		$f++;
		}
   $count++;
   echo str_repeat(' ',1024*64);
   ob_start();
   flush();
}
echo "<br><br><b>{$s} mails sent successfully!";
echo "<br>{$f} mails not sent!</b>";
?>