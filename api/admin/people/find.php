<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../../config/Database.php');
include('../../../models/admin/People.php');

//Database Instance
$database = new Database();
$db = $database->connect();


//People Model Instance
$people = new People($db);

//GET ID
$people->people_id = isset($_GET['id']) ? $_GET['id'] : die();

//Get people
$people->find();

//Create Array

$people_arr = array(

    'people_id' => $people->people_id,
    'name' => $people->name,
    'email' => $people->email,
    'gender' => $people->gender,
    'date_of_birth' => $people->date_of_birth,
    'com_id' => $people->com_id,
    'position' => $people->position,
    'account_status' => $people->account_status,
    'password' => $people->password,
    'created_at' => $people->created_at

);


//Make JSON

echo json_encode($people_arr);
