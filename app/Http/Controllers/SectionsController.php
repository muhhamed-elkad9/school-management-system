<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Sections;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher  = $Teacher;
    }


    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        return view('sections.sections', compact('Grades', 'list_Grades'));
    }

    public function create()
    {
        $list_Grades = Grade::all();
        $teachers = $this->Teacher->getAllTeachers();
        return view('sections.create', compact('list_Grades', 'teachers'));
    }

    public function store(Request $request)
    {
        $Sections = new Sections();

        $Sections->Name_Section = ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;
        $Sections->Status = 1;
        $Sections->save();
        $Sections->teachers()->attach($request->teacher_id);

        toastr()->success(__('messages.success'));
        return redirect()->route('sections.index');
    }

    public function edit($id)
    {
        $Section = Sections::find($id);
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();

        $teachers = $this->Teacher->getAllTeachers();

        return view('sections.update', compact('Section', 'Grades', 'list_Grades', 'teachers'));
    }

    public function update(Request $request, $id)
    {

        $Sections = Sections::find($id);


        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;

        if (!isset($request->Status)) {
            $Sections->Status = 2;
        } else {
            $Sections->Status = 1;
        };


        // update pivot tABLE
        if (isset($request->teacher_id)) {
            $Sections->teachers()->sync($request->teacher_id);
        } else {
            $Sections->teachers()->sync(array());
        }

        $Sections->save();

        toastr()->success(__('messages.Update'));
        return redirect()->route('sections.index');
    }

    public function destroy($id)
    {
        $Sections = Sections::find($id);

        if (!$Sections) {
            toastr()->error(__('messages.error'));
            return redirect()->route('sections.index');
        } else {
            $Sections->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('sections.index');
        }
    }


    public function getclasses($id)
    {
        $list_classes = Classroom::where('Grade_id', $id)->pluck('Name_Class', 'id');

        return $list_classes;
    }
}
