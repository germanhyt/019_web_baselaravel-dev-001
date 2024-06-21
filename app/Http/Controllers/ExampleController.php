<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    //

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
