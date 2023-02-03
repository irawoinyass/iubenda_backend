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

//GET ID
$company->company_id = isset($_GET['id']) ? $_GET['id'] : die();

//Get Company
$company->find();

//Create Array

$company_arr = array(

    'company_id' => $company->company_id,
    'company_name' => $company->company_name,
    'company_email' => $company->company_email,
    'company_phone' => $company->company_phone,
    'company_address' => $company->company_address,
    'company_website' => $company->company_website,
    'created_at' => $company->created_at

);


//Make JSON

echo json_encode($company_arr);
