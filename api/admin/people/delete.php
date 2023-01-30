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


//Declaration
$people->people_id = $data->people_id;


if ($people->delete()) {
    echo json_encode(array('message' => 'success'));
} else {
    echo json_encode(array('message' => 'Error, Please Try Again'));
}

    ///
