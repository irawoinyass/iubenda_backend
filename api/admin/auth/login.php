<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


//Tokens
$str = rand();
$tokens = hash("sha256", $str);


//Get Data

$data = json_decode(file_get_contents("php://input"));


if ($data->email == '') {
    echo json_encode(array('message' => 'Username field is required!'));
} else if ($data->password == '') {
    echo json_encode(array('message' => 'Password field is required!'));
} else {

    if (strtolower($data->email) == 'admin@gmail.com' and strtolower($data->password) == '12345678') {
        echo json_encode(array('message' => 'success', 'tokens' => $tokens));
    } else {
        echo json_encode(array('message' => 'invalid credentials'));
    }
}
