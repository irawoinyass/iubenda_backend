<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../../config/Database.php');
include('../../../models/admin/Company.php');

//Database Instance
$database = new Database();
$db = $database->connect();


//Company Model Instance
$company = new Company($db);

//Company Record Query
$result = $company->list();

//Get Row Count
$num = $result->rowCount();

//checking if the users table is not empty

if ($num > 0) {

    //users array

    $company_arr = array();
    $company_arr['data'] = array();
    $row_id = 1;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
    echo json_encode($company_arr);
} else {

    echo json_encode(['message' => 'NO RECORD FOUND']);
}
