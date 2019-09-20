<?php
    // Header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/JSON');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
            Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Employees.php';

    // Instance DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instance Employee Object
    $employees = new Employees($db);

    // GET raw employee data
    $data = json_decode(file_get_contents("php://input"));

    // SET ID to Update (employeeNumber=>ID)
    $employees->id = $data->id;

    $employees->employeeNumber = $data->employeeNumber;
    $employees->lastName = $data->lastName;
    $employees->firstName = $data->firstName;
    $employees->extension = $data->extension;
    $employees->email = $data->email;
    $employees->officeCode = $data->officeCode;
    $employees->reportsTo = $data->reportsTo;
    $employees->jobTitle = $data->jobTitle;

    if ($employees->update()) {
        echo json_encode(
            array('message' => 'Post Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Updated')
        );
    }
