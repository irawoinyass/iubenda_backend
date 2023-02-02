<?php

//A Person Login Auth

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


//People Model Instance
$user = new People($db);


//Get Data

$data = json_decode(file_get_contents("php://input"));

//Tokens
$str = rand();
$tokens = hash("sha256", $str);

// Removing all illegal characters from email
$email = filter_var($data->email, FILTER_SANITIZE_EMAIL);



//Small Validation
if ($email == "") {
    echo json_encode(array('message' => 'Email Field is required!'));
} else if ($data->password == "") {
    echo json_encode(array('message' => 'Password Field is required!'));
} else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo json_encode(array('message' => 'Invalid email address'));
} else {


    $user->email = $email;
    $user->login();


    //Email Address Response
    if ($user->count == 0) {
        echo json_encode(array('message' => 'Invalid Email Address'));
    } else {

        //Password Verification

        if (password_verify($data->password, $user->password)) {
            // If the password inputs matched the hashed password in the database

            //Create Array

            $user_data = array(

                'people_id' => $user->people_id,
                'name' => $user->name,
                'email' => $user->email,
                'gender' => $user->gender,
                'date_of_birth' => $user->date_of_birth,
                'com_id' => $user->com_id,
                'position' => $user->position,
                'account_status' => $user->account_status,
                'created_at' => $user->created_at

            );


            //Make JSON

            echo json_encode(array('message' => 'success', 'tokens' => $tokens, 'data' => $user_data));
        } else {

            echo json_encode(array('message' => 'Invalid Password'));
        }
    }
}
