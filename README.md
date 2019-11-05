# Paypal

Paypal ฝั่ง server side (PHP) ตัวอย่าง sourccode อยู่ที่ https://github.com/aukkarapong/php-paypal

ก่อนเริ่มต้นการเขียน code จะต้องสร้าง Account สำหรับ dev ที่ Paypal ก่อน โดยเข้าไปที่เว็บไซต์ 
```
https://developer.paypal.com/
```

หากยังไม่มี account ให้ทำการสร้าง account ให้เรียบร้อยก่อน (เราจะข้ามขั้นตอนการสมัครสมาชิกไป)

## Login เข้าใช้งาน Paypal Developer
เข้าไปที่ website <a href="https://developer.paypal.com/">https://developer.paypal.com/</a> และกดที่ปุ่ม <b>Log inti Dashboard</b>

เมื่อ login เข้ามาแล้ว ให้เลือก "My Apps & Credentials" ที่เมนูทางด้านซ้ายมือ เพื่อที่เราจะทำการ create application ใน Paypal

## การ Create Application ใน Paypal
```
1. เลือก "My Apps & Credentials"
2. เลือกแบบ "Sandbox" เพื่อสร้างระบบแบบทดสอบ ไม่ต้องตัดเงินจริง
3. เลือก "Create App"
4. ตั้งชื่อ App Name และเลือก Sandbox Business Account
5. กดปุ่ม "Create App" เพื่อทำการ create
```

## เมื่อได้ Application Paypal มาแล้ว
สิ่งที่จำเป็นที่ต้องเอามาใช้ในการพัฒนาระบบคือ 
```
Client ID และ Secret
```

จากตัวอย่างจะได้ Client ID เป็นรหัสชุดนึงดังนี้
```
Ad5mcUto5gEDT93K7PUrshYmw8jTcZGLvvxAim54dm1wnUKGnKMYeVqLUpoJ9vFFffwo7owpsaQS3Pqf
```

และ Secret เป็นรหัสชุดนึงดังนี้
```
EB2WYgYTmPHeLo_7c4BgUJc3M7OhNnsIh6qsVV8T83wwuYrPXPpiovxV-KhPyTMdK2tLaA_UMYc0zBK4
```

เมื่อได้รหัส Client ID และ Secret แล้ว เราจะต้องทำการกำหนด <u>Return URL</u> เพื่อให้ redirect จาก paypal กลับมา website หรือ application เรา เมื่อทำการจ่ายเงินสำเร็จ

## การกำหนด Return URL
```
1. ไปที่ "My Apps & Credentials"
2. เข้าไปยัง Application ของเรา โดยกดที่ชื่อ Application
3. ดูที่ส่วน "SANDBOX APP SETTINGS" จะเห็น "Return URL"
4. กด "Show"
5. ใส่ "Return URL"
6. จากนั้นกด "Save"
```

จากตัวอย่างจะใส่ url เป็น 
```
http://zp11107.tld.122.155.17.167.no-domain.name/paypal-2019/return.php
```

url นี้ ได้มาจากไหน???

เป็น code ที่เราเขียนขึ้นเอง code ตัวอย่างอยู่ใน 
```
https://github.com/aukkarapong/php-paypal/blob/master/return.php
```

ซึ่งสามารถศึกษาเพิ่มเติมได้จาก https://github.com/paypal/ >>> https://github.com/paypal/PayPal-PHP-SDK เป็น library ที่ทาง Paypal ได้เขียนขึ้นเพื่อให้นักพัฒนาได้ทำไปใช้งานใน project ตัวตัวเอง เขาจะเรียกว่า "Paypal-SDK" แยกตามภาษาที่ถนัด

จากขั้นตอนที่กล่าวมาข้างต้น เราได้ Application Paypal (Sandbox) มาแล้ว ยังมีอีกหนึ่งขั้นตอนที่เราต้องทำ คือ สร้าง account สำหรับ test

