<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quizze;
use App\Models\Sections;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{

    // public function index()
    // {
    //     $questions = Question::all();
    //     return view('Questions.index', compact('questions'));
    // }

    // public function create()
    // {
    //     $quizzes = Quizze::all();
    //     return view('Questions.create', compact('quizzes'));
    // }

    public function store(Request $request)
    {
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizz_id;
            $question->save();
            toastr()->success(__('messages.success'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $quizz_id = $id;
        return view('Questions.create', compact('quizz_id'));
    }

    public function edit($id)
    {
        $questions = Question::find($id);
        // $quizzes = Quizze::all();
        return view('Questions.edit', compact('questions'));
    }

    public function update(Request $request, $id)
    {
        try {
            $question = Question::findorfail($id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->save();
            toastr()->success(__('messages.Update'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Question::destroy($id);
            toastr()->error(__('messages.Delete'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
