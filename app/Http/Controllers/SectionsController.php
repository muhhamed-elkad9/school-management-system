<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Sections;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        return view('sections.sections', compact('Grades', 'list_Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_Grades = Grade::all();
        return view('sections.create', compact('list_Grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Sections::create([
            'Name_Section' => ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar],
            'Grade_id' => $request->Grade_id,
            'Class_id' => $request->Class_id,
            'Status' => 1,
        ]);

        return redirect()->route('sections.index')->with(['add' => __('sections/sections.Add')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Section = Sections::find($id);
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();

        return view('sections.update', compact('Section', 'Grades', 'list_Grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $Sections = Sections::find($id);


        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;

        if (!isset($request->Status)) {
            $Sections->Status = 2;
        } else {
            $Sections->Status = 1;
        };

        $Sections->save();

        return redirect()->route('sections.index')->with(['edit' => __('sections/sections.edit')]);

        // return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Sections = Sections::find($id);

        if (!$Sections) {
            return redirect()->route('sections.index')->with(['Err' => __('sections/sections.Err')]);
        } else {
            $Sections->delete();

            return redirect()->route('sections.index')->with(['deleted' => __('sections/sections.deleted')]);
        }
    }


    public function getclasses($id)
    {
        $list_classes = Classroom::where('Grade_id', $id)->pluck('Name_Class', 'id');

        return $list_classes;
    }
}
