<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Teacher;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddExam;
use App\User;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{

    public function index()
    {
        $quizzes = Quizze::all();
        return view('Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $subjects = Subjects::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('Quizzes.create', compact('subjects', 'teachers', 'grades'));
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id', $id)->get();
        $quizz = Quizze::findorFail($id);
        return view('Questions.index', compact('quizz', 'questions'));
    }

    public function store(Request $request)
    {
        $quizzes = new Quizze();

        $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $quizzes->subject_id = $request->subject_id;
        $quizzes->grade_id = $request->Grade_id;
        $quizzes->classroom_id = $request->Classroom_id;
        $quizzes->section_id = $request->section_id;
        $quizzes->teacher_id = $request->teacher_id;
        $quizzes->save();


        $user = User::get();
        $quizzes_id = Quizze::latest()->first();
        Notification::send($user, new AddExam($quizzes_id));

        toastr()->success(__('messages.success'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $quizzes = Quizze::find($id);
        $subjects = Subjects::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('Quizzes.edit', compact('quizzes', 'subjects', 'teachers', 'grades'));
    }

    public function update(Request $request, $id)
    {
        $quizzes = Quizze::find($id);

        $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $quizzes->subject_id = $request->subject_id;
        $quizzes->grade_id = $request->Grade_id;
        $quizzes->classroom_id = $request->Classroom_id;
        $quizzes->section_id = $request->section_id;
        $quizzes->teacher_id = $request->teacher_id;
        $quizzes->save();

        toastr()->success(__('messages.Update'));
        return redirect()->route('Quizzes.index');
    }

    public function destroy($id)
    {
        $quizzes = Quizze::find($id);

        if (!$quizzes) {
            toastr()->error(__('messages.error'));
            return redirect()->route('Quizzes.index');
        } else {
            $quizzes->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('Quizzes.index');
        }
    }

    public function classes($id)
    {
        $list_sections = Sections::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    public function MarkAsRead_all(Request $request)
    {
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
