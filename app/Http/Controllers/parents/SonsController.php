<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SonsController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return view('parents.children.index', compact('students'));
    }

    public function results($id)
    {
        $student = Student::findorFail($id);
        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error(__('messages.error'));
            return redirect()->route('sons.index');
        }

        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error(__('messages.Empty'));
            return redirect()->route('sons.index');
        }

        return view('parents.degrees.index', compact('degrees'));
    }

    public function attendances()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('parents.Attendance.index', compact('students'));
    }

    public function attendances_Search(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => __('validation.after_or_equal'),
            'from.date_format' => __('validation.after_or_equal'),
            'to.date_format' => __('validation.after_or_equal'),
        ]);


        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('parents.Attendance.index', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('parents.Attendance.index', compact('Students', 'students'));
        }
    }

    public function fees()
    {
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = Fee_invoice::whereIn('student_id', $students_ids)->get();
        return view('parents.fees.index', compact('Fee_invoices'));
    }

    public function receipt($id)
    {
        $student = Student::findorFail($id);
        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error(__('messages.error'));
            return redirect()->route('sons.index');
        }

        $receipt_students = ReceiptStudent::where('student_id', $id)->get();

        if ($receipt_students->isEmpty()) {
            toastr()->error(__('messages.EmptyPayments'));
            return redirect()->route('sons.fees');
        }
        return view('parents.Receipt.index', compact('receipt_students'));
    }
}
