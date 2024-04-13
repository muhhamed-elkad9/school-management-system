<?php

namespace App\Http\Controllers;

use App\Models\FoundAccount;
use App\Models\PaymentStudents;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentStudentsController extends Controller
{

    public function index()
    {
        $payment_students = PaymentStudents::all();
        return view('PaymentStudents.index', compact('payment_students'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $payment_students = new PaymentStudents();
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول صندوق الطلاب
            $Found_accounts = new FoundAccount();
            $Found_accounts->date = date('Y-m-d');
            $Found_accounts->payment_id = $payment_students->id;
            $Found_accounts->Debit = 0.00;
            $Found_accounts->credit = $request->Debit;
            $Found_accounts->description = $request->description;
            $Found_accounts->save();

            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'Payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Request $request, $id)
    {
        $student = Student::find($id);
        return view('PaymentStudents.add', compact('student'));
    }

    public function edit($id)
    {
        $payment_student = PaymentStudents::find($id);
        return view('PaymentStudents.edit', compact('payment_student'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $payment_students = PaymentStudents::find($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();

            // حفظ البيانات في جدول صندوق الطلاب
            $Found_accounts = FoundAccount::where('payment_id', $request->id)->first();
            $Found_accounts->date = date('Y-m-d');
            $Found_accounts->payment_id = $payment_students->id;
            $Found_accounts->Debit = 0.00;
            $Found_accounts->credit = $request->Debit;
            $Found_accounts->description = $request->description;
            $Found_accounts->save();

            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('payment_id', $request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'Payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            toastr()->success(__('messages.update'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            PaymentStudents::destroy($id);
            toastr()->success(__('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
