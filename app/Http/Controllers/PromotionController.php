<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index()
    {
        $Grades = Grade::all();
        return view('promotion.index', compact('Grades'));
    }

    public function create()
    {
        $promotions = promotion::all();
        return view('promotion.create', compact('promotions'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $students = student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();

            if ($students->count() < 1) {

                toastr()->success(__('messages.Err_Graduated'));
                return redirect()->back();
            }

            // update in table student
            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                // insert in to promotions
                promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            toastr()->success(__('messages.Update'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $promotions = promotion::all();
        if ($request->page_id == 1) {
            foreach ($promotions as $promotion) {
                $ids = explode(',', $promotion->student_id);
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $promotion->from_grade,
                        'Classroom_id' => $promotion->from_Classroom,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);


                promotion::truncate();
            }
            toastr()->success(__('messages.Delete'));
            return redirect()->back();
        } else {
            $promotions = promotion::findorfail($request->id);

            student::where('id', $promotions->student_id)
                ->update([
                    'Grade_id' => $promotions->from_grade,
                    'Classroom_id' => $promotions->from_Classroom,
                    'section_id' => $promotions->from_section,
                    'academic_year' => $promotions->academic_year,
                ]);

            promotion::destroy($request->id);

            toastr()->success(__('messages.Delete'));
            return redirect()->back();
        }
    }

    public function Graduated(Request $request, $id)
    {
        // $students = Student::find($id);

        // Student::where('id', $id)->Delete();
        // return redirect()->back()->with(['deleted' => __('students/students.deleted')]);

        // return $students;
    }
}
