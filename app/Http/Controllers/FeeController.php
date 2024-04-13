<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{
    public function index()
    {
        $Fees = Fee::all();
        return view('Fees.index', compact('Fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('Fees.create', compact('Grades'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $Fees = new Fee();

            $Fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $Fees->amount = $request->amount;
            $Fees->Grade_id = $request->Grade_id;
            $Fees->Classroom_id = $request->Classroom_id;
            $Fees->year = $request->year;
            $Fees->Fee_type = $request->Fee_type;
            $Fees->description = $request->description;
            $Fees->save();

            DB::commit();

            toastr()->success(__('messages.success'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $Grades = Grade::all();
        $Fees = Fee::find($id);
        return view('Fees.update', compact('Grades', 'Fees'));
    }

    public function update(Request $request, $id)
    {
        try {

            $Fees = Fee::find($id);
            $Fees->update([

                'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount' => $request->amount,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'year' => $request->year,
                'Fee_type' => $request->Fee_type,
                'description' => $request->description,
            ]);


            toastr()->success(__('messages.Update'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $Fees = Fee::find($id);
        if (!$Fees) {
            toastr()->error(__('messages.error'));
            return redirect()->route('Fees.index');
        } else {

            $Fees->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('Fees.index');
        }
    }
}
