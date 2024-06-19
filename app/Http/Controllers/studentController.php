<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|max:255",
                "email" => "required|email|unique:student",
                "phone" => "required|digits:10",
                "language" => "required|in:English,Spanish"
            ]
        );

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Error",
                "errors" => $validator->errors(),
                "status" => 400
            ];

            return response()->json(
                $data,
                400
            );
        }

        // 1. 
        // $student = new Student();
        // $student->name = $request->name;
        // $student->email = $request->email;
        // $student->phone = $request->phone;
        // $student->save();
        // return response()->json([
        //     "message" => "Student Created",
        //     "status" => 200,
        // ]);

        // 2.
        $student = Student::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "language" => $request->language
        ]);

        if (!$student) {
            $data = [
                "message" => "Student not Created",
                "status" => 500,
            ];
            return response()->json(
                $data,
                500
            );
        }

        $data = [
            "student" => $student,
            "status" => 201,
        ];

        return response()->json(
            $data,
            201
        );
    }
}
