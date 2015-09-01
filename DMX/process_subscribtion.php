<?php

$api_key = "782b1ee199207e065daa9dcb0a2ce38e-us11";
$list_id = "b0d209edc3";
require('./Mailchimp.php');
$Mailchimp = new Mailchimp( $api_key );
$Mailchimp_Lists = new Mailchimp_Lists( $Mailchimp );
$subscriber = $Mailchimp_Lists->subscribe( $list_id, array( 'email' => $_POST['email'] ) );
if ( ! empty( $subscriber['leid'] ) ) {
   echo "success";
}
else
{
    echo "fail";
}


?>