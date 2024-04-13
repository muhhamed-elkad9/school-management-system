<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('grade_id', auth()->user()->Grade_id)
            ->where('classroom_id', auth()->user()->Classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('students.exam.index', compact('quizzes'));
    }

    public function show($quizze_id)
    {
        $student_id = Auth::user()->id;
        return view('students.exam.show', compact('quizze_id', 'student_id'));
    }
}
