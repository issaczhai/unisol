<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment. Please note that direct 
// credit card payment and related features using the 
// REST API is restricted in some countries.
// API used: /v1/payments/payment

require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\CreditCard;
use PayPal\Api\CurrencyConversion;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

include_once(__DIR__ . "/../../Manager/ConnectionManager.php");
include_once(__DIR__ . "/../../Manager/RewardManager.php");
include_once(__DIR__ . "/../../Manager/CreditManager.php");
include_once(__DIR__ . "/../../Manager/CustomerManager.php");
include_once(__DIR__ . "/../../Manager/OrderManager.php");
include_once(__DIR__ . "/../../Manager/ProductManager.php");
if (!isset($_SESSION)) {
  session_start();
}
$userid = null;
$userid = $_SESSION["userid"];
$rewardMgr = new RewardManager();
$creditMgr = new CreditManager();
$customerMgr = new CustomerManager();
$orderMgr = new OrderManager();
$productMgr = new ProductManager();
// ### CreditCard
// A resource representing a credit card that can be
// used to fund a payment.
$card = new CreditCard();

//$card->setType("visa")
 //   ->setNumber("4148529247832259")
//    ->setExpireMonth("11")
//    ->setExpireYear("2019")
//    ->setCvv2("012")
 //   ->setFirstName("Joe")
//    ->setLastName("Shopper");


$creditcard_type = $_POST["creditcard"];
$cardHolderFN = filter_input(INPUT_POST,'cardHolderFN');
$cardHolderLN = filter_input(INPUT_POST,'cardHolderLN');
$cardNumber = filter_input(INPUT_POST,'cardNumber');
$expMonth = filter_input(INPUT_POST,'expMonth');
$expYear = filter_input(INPUT_POST,'expYear');
$cvCode = filter_input(INPUT_POST,'cvCode');
$card->setType($creditcard_type)
    ->setNumber($cardNumber)
    ->setExpireMonth($expMonth)
    ->setExpireYear($expYear)
    ->setCvv2($cvCode)
    ->setFirstName($cardHolderFN)
    ->setLastName($cardHolderLN);


// ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setCreditCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$payer = new Payer();
$payer->setPaymentMethod("credit_card")
    ->setFundingInstruments(array($fi));

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$rewardCode = filter_input(INPUT_POST,'rewardCode');
$invite = filter_input(INPUT_POST,'invite');
$gift = null;
if(!empty($rewardCode)){
    $gift = $rewardMgr->getGiftByRewardCode($rewardCode);
    $rewardMgr->addToHistory($userid, $rewardCode);
}
if(!empty($invite)){
    $creditMgr->updateCreditStatusToTrue($invite, $userid);
}

/*********************************************************************************************************/


$totalPrice = 0.0;
$itemList = new ItemList();
$listLength = filter_input(INPUT_POST,'listLength');
$list=array();
$orderList = array();
for ($x=1; $x<=intval($listLength); $x++) {
    $item = new Item();
    $product_id = filter_input(INPUT_POST,'product_id'.strval($x));
    $product = filter_input(INPUT_POST,'product'.strval($x));
    $quantity = intval(filter_input(INPUT_POST,'quantity'.strval($x)));
    $priceSGD = doubleval(filter_input(INPUT_POST,'price'.strval($x)));
    $url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22USDSGD%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
    $data = file_get_contents($url);
    $jsonObj = json_decode($data,true);
    $USDSGDRate = doubleval($jsonObj['query']['results']['rate']['Rate']);
    $priceUSD = $priceSGD/$USDSGDRate;
    $price = number_format($priceUSD,2,'.','');
    $item->setName($product)
    ->setCurrency('USD')
    ->setQuantity($quantity)
    ->setPrice($priceUSD);
    $totalPrice+=($quantity*$price);
    array_push($list, $item);
    
    $order = [];
    $order["product_id"] = $product_id;
    $order["customer_id"] = $userid;
    $order["quantity"] = $quantity;
    $order["price"] = $price;
    $order["add_to_cart_time"] = filter_input(INPUT_POST,'add_to_cart_time'.strval($x));
    array_push($orderList, $order);
}
if($gift !== null){
    $giftItem = new Item();
    $giftName = $gift["product"];
    $giftItem->setName($giftName)
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice(0.0);
    array_push($list, $giftItem);
    
    $order = [];
    $order["product_id"] = "gift";
    $order["customer_id"] = $userid;
    $order["quantity"] = 1;
    $order["price"] = 0.0;
    array_push($orderList, $order);
}
if(!empty($invite)){
    $totalPrice-=10.0;
}
$itemList->setItems($list);

/*********************************************************************************************************/

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
//$details = new Details();
//$details->setShipping(1.2)
//    ->setTax(1.3)
//   ->setSubtotal(17.5);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal($totalPrice);
//    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('http://localhost/allocacoc/paymentSuccessful.php?status=approved')
	->setCancelUrl('http://localhost/allocacoc/paymentSuccessful.php?status=rejected');	
// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setTransactions(array($transaction))
	->setRedirectUrls($redirectUrls);
// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->create($apiContext);
    //Update Order in database
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $order_id = '';
    for ($j = 0; $j < 6; $j++) {
        $order_id .= $characters[rand(0, $charactersLength - 1)];
    }
    date_default_timezone_set('Asia/Singapore');
    $payment_time = date('Y-m-d H:i:s');
    foreach($orderList as $order){
        //Add order information into database
        $orderMgr->addOrder($order_id, $order["customer_id"], $order["product_id"], $order["quantity"], $payment_time, $order["price"]);
        if($order["product_id"] != "gift"){
            //Update Customer Shopping cart
            $productMgr->updateShoppingCartPayTime($order["customer_id"], $order["product_id"], $order["add_to_cart_time"]);
        }
    }
    
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    //ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://ppmts.custhelp.com/app/answers/detail/a_id/750">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
    $redirectUrl=$payment->getRedirectUrls();
    var_dump($redirectUrl->getCancelUrl());
//header("Location: ".$redirectUrl->getCancelUrl());
    exit(1);
}
$redirectUrl=$payment->getRedirectUrls();
//header("Location: ".$redirectUrl->getReturnUrl());


// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);
//return $payment;



