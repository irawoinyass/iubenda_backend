<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include('../../../config/Database.php');
include('../../../models/admin/Tasks.php');

//Database Instance
$database = new Database();
$db = $database->connect();

//Task Model Instance
$task = new Tasks($db);

//Task Record Query
$result = $task->list();

//Get Row Count
$num = $result->rowCount();

if ($num > 0) {

    //users array
    $row_id = 1;
    $task_arr = array();
    $task_arr['data'] = array();

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
