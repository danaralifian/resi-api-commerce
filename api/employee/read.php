<?php
    // Header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/JSON');

    include_once '../../config/Database.php';
    include_once '../../models/Employees.php';

    // Instance DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instance Employee Object
    $employees = new Employees($db);

    // Employee Query
    $result = $employees->read();
    //Get Row Count
    $num = $result->rowCount();

    // Check if employee exist
    if ($num>0) {
        //Post Array
        $employees_arr = array();
        $employees_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $employee_item = array(
                'employeeNumber' => $employeeNumber,
                'lastName' => $lastName,
                'firstName' => $firstName,
                'extension' => $extension,
                'email' => $email,
                'officeCode' => $officeCode,
                'reporstTo' => $reportsTo,
                'jobTitle' => $jobTitle
            );

            // PUSH to data
            //array_push($employees_arr, $employee_item);
            array_push($employees_arr['data'], $employee_item);
        }

        // Turn To JSON & Output
        echo json_encode($employees_arr);
    } else {
        echo json_encode(
            array('message' => 'No Employee Found')
        );
    }