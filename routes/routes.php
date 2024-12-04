<?php

use App\Controllers\EmployeeController;
use App\Controllers\GenderController;
use App\Controllers\DepartmentController;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = trim($_SERVER['REQUEST_URI'], '/');

$data = [];

if ($requestMethod === 'POST' || $requestMethod === 'PUT') {
    $inputData = file_get_contents("php://input");

    if ($inputData) {
        $data = json_decode($inputData, true);  
    }
}

$employeeController = new EmployeeController();
$genderController = new GenderController();
$departmentController = new DepartmentController();

$uriFound = false;

switch ($requestMethod) {
    case 'POST':
        if ($uri == 'serviunix/employee') {
            $employeeController->createEmployee($data); 
            $uriFound = true;
        }
        break;
        
    case 'GET':
        if ($uri == 'serviunix/employees') {
            $employeeController->getEmployees();
            $uriFound = true;
        }

        if ($uri == 'serviunix/genders') {
            $genderController->getGenders();
            $uriFound = true;
        }
        if ($uri == 'serviunix/departments') {
            $departmentController->getDepartments();
            $uriFound = true;
        }
        break;
        
    case 'PUT':
        if (preg_match('/^serviunix\/employees\/(\d+)$/', $uri, $matches)) {
            $employeeId = $matches[1];
            $employeeController->updateEmployee($employeeId, $data);
            $uriFound = true;
        }
        break;
        
    case 'DELETE':
        if (preg_match('/^serviunix\/employees\/(\d+)$/', $uri, $matches)) {
            $employeeId = $matches[1];
            $employeeController->deleteEmployee($employeeId);
            $uriFound = true;
        }
        break;
        
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        echo "Method Not Allowed";
        break;
}

if (!$uriFound) {
    header("HTTP/1.1 404 Not Found");
    echo "404 Not Found: La ruta solicitada no existe.";
}

