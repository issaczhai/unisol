<?php
$message = filter_input(INPUT_POST, 'message');
$name = filter_input(INPUT_POST, 'name');
$subject = filter_input(INPUT_POST, 'subject');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');

require_once './vendor/mandrill/mandrill/src/Mandrill.php'; //Not required with Composer


try {
	$mandrill = new Mandrill('AaatdOPulOX7AXE-WOVtOQ');
    $message = array(
        //'html' => '<p>Example HTML content</p>',
        'text' => $message,
        'subject' => $subject,
        'from_email' => $email,
        'from_name' => $name,
        'to' => array(
            array(
                'email' => 'jackyfeng1218@gmail.com',
                'name' => 'Jacky',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'xin.feng.2012@sis.smu.edu.sg'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        'global_merge_vars' => array(
            array(
                'name' => 'merge1',
                'content' => 'merge1 content'
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => 'recipient.email@example.com',
                'vars' => array(
                    array(
                        'name' => 'merge2',
                        'content' => 'merge2 content'
                    )
                )
            )
        )
        //'tags' => array('password-resets'),
        //'subaccount' => 'customer-123'
        //'google_analytics_domains' => array('example.com'),
        //'google_analytics_campaign' => 'message.from_email@example.com',
        /*'metadata' => array('website' => 'www.example.com'),
        'recipient_metadata' => array(
            array(
                'rcpt' => 'recipient.email@example.com',
                'values' => array('user_id' => 123456)
            )
        ),
        'attachments' => array(
            array(
                'type' => 'text/plain',
                'name' => 'myfile.txt',
                'content' => 'ZXhhbXBsZSBmaWxl'
            )
        ),
        'images' => array(
            array(
                'type' => 'image/png',
                'name' => 'IMAGECID',
                'content' => 'ZXhhbXBsZSBmaWxl'
            )
        )*/
    );
    $async = false;
    $ip_pool = 'Main Pool';
    //$send_at = time(); // NEED PAYMENT FOR EMAIL SCHEDULING
    $result = $mandrill->messages->send($message, $async, $ip_pool);
    echo "success";
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}



?>