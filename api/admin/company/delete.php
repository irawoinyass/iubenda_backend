<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include('../../../config/Database.php');
include('../../../models/admin/Company.php');

//Database Instance
$database = new Database();
$db = $database->connect();


//Company Model Instance
$company = new Company($db);


//Get Data

$data = json_decode(file_get_contents("php://input"));

// echo json_encode($data);

//Declaration
$company->company_id = $data->company_id;




if ($company->delete()) {
    echo json_encode(array('message' => 'success'));
} else {
    echo json_encode(array('message' => 'Error, Please Try Again'));
}
