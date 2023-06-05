<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();
        if (count($student) > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'student' => $student
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'No record found'
                ],
                404
            );
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'course' => 'required|max:255',
                'roll' => 'required|digits:10',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'course' => $request->course,
                'roll' => $request->roll
            ]);
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => "Student Create susseccfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'status' => 200,
                'message' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Not found student"
            ], 404);
        }
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'status' => 200,
                'message' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Not found student"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'course' => 'required|max:255',
                'roll' => 'required|digits:10',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $student = Student::find($id);

            if ($student) {
            $student->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'course' => $request->course,
                    'roll' => $request->roll
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Student updated susseccfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Something went wrong"
                ], 404);
            }
        }
    }
    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();
        if ($student) {
            return response()->json([
                'status' => 200,
                'message' => "Student deleted susseccfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Something went wrong"
            ], 404);
        }
    }
}
