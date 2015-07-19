<?php
foreach(glob($_SERVER['DOCUMENT_ROOT'].'/allocacoc/Manager/*.php') as $file) {
     include_once $file;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $customerMgr = new CustomerManager();
    $creditMgr = new CreditManager();
    if(isset($_GET['src']) && !empty($_GET['src'])){
        #Construct sender invitation link
        $invitation_link = 'invite.php?src='.$_GET['src'];
        #get sender information
        $sender = $customerMgr->getCustomerByInvitationLink($invitation_link);
        var_dump($sender);
        if(empty($sender)){
            #Situation 2: no such invitation exist. Redirect to index page with popup message
            $status = 'error';
            $message = "There is error in your friend's referral!";
            header("Location: index.php?status=$status&message=$message");
            exit;
        }
        session_start();
        $receiver_email = null;
        $sender_email = $sender['customer_id'];
        if(!empty($_SESSION["userid"])){
            #Situation 3: browser contains login information
            $receiver_email = $_SESSION["userid"];
            
            if($receiver_email === $sender_email){
                #Situation 7: receiver and sender share same email. It means it's an illegal self-referral
                $status = 'fail';
                $message = "Cyclic referral detected!";
                header("Location: index.php?status=$status&message=$message");
                exit;
            }
            
            $status = $creditMgr->checkInvitationStatus($sender_email, $receiver_email);
            if($status===null){
                #Situation 5: receiver has not accepted any credit from sender. Successfully receive credit and redirect to index
                
                $creditMgr->addCredit($sender_email, $receiver_email);
                
                $customerMgr->updateCredit($receiver_email, 10.0);
                $status = 'success';
                $message = "Congratulations! You have got $10 credits from your friend!";
                header("Location: index.php?status=$status&message=$message");
                exit;
            }else{
                #Situation 6: receiver has already received credit from sender. Redirect to index and prompt error.
                $status = 'fail';
                $message = "You have already received credit from your friend!";
                header("Location: index.php?status=$status&message=$message");
                exit;
            }
            
        }else{
            #Situation 4: browser does NOT contain login information. We need to retain referral information for immediate registration
            $status = 'pending';
            $message = "Sign up or login to claim your credit!";
            setcookie('sender_email',$sender_email , time()+7200);
            header("Location: index.php?status=$status&message=$message");
            exit;
        }
    }else{
        #Situation 1: no parameter in url or empty parameter in url
        $status = 'error';
        $message = "Ops. This page cannot be found!";
        header("Location: index.php?status=$status&message=$message");
        exit;
    }

?>