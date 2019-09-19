<?php
    // Header
    header('Access-Control-Alllow-Origin: *');
    header('Content-Type: application/JSON');

    include_once '../../config/Database.php';
    include_once '../../models/Employees.php';

    // Instance DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instance Employee Object
    $employees = new Employees($db);

    //GET Employee Number
    $employees->employeeNumber = isset($_GET['id']) ? $_GET['id'] : die();

    //GET Employee
    $employees->read_single();

    //Create Array
    $employee_arr = array(
        'employeeNumber' => $employees->employeeNumber,
        'lastName' => $employees->lastName,
        'firstName' => $employees->firstName,
        'extension' => $employees->extension,
        'email' => $employees->email,
        'officeCode' => $employees->officeCode,
        'reporstTo' => $employees->reportsTo,
        'jobTitle' => $employees->jobTitle
    );

    //Make JSON
    print_r(json_encode($employee_arr));