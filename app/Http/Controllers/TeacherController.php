<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeachers;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('teachers.teachers', compact('Teachers'));
    }

    public function create()
    {
        $specializations = $this->Teacher->Getspecialization();
        $Genders = $this->Teacher->GetGender();
        return view('teachers.create', compact('specializations', 'Genders'));
    }

    public function store(Request $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }

    public function edit($id)
    {
        $Teachers = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->Getspecialization();
        $Genders = $this->Teacher->GetGender();
        return view('teachers.update', compact('Teachers', 'specializations', 'Genders'));
    }

    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }
}
