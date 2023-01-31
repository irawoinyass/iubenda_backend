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

$data = json_decode(file_get_contents("php://input"));

//Small Validation
if ($data->old_password == "") {
    echo json_encode(array('message' => 'Old Password Field is required!'));
} else if ($data->password == "") {
    echo json_encode(array('message' => 'Password Field is required!'));
} else {

    $people->people_id = $data->people_id;

    $people->password_reset();

    //Old Password Validation

    if (password_verify($data->old_password, $people->password)) {

        //new password hash
        $people->password = password_hash($data->password, PASSWORD_DEFAULT);


        if ($people->update_password()) {
            echo json_encode(array('message' => 'success'));
        } else {
            echo json_encode(array('message' => 'Error, Please Try Again'));
        }
    } else {
        echo json_encode(array('message' => 'Invalid Old Password'));
    }
}
