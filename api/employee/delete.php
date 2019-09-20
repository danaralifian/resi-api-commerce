<?php
    // Header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/JSON');
    header('Access-Control-Allow-Methods: DELETE');
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

    if ($employees->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Deleted')
        );
    }
