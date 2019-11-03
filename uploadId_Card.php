<?php

header('Access-Control-Allow-Origin:*');

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




$name = $_FILES["ionicfile"]["name"];
$ext = end((explode(".", $name)));

$target_dir = "/home/zp11107/domains/zp11107.tld/public_html/contents/";
$fileName = uniqid() . '.' . $ext;
$target_file = $target_dir . $fileName;

if (move_uploaded_file($_FILES["ionicfile"]["tmp_name"], $target_file)) {
  
  $sql = "
  INSERT INTO tbl_Rmember (
    image_path
  ) VALUES (
    '/contents/".$fileName."')";

  if ($conn->query($sql) === false) {
    $res = [
      'status' => 0,
      'message' => $conn->error
    ];
    $conn->close();
    echo json_encode($res);
    exit;
  }

  $sql = "
  SELECT image_path
  FROM tbl_Rmember
   LIMIT 1
  ";

  $rs = $conn->query($sql);

  if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc();
  } else {
    $res = [
      'status' => 0,
      'message' => 'data not found'
    ];
    echo json_encode($res);
    exit;
  }

	$response = array(
		'status' => 1,
		'Path_img' => 'http://zp11107.tld.122.155.17.167.no-domain.name' . $row['Path_img']
	);
} else {
	$response = array(
		'status' => 0,
		'Path_img' => ''
	);
}

echo json_encode($response);


?>

