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

$task->p_id = $data->p_id;

//Task Record Query
$result = $task->dashboard_list();

//Get Row Count
$num = $result->rowCount();

//checking if the users table is not empty

if ($num > 0) {

    //users array

    $task_arr = array();
    $task_arr['data'] = array();
    $row_id = 1;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //extraction

        extract($row);

        $task_item = array(
            'row_id' => $row_id,
            'task_id' => $task_id,
            'headline' => $headline,
            'description' => $description,
            'due_date' => $due_date,
            'collaborators' => $collaborators,
            'col_draft' => $col_draft,
            'solved' => $solved,
            'created_at' => $created_at
        );
        $row_id++;
        //Push to data

        array_push($task_arr['data'], $task_item);

        //Converting it to JSON and OutPUT

    }
    echo json_encode($task_arr);
} else {

    echo json_encode(['message' => 'NO RECORD FOUND']);
}
