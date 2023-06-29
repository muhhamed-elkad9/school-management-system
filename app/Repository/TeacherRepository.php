<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function Getspecialization()
    {
        return specialization::all();
    }

    public function GetGender()
    {
        return Gender::all();
    }

    public function StoreTeachers($request)
    {
        Teacher::create([
            'Email' => $request->Email,
            'Password' => $request->Password,
            'Name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
        ]);
    }

    public function editTeachers($id)
    {
        return Teacher::find($id);
    }

    public function UpdateTeachers($request, $id)
    {
        $Teachers = Teacher::find($id);

        $Teachers->update([

            'Email' => $request->Email,
            'Password' => $request->Password,
            'Name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
        ]);
    }

    public function DeleteTeachers($id)
    {

        $Teachers = Teacher::find($id);

        $Teachers->delete();
    }
}
