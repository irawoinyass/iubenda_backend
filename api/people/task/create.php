<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include('../../../config/Database.php');
include('../../../models/people/Task.php');
include('../../../models/people/People.php');
include('../../../models/people/Collaborator.php');

//Database Instance
$database = new Database();
$db = $database->connect();


//Task Model Instance
$task = new Task($db);

//People Model Instance
$people = new People($db);

//Collaborator Model Instance
$collabo = new Collaborator($db);


//Get Data

$data = json_decode(file_get_contents("php://input"));

//Small Validation
if ($data->headline == "") {
    echo json_encode(array('message' => 'Headline Field is required!'));
} else if ($data->description == "") {
    echo json_encode(array('message' => 'Description Field is required!'));
} else if ($data->due_date == "") {
    echo json_encode(array('message' => 'Due Date Field is required!'));
} else if ($data->solved == "") {
    echo json_encode(array('message' => 'Solved Field is required!'));
} else {

    //Collaborators

    //Checjing if collaborators field is not empty, to avoid errors
    if (count(explode(',', $data->collaborators)) == 0) {
        $exp_col = explode(',', $data->email);
    } else {
        $exp_col = explode(',', $data->collaborators . ',' . $data->email);
    }

    $people->collaborators2 = $exp_col;
    $people->collaborators = str_repeat('?, ',  count($exp_col) - 1) . '?';

    //Fetching people to get their unique id
    $result = $people->fetch_users();
    //Counting fetch users data to know the actual count of the collaborators
    $total_collaborator = $result->rowCount();
    //countting all existing tasks to dectect the next task id.
    $count_all_tasks = $task->count_all();
    $task_id = $count_all_tasks->rowCount() + 1;

    //Declaration task data
    $task->headline = $data->headline;
    $task->description = $data->description;
    $task->due_date = $data->due_date;
    $task->collaborators = $total_collaborator;
    $task->solved = $data->solved;
    $task->col_draft = $data->collaborators;
    $task->created_at = date('Y-m-d H:i:s');
    //Ends

    foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {

        //Declaration task data
        $collabo->t_id = $task_id;
        $collabo->p_id = $row['people_id'];
        $collabo->c_id = $row['com_id'];
        $collabo->created_at = date('Y-m-d H:i:s');
        $collabo->create();
        //Ends

    }

    //Collaborator Ends

    //

    if ($task->create()) {
        echo json_encode(array('message' => 'success'));
    } else {
        echo json_encode(array('message' => 'Error, Please Try Again'));
    }
}
