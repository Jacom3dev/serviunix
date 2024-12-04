<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Helpers\Response;

class EmployeeController
{
    public function createEmployee(array $data)
    {
        if (empty($data['firstName']) || empty($data['lastName']) || empty($data['hireDate']) || empty($data['comments']) || empty($data['genderId']) || empty($data['departmentId'])) {
            return Response::json([
                'error' => 'Todos los campos son obligatorios.',
                'message' => 'Asegúrese de proporcionar firstName, lastName, hireDate, comments, genderId y departmentId.'
            ], 400);
        }
    
        try {
            $employee = Employee::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'hireDate' => $data['hireDate'],
                'comments' => $data['comments'],
                'genderId' => $data['genderId'],
                'departmentId' => $data['departmentId']
            ]);

            return Response::json($employee, 201);
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al crear el empleado',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getEmployees()
    {
        try {
            $employees = Employee::with(['department', 'gender'])->get();
            return Response::json($employees, 200);
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al obtener los empleados',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getEmployee($id)
    {
        try {
            $employee = Employee::find($id);
            if ($employee) {
                return Response::json($employee, 200);
            }

            return Response::notFound('Employee not found');
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al obtener el empleado',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateEmployee($id, array $data)
    {
        try {
            $employee = Employee::find($id);
            if ($employee) {
                $employee->update([
                    'firstName' => $data['firstName'],
                    'lastName' => $data['lastName'],
                    'hireDate' => $data['hireDate'],
                    'comments' => $data['comments'],
                    'genderId' => $data['genderId'],
                    'departmentId' => $data['departmentId']
                ]);

                return Response::json($employee, 200);
            }

            return Response::notFound('Employee not found');
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al actualizar el empleado',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEmployee($id)
    {
        try {
            $employee = Employee::find($id);
            if ($employee) {
                $employee->delete();
                return Response::json(['message' => 'Employee deleted'], 200);
            }

            return Response::notFound('Employee not found');
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al eliminar el empleado',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
