<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class studentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        // return "GET / Students List from Controller";

        if ($students->isEmpty()) {
            $data = [
                "message" => "Table Students is Empty",
                "status" => 200,
            ];
            return response()->json(
                $data,
                200
            );
        }

        $data = [
            "students" => $students,
            "status" => 200,
        ];

        return response()->json(
            [
                "students" => $students,
            ],
            200
        );
    }
}