## Create Paypal Sandbox Accout
```
1. ไปที่ Sandbox > Accounts จากเมนูด้านซ้ายมือ
2. กด "Create Account"
```

Account จะแบ่งเป็น 2 ประเภท
```
1. Personal (Buyer Account) เป็น account จำลองของลูกค้า
2. Business (Merchant Account) เป็น account ของร้านค้า
```

เมื่อสร้าง account เสร็จแล้ว เราสามารถเปลี่ยน password เพื่อให้จำง่าย ๆ ได้
```
1. กดที่ Manage Account > VIew/Edit Account
2. เลือก "Change Password"

```

เราจะต้องทำการสร้างทั้ง 2 ประเภท

พอได้ account มาแล้ว เราจะเอาไปใช้ทำอะไร???

ลอง login เข้าใช้งาน https://www.paypal.com/
จะพบว่า ไม่สามารถเข้าไปใช้งานที่ระบบหลักของ Paypal ได้

แล้วเราจะเอาไปใช้งานที่ไหน???

account ที่เราสร้างขึ้นจะใช้ได้กับระบบ sandbox เท่านั้น
```
https://sandbox.paypal.com/
```

เป็นอันเสร็จสิ้นสำหรับการเตรียมทรัพยากรณ์ Paypal ที่จะใช้ในการพัฒนา


# การเขียนติดต่อ Paypal ฝั่ง serverside (PHP)

จาก sourcecode ตัวอย่าง จะต้องไปโหลด paypay-php-sdk มา ซึ่งในที่นี้เราได้โหลดลงมาเรียบร้อยแล้ว แต่ถ้าอยากลงในรายละเอียดเพิ่มเติม สามารถหาข้อมูลเพิ่มเติ่มได้ที่ https://github.com/paypal/PayPal-PHP-SDK

ฝั่ง serverside เราต้องทำอะไรบ้าง???

## เขียน php ขึ้นมา 1 ไฟล์ เพื่อให้ Ionic Application เรียกใช้งาน 

จากตัวอย่างนี้ คือการ create order แล้วจ่ายเงินด้วย Paypal 

scope ที่ทำในตัวอย่างนี้ จะไม่ได้ทำการต่อ database เพื่อ create, update order แต่เราจะทำ api 1 ตัวให้ Ionic Application เรียกใช้ และทำการเรียกใช้ API ของ Paypal อีกที

## ทำไมเราต้องทำผ่าน serverside ด้วย???
ใน Ionic Framework เอง ก็มี Paypal plugin เหมือนกัน https://ionicframework.com/docs/v3/native/paypal/ ทำไมเราไม่ใช้อันนี้???

เนื่องด้วยการทำงานจริง เราจะต้องทำการเช็คค่าความถูกต้องต่าง ๆ เช่น เป็นลูกค้าจริงไหม,​มี order จริงไหม, ราคาเท่านี้จริงไหม .... หากเรายิงเรียก Paypal ผ่าน Application ตรง ๆ เลย มันไม่มีการเช็คค่าความถูกต้อง เราเลยต้องทำผ่าน serverside

## ทำผ่าน serverside ทำอะไรบ้าง
```
1. api ให้ Ionic Application และทำการปั้นรายละเอียดการสั่งซื้อ ส่งไปยัง Paypal (ในตัวอย่าง file ชื่อว่า first.php)
2. url สำหรับ ให้ Paypal redirect กลับมา เมื่อทำการจ่ายเงินสำเร็จ (ในตัวอย่าง file ชื่อว่า return.php)
3. url สำหรับ cancel order (ในตัวอย่าง file ชื่อว่า cancel.php) อันนี้ต้องศึกษาเพิ่มเติมต่อเองนะ
```

## api ให้ Ionic Application และทำการปั้นรายละเอียดการสั่งซื้อ ส่งไปยัง Paypal (ในตัวอย่าง file ชื่อว่า first.php)

