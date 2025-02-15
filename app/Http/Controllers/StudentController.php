<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Student;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Http\Resources\ClassesResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studentsQuery = Student::search($request);

        $students = StudentResource::collection($studentsQuery->paginate(10));

        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Index', [
            'students' => $students,
            'search' => $request->search ?? '',
            'class_id' => $request->class_id ?? '',
            'classes' => $classes
        ]);
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Create', [
            'classes' => $classes
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Edit', [
            'student' => StudentResource::make($student),
            'classes' => $classes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
