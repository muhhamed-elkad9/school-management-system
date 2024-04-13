<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('grades.Grades', compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreGrades $request)
    {

        if (Grade::where('Name->ar', $request->Name)->orwhere('Name->en', $request->Name_en)->exists()) {

            toastr()->success(__('messages.Err_Grade'));
            return redirect()->back();
        }

        try {
            $validated = $request->validated();

            Grade::create([
                'Name' => ['en' => $request->Name_en, 'ar' => $request->Name],
                'Notes' => $request->Notes,
            ]);

            toastr()->success(__('messages.success'));
            return redirect()->route('grade.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $Grades = Grade::find($id);

        return view('grades.update', compact('Grades'));
    }

    public function update(StoreGrades $request, $id)
    {
        try {
            // $validated = $request->validated();

            // $Grades = Grade::find($id);
            // if (!$Grades)
            //     return redirect()->back();

            // $Grades->update([
            //     'Name' => ['en' => $request->Name_en, 'ar' => $request->Name],
            //     'Notes' => $request->Notes,
            // ]);

            // toastr()->success(__('messages.Update'));
            // return redirect()->route('grade.index');

            return $request;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $My_Class = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');

        if ($My_Class->count() == 0) {
            $Grades = Grade::find($id);

            if (!$Grades) {
                toastr()->error(__('messages.error'));
                return redirect()->route('grade.index');
            } else {
                $Grades->delete();

                toastr()->success(__('messages.Delete'));
                return redirect()->route('grade.index');
            }
        } else {
            toastr()->error(__('messages.Err_Grade'));
            return redirect()->back();
        }
    }
}
