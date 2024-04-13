<?php

namespace App\Http\Controllers\teachers;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Teacher;
use App\Notifications\AddExam;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->user()->id)->get();
        return view('teachers.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subjects::where('teacher_id', auth()->user()->id)->get();
        return view('teachers.Quizzes.create', $data);
    }

    public function store(Request $request)
    {
        $quizzes = new Quizze();

        $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $quizzes->subject_id = $request->subject_id;
        $quizzes->grade_id = $request->Grade_id;
        $quizzes->classroom_id = $request->Classroom_id;
        $quizzes->section_id = $request->section_id;
        $quizzes->teacher_id = auth()->user()->id;
        $quizzes->save();

        $user = User::get();
        // $teacher = Teacher::get();
        $quizzes_id = Quizze::latest()->first();
        Notification::send($user, new AddExam($quizzes_id));

        toastr()->success(__('messages.success'));
        return redirect()->route('quizze.index');
    }

    public function edit($id)
    {
        $quizzes = Quizze::find($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subjects::where('teacher_id', auth()->user()->id)->get();
        return view('teachers.Quizzes.edit', compact('quizzes'), $data);
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id', $id)->get();
        $quizz = Quizze::findorFail($id);
        return view('teachers.Questions.index', compact('questions', 'quizz'));
    }

    public function update(Request $request, $id)
    {
        try {
            $quizzes = Quizze::find($id);

            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();

            toastr()->success(__('messages.Update'));
            return redirect()->route('quizze.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $quizzes = Quizze::find($id);

        if (!$quizzes) {
            toastr()->error(__('messages.error'));
            return redirect()->route('quizze.index');
        } else {
            $quizzes->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('quizze.index');
        }
    }

    // public function getClassrooms($id)
    // {
    //     $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

    //     return $list_classes;
    // }

    // public function getSections($id)
    // {
    //     $list_sections = Sections::where("Class_id", $id)->pluck("Name_Section", "id");
    //     return $list_sections;
    // }

    public function student_quizze($quizze_id)
    {
        $degrees = Degree::where('quizze_id', $quizze_id)->get();
        return view('teachers.Quizzes.student_quizze', compact('degrees'));
    }

    public function repeat_quizze(Request $request)
    {
        Degree::where('student_id', $request->student_id)->where('quizze_id', $request->quizze_id)->delete();
        toastr()->success('تم فتح الاختبار مرة اخرى للطالب');
        return redirect()->back();
    }
}
