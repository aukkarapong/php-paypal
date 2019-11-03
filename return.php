<?php

require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
require 'ResultPrinter.php';

$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AWlB_UEAY46sVBcdBfjlsUdOrvFI8dRtOfS_XkyXXkLHCoaqsxev9AlzRhk2KlurpSynYk9RGytkWPTs',     // ClientID
            'EPaBfjhfyuH3KIeyW0Jpk4pkBkDR6J23kx5ZnywfR8keOlsS758FRX0zFiV2mZ1t620zqX9ky6VESe6D'      // ClientSecret
        )
);

$paymentId = $_GET['paymentId'];
$paymentApi = new \PayPal\Api\Payment();
$payment = $paymentApi::get($paymentId, $apiContext); 
$paymentJson = $payment->toJSON(128);
$paymentArray = json_decode($paymentJson, true);

$execution = new \PayPal\Api\PaymentExecution(); 
$execution->setPayerId($paymentArray['payer']['payer_info']['payer_id']);

$amount = new \PayPal\Api\Amount();
$amount->setTotal('100.00');
$amount->setCurrency('THB');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$execution->addTransaction($transaction);

try {
  $result = $payment->execute($execution, $apiContext);
  $resultJson = $result->toJSON(128);
  $resultArray = json_decode($resultJson, true);

  try { 
    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext); 
    $paymentJson = $payment->toJSON(128);
    $paymentArray = json_decode($paymentJson, true);

    // ข้อมูลที่ response จาก Paypal
    echo '<pre>';
    print_r($paymentArray);

    // todo :: update order status ใน database
  } catch (Exception $ex) {
    // ResultPrinter::printError("Get Payment", "Payment", null, null, $ex); exit(1);
  }
  
} catch (Exception $ex) {
  // ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex); 
  exit(1);
}
