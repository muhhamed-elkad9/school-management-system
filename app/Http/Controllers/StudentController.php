<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Sections;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $Students = Student::all();
        $Genders = Gender::all();
        $nationals = Nationalitie::all();
        $bloods = Type_Blood::all();
        $my_classes = Grade::all();
        $parents = My_Parent::all();
        $images = Image::all();
        return view('students.students', compact('Students', 'Genders', 'nationals', 'bloods', 'my_classes', 'parents', 'images'));
    }

    public function create()
    {
        $Genders = Gender::all();
        $nationals = Nationalitie::all();
        $bloods = Type_Blood::all();
        $my_classes = Grade::all();
        $parents = My_Parent::all();
        return view('students.create', compact('Genders', 'nationals', 'bloods', 'my_classes', 'parents'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $Students = new Student();

            $Students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $Students->email = $request->email;
            $Students->password = $request->password;
            $Students->gender_id = $request->gender_id;
            $Students->nationalitie_id = $request->nationalitie_id;
            $Students->blood_id = $request->blood_id;
            $Students->Date_Birth = $request->Date_Birth;
            $Students->Grade_id = $request->Grade_id;
            $Students->Classroom_id = $request->Classroom_id;
            $Students->section_id = $request->section_id;
            $Students->parent_id = $request->parent_id;
            $Students->academic_year = $request->academic_year;
            $Students->save();


            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $Students->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $Students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }

            DB::commit();

            toastr()->success(__('messages.success'));
            return redirect()->route('students.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $Students = Student::find($id);
        return view('students.show', compact('Students'));
    }

    public function edit($id)
    {
        $Students = Student::find($id);
        $Genders = Gender::all();
        $nationals = Nationalitie::all();
        $bloods = Type_Blood::all();
        $my_classes = Grade::all();
        $parents = My_Parent::all();

        return view('students.update', compact('Students', 'Genders', 'nationals', 'bloods', 'my_classes', 'parents'));
    }

    public function update(Request $request, $id)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();

            toastr()->success(__('messages.Update'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $Students = Student::find($id);

        if (!$Students) {
            return redirect()->route('students.index')->with(['Err' => __('students/students.Err')]);
        } else {

            $Students->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->route('students.index');
        }
    }

    public function Upload_attachment(Request $request)
    {
        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            $images = new image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }

        toastr()->success(__('messages.success'));
        return redirect()->back();
    }

    public function Download_attachment($studentname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentname . '/' . $filename));
    }

    public function Delete_attachment(Request $request)
    {
        $Images = image::where('id', $request->id)->where('filename', $request->filename);

        if (!$Images) {
            toastr()->error(__('messages.error'));
            return redirect()->back();
        } else {
            Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

            $Images->delete();

            toastr()->success(__('messages.Delete'));
            return redirect()->back();
        }
    }
}
