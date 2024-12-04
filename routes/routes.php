<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

use App\Controllers\EmployeeController;
use App\Controllers\GenderController;
use App\Controllers\DepartmentController;

$employeeController = new EmployeeController();
$genderController = new GenderController();
$departmentController = new DepartmentController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = trim($_SERVER['REQUEST_URI'], '/');

$data = [];



if ($requestMethod === 'POST' || $requestMethod === 'PUT') {
    $inputData = file_get_contents("php://input");

    if ($inputData) {
        $data = json_decode($inputData, true);  
    }
}

$uriFound = false;

if ($requestMethod == "OPTIONS") {
    http_response_code(200);
    return;
}

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
        if (preg_match('/^serviunix\/employee\/(\d+)$/', $uri, $matches)) {
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

