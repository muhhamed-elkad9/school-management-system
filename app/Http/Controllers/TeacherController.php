<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher  = $Teacher;
    }

    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();

        return view('teachers.teachers', compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Genders = $this->Teacher->GetGender();
        $specializations = $this->Teacher->Getspecialization();
        return view('teachers.create', compact('Genders', 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Teacher->StoreTeachers($request);

        return redirect()->route('teachers.index')->with(['add' => __('teachers/teachers.Add')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Teachers = Teacher::find($id);
        $Genders = $this->Teacher->GetGender();
        $specializations = $this->Teacher->Getspecialization();

        return view('teachers.update', compact('Teachers', 'Genders', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->Teacher->UpdateTeachers($request, $id);

        return redirect()->route('teachers.index')->with(['edit' => __('teachers/teachers.edit')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Teacher->DeleteTeachers($id);

        return redirect()->route('teachers.index')->with(['deleted' => __('teachers/teachers.deleted')]);
    }
}
