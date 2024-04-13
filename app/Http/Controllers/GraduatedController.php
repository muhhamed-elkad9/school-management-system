<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('Graduated.index', compact('students'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('Graduated.create', compact('Grades'));
    }

    public function store(Request $request)
    {
        $students = Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();

        if ($students->count() < 1) {
            toastr()->success(__('messages.Err_Graduated'));
            return redirect()->back();
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            Student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(__('messages.success'));
        return redirect()->route('Graduated.index');
    }

    public function update(Request $request, $id)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();

        toastr()->success(__('messages.Update'));
        return redirect()->route('Graduated.index');
    }

    public function destroy(Request $request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();

        toastr()->success(__('messages.Delete'));
        return redirect()->route('Graduated.index');
    }
}
