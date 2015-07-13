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
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

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
$item1 = new Item();
$item1->setName('powercube')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice(10);
$item2 = new Item();
$item2->setName('Cable')
    ->setCurrency('USD')
    ->setQuantity(5)
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

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
    ->setTotal(20);
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
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 	ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://ppmts.custhelp.com/app/answers/detail/a_id/750">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
    exit(1);
}
$redirectUrl='';
foreach($payment->getLinks() as $link){
	var_dump($link);
	if($link->getRel() == 'approval_url'){
		$redirectUrl = $link->getHref();
	}
}

//var_dump($redirectUrl);

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);
//return $payment;



