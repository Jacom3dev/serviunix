<?php

namespace App\Controllers;

use App\Models\Gender;
use App\Helpers\Response;

class GenderController
{

    public function getGenders()
    {
        try {
            $genders = Gender::get();
            return Response::json($genders, 200);
        } catch (\Exception $e) {
            return Response::json([
                'error' => 'Error al obtener los generos',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
