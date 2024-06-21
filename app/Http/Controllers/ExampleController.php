<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    //
    public function __construct()
    {
        // Usa el middleware 'example' en todos los métodos de este controlador
        // $this->middleware('example');
    }

    public function index()
    {
        return response()->json(
            [
                "message" => "GET / Example"
            ],
            200
        );
    }

    public function noAccess()
    {
        return response()->json(
            [
                "message" => "GET / No Access"
            ],
            403
        );
    }
}
