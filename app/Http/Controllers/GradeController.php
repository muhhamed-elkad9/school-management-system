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

            return redirect()->back()->withErrors(['error' => 'اسم المرحلة موجود من قبل']);
        }

        try {
            $validated = $request->validated();

            Grade::create([
                'Name' => ['en' => $request->Name_en, 'ar' => $request->Name],
                'Notes' => $request->Notes,
            ]);

            return redirect()->route('grade.index')->with(['add' => __('grades/Grades.Add')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $Grades = Grade::find($id);

        return view('grades.update', compact('Grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(StoreGrades $request, $id)
    {
        // try {
        $validated = $request->validated();

        $Grades = Grade::find($id);
        if (!$Grades)
            return redirect()->back();

        $Grades->update([
            'Name' => ['en' => $request->Name_en, 'ar' => $request->Name],
            'Notes' => $request->Notes,
        ]);

        return redirect()->route('grade.index')->with(['edit' => __('grades/Grades.edit')]);
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $My_Class = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');



        if ($My_Class->count() == 0) {
            $Grades = Grade::find($id);

            if (!$Grades) {
                return redirect()->route('grade.index')->with(['Err' => __('grades/Grades.Err')]);
            } else {
                $Grades->delete();

                return redirect()->route('grade.index')->with(['deleted' => __('grades/Grades.deleted')]);
            }
        } else {
            return redirect()->back()->with(['Err_Grade' => __('grades/Grades.Err_Grade')]);
        }
    }
}
