<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include('../../../config/Database.php');
include('../../../models/people/Task.php');
include('../../../models/people/Collaborator.php');

//Database Instance
$database = new Database();
$db = $database->connect();

//Task Model Instance
$task = new Task($db);
//Collaborator Model Instance
$collaborator = new Collaborator($db);

//Get Data
$data = json_decode(file_get_contents("php://input"));

$task->task_id = $data->id;
$collaborator->t_id = $data->id;

if ($collaborator->delete()) {
    $task->delete();
    echo json_encode(array('message' => 'success'));
} else {
    echo json_encode(array('message' => 'Error, Please Try Again'));
}
