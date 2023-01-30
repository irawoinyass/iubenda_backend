<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include('../../../config/Database.php');
include('../../../models/admin/People.php');

//Database Instance
$database = new Database();
$db = $database->connect();


//Company Model Instance
$people = new People($db);


//Get Data

$data = json_decode(file_get_contents("php://input"));

//Small Validation
if ($data->name == "") {
    echo json_encode(array('message' => 'Name Field is required!'));
} else if ($data->email == "") {
    echo json_encode(array('message' => 'Email Address Field is required!'));
} else if ($data->gender == "") {
    echo json_encode(array('message' => 'Gender Field is required!'));
} else if ($data->date_of_birth == "") {
    echo json_encode(array('message' => 'Date of Birth Number Field is required!'));
} else if ($data->com_id == "") {
    echo json_encode(array('message' => 'Company Field is required!'));
} else if ($data->position == "") {
    echo json_encode(array('message' => 'Position Field is required!'));
} else if ($data->account_status == "") {
    echo json_encode(array('message' => 'Account Status Field is required!'));
} else if ($data->password == "") {
    echo json_encode(array('message' => 'Password Field is required!'));
} else if ($data->people_id == "") {
    echo json_encode(array('message' => 'People ID is required!'));
} else {

    //Declaration
    $people->people_id = $data->people_id;
    $people->name = $data->name;
    $people->email = $data->email;
    $people->gender = $data->gender;
    $people->date_of_birth = $data->date_of_birth;
    $people->com_id = $data->com_id;
    $people->position = $data->position;
    $people->account_status = $data->account_status;
    $people->password = password_hash($data->password, PASSWORD_DEFAULT);


    //echo json_encode(password_hash($data->password, PASSWORD_DEFAULT));


    if ($people->update()) {
        echo json_encode(array('message' => 'success'));
    } else {
        echo json_encode(array('message' => 'Error, Please Try Again'));
    }

    ///
}
