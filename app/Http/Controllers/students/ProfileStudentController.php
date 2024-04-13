<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileStudentController extends Controller
{
    public function index()
    {
        $information = Student::findorFail(auth()->user()->id);
        return view('students.profile.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = Student::findorFail($id);

        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(__('messages.Update'));
        return redirect()->back();
    }
}
