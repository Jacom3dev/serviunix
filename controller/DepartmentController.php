<?php

namespace App\Controllers;

use App\Models\Department;
use App\Helpers\Response;

class DepartmentController
{

    public function getDepartments()
    {
        try {
            $departments = Department::get();
            return Response::json($departments, 200);
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al obtener los departamentos',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
