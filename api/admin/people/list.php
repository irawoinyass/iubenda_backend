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

//People Record Query
$result = $people->list();

//Get Row Count
$num = $result->rowCount();

//checking if the users table is not empty

if ($num > 0) {

    //users array
    $row_id = 1;
    $people_arr = array();
    $people_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //extraction

        extract($row);

        $people_item = array(
            'row_id' => $row_id,
            'people_id' => $people_id,
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'company_name' => $company_name,
            'com_id' => $com_id,
            'position' => $position,
            'tasks' => $tasks,
            'account_status' => $account_status,
            'created_at' => $created_at

        );
        $row_id++;
        //Push to data

        array_push($people_arr['data'], $people_item);

        //Converting it to JSON and OutPUT

    }
    echo json_encode($people_arr);
} else {

    echo json_encode(['message' => 'NO RECORD FOUND']);
}
