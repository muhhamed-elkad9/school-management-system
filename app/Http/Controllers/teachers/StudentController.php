<?php

namespace App\Http\Controllers\teachers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Sections;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('teachers.students.index', compact('students'));
    }

    public function sections()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $sections = Sections::whereIn('id', $ids)->get();
        return view('teachers.sections.index', compact('sections'));
    }

    public function attendance(Request $request)
    {
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentid,
                        'attendence_date' => date('Y-m-d'),
                    ],
                    [
                        'student_id' => $studentid,
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                        'teacher_id' => 1,
                        'attendence_date' => date('Y-m-d'),
                        'attendence_status' => $attendence_status
                    ]
                );
            }

            toastr()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function attendance_report()
    {

        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('teachers.students.attendance_report', compact('students'));
    }

    public function attendance_Search(Request $request)
    {

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => __('validation.after_or_equal'),
            'from.date_format' => __('validation.date_format'),
            'to.date_format' => __('validation.date_format'),
        ]);


        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('teachers.students.attendance_report', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('teachers.students.attendance_report', compact('Students', 'students'));
        }
    }
}
