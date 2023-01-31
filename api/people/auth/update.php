<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include('../../../config/Database.php');
include('../../../models/people/People.php');

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
} else {

    //Declaration
    $people->people_id = $data->people_id;
    $people->name = $data->name;
    $people->email = $data->email;
    $people->gender = $data->gender;
    $people->date_of_birth = $data->date_of_birth;




    if ($people->update()) {
        echo json_encode(array('message' => 'success'));
    } else {
        echo json_encode(array('message' => 'Error, Please Try Again'));
    }

    ///
}
