<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
	// session_start();
}
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/CustomerManager.php");
$customerMgr = new CustomerManager();
$receiver_id = $_SESSION["userid"] ;
$sender_first_name = $customerMgr->getFirstName($receiver_id);
$sender_last_name = $customerMgr->getLastName($receiver_id);
// $sender_name = $sender_first_name." ".$sender_last_name;

$to = filter_input(INPUT_POST,'send_email_address');

$invitation_link = filter_input(INPUT_POST,'invitation_link');

//$to = "hx.zhai.2012@sis.smu.edu.sg";
//$to = "monalisa4518@gmail.com";
//$to = "leonyu0930@gmail.com";
//$to = "253291619@qq.com";
$sender_name = "Issac Zhai";

$subject = $sender_name." has just given you $10 Credits";

$message = '<html>
	<body style="margin: 0; padding: 0;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">	
            <tr>
                <td style="padding: 10px 0 30px 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                        <tr>
                            <td align="center">
                                <a href="'.strip_tags($invitation_link).'"><img src="https://s3-ap-southeast-1.amazonaws.com/allocacocvideo/Standard+Romantic.png" alt="" width="600" height="300" style="display: block;" /></a>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#461F00" style="padding: 40px 30px 40px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="color: #FFFFFF; font-family: Arial, sans-serif; font-size: 24px;">
                                            <h3>Awesome! '.strip_tags($sender_name).' has just given you $10 Credits to shop</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 20px 0 30px 0; color: #FFFFFF; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                            <p>Please click <a href="'.strip_tags($invitation_link).'">here</a> to get your credits</p>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: leonyu0930@gmail.com' . "\r\n";
//$headers .= 'Cc: leonyu0930@gmail.com' . "\r\n";


mail($to,$subject,$message,$headers);

header("Location: account.php");    