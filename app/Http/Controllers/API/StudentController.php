<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Validator;
use App\Http\Resources\StudentResource;
use Illuminate\Http\JsonResponse;

class StudentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
    
        return $this->sendResponse(StudentResource::collection($students), 'Students retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'student_id' => 'required',
            'cgpa'=>'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $student = Student::create($input);
   
        return $this->sendResponse(new StudentResource($student), 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
  
        if (is_null($student)) {
            return $this->sendError('Student not found.');
        }
   
        return $this->sendResponse(new StudentResource($student), 'Student retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'student_id' => 'required',
            'cgpa'=>'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $student->name =$input['name'];
        $student->student_id = $input['student_id'];
        $student->cgpa=$input['cgpa'];
        $student->save();
   
        return $this->sendResponse(new StudentResource($student), 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
   
        return $this->sendResponse([], 'Student deleted successfully.');
    }
}
