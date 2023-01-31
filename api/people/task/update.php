<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include('../../../config/Database.php');
include('../../../models/people/Task.php');

//Database Instance
$database = new Database();
$db = $database->connect();

//Get Data
$data = json_decode(file_get_contents("php://input"));


//Task Model Instance
$task = new Task($db);

//Declaration task data
$task->task_id = $data->task_id;
$task->headline = $data->headline;
$task->description = $data->description;
$task->due_date = $data->due_date;
$task->solved = $data->solved;

if ($task->update()) {
    echo json_encode(array('message' => 'success'));
} else {
    echo json_encode(array('message' => 'Error, Please Try Again'));
}
