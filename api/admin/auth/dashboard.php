<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../../config/Database.php');
include('../../../models/admin/Company.php');
include('../../../models/admin/People.php');
include('../../../models/admin/Tasks.php');

$row_id = 1;
$row_count = 1;
//Database Instance
$database = new Database();
$db = $database->connect();

//Company Model Instance
$company = new Company($db);
//Company Record Query
$company_result = $company->list();
//Get Company Total Count
$company_count = $company_result->rowCount();

$company_dash_result = $company->dashboard_list();
//Get Company Total Count
$company_dash_count = $company_dash_result->rowCount();


//People Model Instance
$people = new People($db);
//People Record Query
$people_result = $people->list();
//Get total Count
$people_count = $people_result->rowCount();
//People Record Query
$people_dash_result = $people->dashboard_list();
//Get total Count
$people_dash_count = $people_dash_result->rowCount();

//Task Model Instance
$task = new Tasks($db);

//Task Record Query
$task_result = $task->list();

//Get Row Count
$task_count = $task_result->rowCount();


//getting company list for dashboard

if ($company_dash_count > 0) {

    //users array

    $company_arr = array();
    $company_arr['data'] = array();

    while ($row = $company_dash_result->fetch(PDO::FETCH_ASSOC)) {
        //extraction

        extract($row);

        $company_item = array(
            'row_id' => $row_id,
            'company_id' => $company_id,
            'company_name' => $company_name,
            'company_email' => $company_email,
            'company_phone' => $company_phone,
            'company_address' => $company_address,
            'company_website' => $company_website,
            'people' => $people,
            'tasks' => $tasks,
            'created_at' => $created_at
        );

        $row_id++;

        //Push to data

        array_push($company_arr['data'], $company_item);

        //Converting it to JSON and OutPUT

    }
    $company_data = $company_arr;
} else {

    $company_data = 'NO RECORD FOUND';
}


//getting 10 data from people for dashboard
if ($people_dash_count > 0) {

    //users array

    $people_arr = array();
    $people_arr['data'] = array();

    while ($row = $people_dash_result->fetch(PDO::FETCH_ASSOC)) {
        //extraction

        extract($row);

        $people_item = array(
            'row_id' => $row_count,
            'people_id' => $people_id,
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'com_id' => $com_id,
            'position' => $position,
            'account_status' => $account_status,
            'created_at' => $created_at

        );
        $row_count++;
        //Push to data

        array_push($people_arr['data'], $people_item);

        //Converting it to JSON and OutPUT

    }
    $people_data = $people_arr;
} else {

    $people_data = 'NO RECORD FOUND';
}




echo json_encode(array("company_count" => $company_count, "people_count" => $people_count, "task_count" => $task_count, 'company_data' => $company_data, 'people_data' => $people_data));
