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

//Small Validation
if ($data->name == "") {
    echo json_encode(array('message' => 'Company Name Field is required!'));
} else if ($data->email == "") {
    echo json_encode(array('message' => 'Company Email Address Field is required!'));
} else if ($data->address == "") {
    echo json_encode(array('message' => 'Company Address Field is required!'));
} else if ($data->phone == "") {
    echo json_encode(array('message' => 'Company Phone Number Field is required!'));
} else if ($data->website == "") {
    echo json_encode(array('message' => 'Company Website Field is required!'));
} else {

    //Declaration
    $company->company_id = $data->company_id;
    $company->company_name = $data->name;
    $company->company_email = $data->email;
    $company->company_address = $data->address;
    $company->company_phone = $data->phone;
    $company->company_website = $data->website;




    if ($company->update()) {
        echo json_encode(array('message' => 'success'));
    } else {
        echo json_encode(array('message' => 'Error, Please Try Again'));
    }

    ///
}
