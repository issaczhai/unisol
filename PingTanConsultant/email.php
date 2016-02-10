<?php
	require_once "./vendor/phpmailer/phpmailer/PHPMailerAutoload.php";

	class Email{

		var $subject,
			$sender,
			$receiver,
			$replyTo,
			$body,
			$linkAction = 'www.google.com';

		function __construct($subject, $sender, $receiver, $replyTo, $linkAction){

			$this -> subject = $subject;
			$this -> sender = $sender;
			$this -> receiver = $receiver;
			$this -> replyTo = $replyTo;
			$this -> linkAction = $linkAction;
			
		}

		function initEmailBody($subject){
			switch ($subject) {
				case 'New Course Registration':
					//print_r('initialization:'. $this -> $sender);
					$this -> body = $this -> createIndividualRegistrationBody($this -> linkAction);
					
					break;
				case 'New Group Course Registration':

					break;
				default:
					$this -> $body = "<i>Mail body in HTML</i>";
					break;
			}
		}

		function createIndividualRegistrationBody(){
			$html = "<i>New Individual Course Registration</i>";

			return $html;
		}

		function send($sendFlag){
			$mail = new PHPMailer;
			// set $sendFlag to true if sending using SMTP, false if sending use local web server
			if($sendFlag){
				if ($this -> sendUseSMTP($mail)) return true;
			}
		}

		function sendUseSMTP($mail){
			//Enable SMTP debugging. 
			$mail->SMTPDebug = 3;                               
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();            
			//Set SMTP host name                          
			$mail->Host = "smtp.gmail.com";
			//Set this to true if SMTP host requires authentication to send email
			$mail->SMTPAuth = true;                          
			//Provide username and password     
			$mail->Username = 'jackyfeng1218@gmail.com';          
			$mail->Password = "fxaijavi4ever";  
			$mail->SMTPSecure = "ssl";                    
			//Set TCP port to connect to 
			$mail->Port = 465;                                   

			$mail->From = $this -> sender;
			$mail->FromName = "Feng Xin";

			$mail->addAddress($this -> receiver, "Jacky");
			$mail->isHTML(true);

			$mail->Subject = $this -> subject; 
			$mail->Body = $this -> body; // set to $this -> $body
			$mail->AltBody = "This is the plain text version of the email content"; // set the plain text version of body, depends on subject
			
			if(!$mail->send()) 
			{
			    //print_r("Mailer Error: " . $mail->ErrorInfo);
			    return false;
			} 
			else 
			{
			    return true;
			}
		}
	}

?>