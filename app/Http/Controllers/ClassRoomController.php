<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Classroom = ClassRoom::all();
        $Grades = Grade::all();
        return view('Classroom.Classroom', compact('Classroom', 'Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Grades = Grade::all();
        return view('Classroom.create', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (ClassRoom::where('Name', $request->List_Classes->Name)->orwhere('Name->en', $request->List_Classes->Name_class_en)->exists()) {

        //     return redirect()->back()->withErrors(['error' => 'اسم المرحلة موجود من قبل']);
        // }

        $listClass = $request->List_Classes;
        foreach ($listClass as $list) {

            ClassRoom::create([
                'Name_Class' => ['en' => $list['Name_class_en'], 'ar' => $list['Name']],
                'Grade_id' => $list['Grade_id'],
            ]);
        }

        return redirect()->route('Classroom.index')->with(['add' => __('Classroom/Classroom.Add')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Classes = ClassRoom::find($id);
        $Grades = Grade::all();

        return view('Classroom.update', compact('Classes', 'Grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $Classes = Classroom::find($id);

        $Classes->update([

            $Classes->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_class_en],
            $Classes->Grade_id = $request->Grade_id,
        ]);

        return redirect()->route('Classroom.index')->with(['edit' => __('ClassRoom/ClassRoom.edit')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ClassRoom = ClassRoom::find($id);

        if (!$ClassRoom) {
            return redirect()->route('Classroom.index')->with(['Err' => __('ClassRoom/ClassRoom.Err')]);
        } else {
            $ClassRoom->delete();

            return redirect()->route('Classroom.index')->with(['deleted' => __('ClassRoom/ClassRoom.deleted')]);
        }
    }

    public function destroySelect(Request $request)
    {
        if (explode(',', $request->delete_all_id)[0] == "on") {
            $delete_all_id = array_slice(explode(',', $request->delete_all_id), 1);

            ClassRoom::whereIn('id', $delete_all_id)->Delete();

            return redirect()->route('Classroom.index')->with(['deleted' => __('ClassRoom/ClassRoom.deleted')]);
        } else {
            $delete_all_id = array_slice(explode(',', $request->delete_all_id), 0);

            ClassRoom::whereIn('id', $delete_all_id)->Delete();

            return redirect()->route('Classroom.index')->with(['deleted' => __('ClassRoom/ClassRoom.deleted')]);
        }
    }

    public function Filter_Classes(Request $request)
    {

        $Grades = Grade::all();

        $search = ClassRoom::select('*')->where('Grade_id', '=', $request->Grade_id)->get();

        return view('Classroom.Classroom', compact('Grades'))->withDetails($search);
    }
}
