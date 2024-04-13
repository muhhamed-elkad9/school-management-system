<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subjects::all();
        return view('Subjects.index', compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('Subjects.create', compact('grades', 'teachers'));
    }

    public function store(Request $request)
    {
        $subjects = new Subjects();

        $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $subjects->grade_id = $request->Grade_id;
        $subjects->classroom_id = $request->Class_id;
        $subjects->teacher_id = $request->teacher_id;
        $subjects->save();

        toastr()->success(__('messages.success'));
        return redirect()->route('subjects.index');
    }

    public function edit(Request $request, $id)
    {
        $subject = Subjects::find($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('Subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $subjects = Subjects::find($id);

        $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $subjects->grade_id = $request->Grade_id;
        $subjects->classroom_id = $request->Class_id;
        $subjects->teacher_id = $request->teacher_id;
        $subjects->save();

        toastr()->success(__('messages.Update'));
        return redirect()->route('subjects.index');
    }

    public function destroy($id)
    {
        $subjects = Subjects::find($id);

        if (!$subjects) {
            toastr()->error(__('messages.error'));
            return redirect()->route('subjects.index');
        } else {
            $subjects->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('subjects.index');
        }
    }

    public function classes($id)
    {
        $list_sections = Sections::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }
}
