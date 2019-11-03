<?php

header("Access-Control-Allow-Origin: *");

$conn = mysqli_connect("localhost", "zp11107_ionic","RbXJdCy9uUi6FCcj","zp11107_ionic");
mysqli_query($conn, 'set names utf8');

// Check connection
if (!$conn) {
    $res = [
      'status' => 'error',
      'message' => 'can not connect database'
    ];
    echo json_encode($res);
    exit;
}

$rawData = file_get_contents("php://input");
$postData = json_decode($rawData, true);

$email = isset($postData['email']) ? $postData['email'] : '';
$pwd= isset($postData['pwd']) ? $postData['pwd'] : '';
$status = 'no';

if($email === '' || $pwd === '') {
  $res = [
    'status' => 'error',
    'message' => 'empty parameter'
  ];
  echo json_encode($res);
  exit;
}

$sql = "
INSERT INTO tbl_Rmember (
	email,password,status
) VALUES (
  '".$email."', 
  '".$pwd."',
  '".$status."'
)
";

if ($conn->query($sql) === TRUE) {
  $conn->close();
  $res = [
    'status' => 'success',
    'message' => ''
  ];
  echo json_encode($res);
  exit;
} else {
  $res = [
    'status' => 'error',
    'message' => $conn->error
  ];
  $conn->close();
  echo json_encode($res);
  exit;
}

?>
