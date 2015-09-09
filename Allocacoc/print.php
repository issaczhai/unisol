<?php
require('fpdf17/fpdf.php');
include('fpdf17/php-barcode.php');
include_once("./Manager/ConnectionManager.php");
include_once("./Manager/ProductManager.php");
include_once("./Manager/CustomerManager.php");
include_once("./Manager/OrderManager.php");
include_once("./Manager/AddressManager.php");
$productMgr = new ProductManager();
$customerMgr = new CustomerManager();
$orderMgr = new OrderManager();
$addressMgr = new AddressManager();

// -------------------------------------------------- //
  //                  GET ORDER INFORMATION
  // -------------------------------------------------- //
$order_id = implode("", $_POST);
$orderList = $orderMgr->getPendingOrder();
$order=[];
//var_dump($orderList);
foreach($orderList as $o){
    if($o["order_id"] === $order_id){
        $order = $o;
    }
}
//$order = $orderList[$order_id];
//var_dump($order);
  class eFPDF extends FPDF{
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
  }

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  $fontSize = 12;
  $marge    = 0;   // between barcode and hri in pixel
  $x        = 105;  // barcode center
  $y        = 10;  // barcode center
  $height   = 12;   // barcode height in 1D ; module size in 2D
  $width    = 1;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees
  
  $type     = 'code128';
  $black    = '000000'; // color in hexa
/* 
 * This is a separation section This is a separation section
 * This is a separation section This is a separation section
 * This is a separation section This is a separation section
 * This is a separation section This is a separation section
 */
$orderNo=$order['order_id'];
$customer_id = $order['customer_id'];
$receiverName=($customerMgr->getLastName($customer_id))." ".$customerMgr->getFirstName($customer_id);
$receiverAddress = $addressMgr->getGeneralAddress($customer_id,intval($order['address_no']));

$receiverPhone=$customerMgr->getContactNo($customer_id);
$receiverPostalCode = $addressMgr->getPostalCode($customer_id,intval($order['address_no']));
$totalPrice = $order['totalPrice'];

$itemList=$order['itemList'];
//var_dump($itemList);
$array=[];
foreach($itemList as $item){
    $product_full_code = $productMgr->getFullCodeByProductColor($item['product_id'],$item['color']);
    array_push($array, $product_full_code."   x".$item['quantity']."   $".number_format($item['price'],2,'.',''));
}


$pdf = new eFPDF('P');
$pdf->AddPage();
$pdf->Ln(20);
//BARCODE
$data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$orderNo), $width, $height);


//ORDER ID
//$pdf->SetFont("Arial","B",16);
//$pdf->Cell(0, 10, "Here should be order number", 0, 1,"C");
$pdf->SetFont('Arial','',$fontSize);
$pdf->SetTextColor(0, 0, 0);
$len = $pdf->GetStringWidth($data['hri']);
Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
$pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);



//NAME & TEL NO
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0, 12, " NAME: ".$receiverName, 1, 1,"L");
$pdf->Cell(0, 18, " ADDRESS: ".$receiverAddress, 1, 1,"L");
$pdf->Cell(100, 12, "Tel. No.: ".$receiverPhone, 1, 0,"L");
$pdf->Cell(0, 12, "POSTAL CODE: ".$receiverPostalCode, 1, 1,"L");


//product info
$pdf->Cell(0, 12, "Items:", "LR", 1,"L");
$pdf->SetFont("Arial","",10);
foreach($array as $info){
    $pdf->Cell(0, 4, $info, "LR", 1,"L");
}
$pdf->Cell(0, 4, "", "LR", 1,"L");


//TOTAL AMT & SIGNATURE
$pdf->SetFont("Arial","B",12);
$pdf->Cell(30, 10, "Total Price:", 1, 0,"L");
$pdf->SetFont("Arial","",12);
$pdf->Cell(50, 10, "$ ".$totalPrice, 1, 0,"C");
$pdf->SetFont("Arial","B",12);
$pdf->Cell(30, 10, "Signature:", 1, 0,"L");
$pdf->Cell(0, 10, "", 1, 1,"L");


//COMPANY INFO
$pdf->Ln(2);
$pdf->SetFont("Arial","",10);
$pdf->Cell(0, 4, "Here shows company address", 0, 1, "C");
$pdf->Cell(0, 4, "Contacts: (+65) 14725836", 0, 1, "C");
//$pdf->MultiCell($w, $h, $txt, $border, $align, $fill)
//$pdf->Cell($w, $h, $txt, $border, $ln, $align)
$pdf->Output();
