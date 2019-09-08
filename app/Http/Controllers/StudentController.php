<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentFormRequest;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(5);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentFormRequest $request)
    {
        $validatedData = $request->validated();

        // Handle the user upload of avatar
        if($request->hasFile('sign')){
            $avatar = $request->file('sign');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(100, 100)->save( public_path().'/images/' . $filename );

            $validatedData['sign']=$filename;
        }

        Student::create($validatedData);

        return redirect('students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentFormRequest $request
     * @param  \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentFormRequest $request, Student $student)
    {
        $validatedData = $request->validated();


        // Handle the user upload of avatar
        if($request->hasFile('sign')){
            $avatar = $request->file('sign');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(100, 100)->save( public_path().'/images/' . $filename );

            $validatedData['sign']=$filename;
        }

        $student->update($validatedData);

        return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student $student
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('students');
    }
}
