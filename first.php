<?php

header("Access-Control-Allow-Origin: *");
$response = array();

// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';

// After Step 1
$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AWlB_UEAY46sVBcdBfjlsUdOrvFI8dRtOfS_XkyXXkLHCoaqsxev9AlzRhk2KlurpSynYk9RGytkWPTs',     // ClientID
            'EPaBfjhfyuH3KIeyW0Jpk4pkBkDR6J23kx5ZnywfR8keOlsS758FRX0zFiV2mZ1t620zqX9ky6VESe6D'      // ClientSecret
        )
);

// Step 1.1 รับค่า parameter เช่น order_id
// $orderId = $_GET['order_id'];

// Step 1.2 Query หา order ใน Database

// Step 1.3 ตรวจสอบเงื่อนไขต่าง ๆ เช่น สินค้าในคลังมีพอไหม

// Step 1.4 เตรียมข้อมูลสำหรับยิงไป Paypal API

// Step 1.5 Goto Step2

// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('100.00'); // mockup price for test
$amount->setCurrency('THB'); // mockup currency for test

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://www.zp11107.tld.122.155.17.167.no-domain.name/paypal-2019/return.php")
    ->setCancelUrl("http://www.zp11107.tld.122.155.17.167.no-domain.name/paypal-2019/cancel.php");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// After Step 3
try {
    $payment->create($apiContext);
    $response['status'] = 200;
    $response['approval_url'] = $payment->getApprovalLink();
    // echo $payment;
    // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    // echo $ex->getData();
    $response['status'] = 500;
    $response['message'] = 'fail';
    $response['message_detail'] = $ex->getData();
}

echo json_encode($response);
exit;
