<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../../config/Database.php');
include('../../../models/people/Task.php');

//Database Instance
$database = new Database();
$db = $database->connect();


//Task Model Instance
$task = new Task($db);

//GET ID
$task->task_id = isset($_GET['id']) ? $_GET['id'] : die();

//Get task$task
$task->find();

//Create Array

$task_arr = array(

    'task_id' => $task->task_id,
    'headline' => $task->headline,
    'description' => $task->description,
    'due_date' => $task->due_date,
    'collaborators' => $task->collaborators,
    'col_draft' => $task->col_draft,
    'solved' => $task->solved,
    'created_at' => $task->created_at

);


//Make JSON

echo json_encode($task_arr);
