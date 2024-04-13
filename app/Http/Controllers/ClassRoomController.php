<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $Classroom = ClassRoom::all();
        $Grades = Grade::all();
        return view('Classroom.Classroom', compact('Classroom', 'Grades'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('Classroom.create', compact('Grades'));
    }

    public function store(Request $request)
    {
        $listClass = $request->List_Classes;
        foreach ($listClass as $list) {

            ClassRoom::create([
                'Name_Class' => ['en' => $list['Name_class_en'], 'ar' => $list['Name']],
                'Grade_id' => $list['Grade_id'],
            ]);
        }

        toastr()->success(__('messages.success'));
        return redirect()->route('Classroom.index');
    }

    public function edit($id)
    {
        $Classes = ClassRoom::find($id);
        $Grades = Grade::all();

        return view('Classroom.update', compact('Classes', 'Grades'));
    }

    public function update(Request $request, $id)
    {

        $Classes = Classroom::find($id);

        $Classes->update([

            $Classes->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_class_en],
            $Classes->Grade_id = $request->Grade_id,
        ]);

        toastr()->success(__('messages.Update'));
        return redirect()->route('Classroom.index');
    }

    public function destroy($id)
    {
        $ClassRoom = ClassRoom::find($id);

        if (!$ClassRoom) {
            toastr()->error(__('messages.error'));
            return redirect()->route('Classroom.index')->with(['Err' => __('ClassRoom/ClassRoom.Err')]);
        } else {
            $ClassRoom->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('Classroom.index');
        }
    }

    public function destroySelect(Request $request)
    {
        if (explode(',', $request->delete_all_id)[0] == "on") {
            $delete_all_id = array_slice(explode(',', $request->delete_all_id), 1);

            ClassRoom::whereIn('id', $delete_all_id)->Delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('Classroom.index');
        } else {
            $delete_all_id = array_slice(explode(',', $request->delete_all_id), 0);

            ClassRoom::whereIn('id', $delete_all_id)->Delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('Classroom.index');
        }
    }

    public function Filter_Classes(Request $request)
    {

        $Grades = Grade::all();

        $search = ClassRoom::select('*')->where('Grade_id', '=', $request->Grade_id)->get();

        return view('Classroom.Classroom', compact('Grades'))->withDetails($search);
    }
}