อธิบาย code กันเลย

set allow-origin เพื่อให้ Ionic Application เรียกใช้งานได้
```
header("Access-Control-Allow-Origin: *");
$response = array();
```
---
import library ของ Paypal เข้ามา

```
require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
```
---
Client Id และ Secret เราจะต้องเอา code จากที่เราสร้างในขั้นตอนด้านต้นมาแทนค่าในส่วนนี้
```
// After Step 1
$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AWlB_UEAY46sVBcdBfjlsUdOrvFI8dRtOfS_XkyXXkLHCoaqsxev9AlzRhk2KlurpSynYk9RGytkWPTs',     // ClientID
            'EPaBfjhfyuH3KIeyW0Jpk4pkBkDR6J23kx5ZnywfR8keOlsS758FRX0zFiV2mZ1t620zqX9ky6VESe6D'      // ClientSecret
        )
);
```
---
เรียกใช้งาน api Paypal 
```
// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');
```

---

$amount จำเป็น จำนวนเงินที่ต้องจ่ายใน order นั้น ๆ แล้วทำการ set ค่า amount เข้าไปใน transaction อีกต่อนึง
```
$amount = new \PayPal\Api\Amount();
$amount->setTotal('100.00'); // จำนวนเงิน
$amount->setCurrency('THB'); // สกุลเงิน (THB) is Thailand Baht

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);
```

---

set redirect url และ cancel url
```
$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://www.zp11107.tld.122.155.17.167.no-domain.name/paypal-2019/return.php")
    ->setCancelUrl("http://www.zp11107.tld.122.155.17.167.no-domain.name/paypal-2019/cancel.php");
```

---

set intent เป็น 'sale' และ add ค่าต่าง ๆ เข้าไปตามคู่มือของ Paypal
```
$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
```

---

create order ที่ paypal แล้ว paypal จะตอบกลับมาเราเก็บใส่ตัวแปรที่ชื่อว่า $payment หากลอง print ดู เราจะเห็นข้อมูล order เยอะแยะ แต่ที่เราต้องใช้คือ approve url จาก paypal ซึ่งเราจะต้องทำการ redirect ไปที่หน้า paypal
```
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
```

---

approve url จาก paypal ซึ่งเราจะต้องทำการ redirect ไปที่หน้า paypal
```
$response['approval_url'] = $payment->getApprovalLink();
```

---

สุดท้าย ตอบกลับข้อมูลไปยัง ionic application
```
echo json_encode($response);
exit;
```

มาลองกัน ว่ามันทำงานยังไง

เมื่อเราได้ approve url มาแล้ว เราจะทำการ test แบบบ้าน ๆ กัน คือ เอา url นั้นไปแปะที่ browser ดู

เมื่อทำการจ่ายเงินเสร็จ ทาง paypal ก็จะ redirect กลับมาที่ return.php ที่เราสร้างไว้รองรับ โดยต่อท้าย parameter paymentId, token, PayerID มาให้ด้วย เพื่อที่เราจะเอาค่าจากตัวแปรพวกนี้ไปดึงข้อมูลรายละเอียดของ order จาก paypal

```
http://www.zp11107.tld.122.155.17.167.no-domain.name/paypal-2019/return.php?paymentId=PAYID-LW7SRAY07669478RK1839159&token=EC-63951058SE376263X&PayerID=7A6WWD669ZWTU
```

การเขียนจะคล้าย ๆ กับ first.php

แต่จะมีตรงจุดนี้ เพื่อ confirm order กับทาง paypal
```
$result = $payment->execute($execution, $apiContext);
```

ส่วนรายละเอียด และความหมายของ ข้อมูลที่ response มา เช่น status ของ order ชำระเงินสำเร็จหรือไม่ สามารถศึกษาเพิ่มเติมได้จาก document ของ paypal

```
https://developer.paypal.com/docs/api/overview/
```