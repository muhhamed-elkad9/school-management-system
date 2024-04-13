<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Models\My_Parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileParentController extends Controller
{
    public function index()
    {
        $information = My_Parent::findorFail(auth()->user()->id);
        return view('parents.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = My_Parent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_Father_en, 'ar' => $request->Name_Father_ar];
            $information->Name_Mother = ['en' => $request->Name_Mother_en, 'ar' => $request->Name_Mother_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_Father_en, 'ar' => $request->Name_Father_ar];
            $information->Name_Mother = ['en' => $request->Name_Mother_en, 'ar' => $request->Name_Mother_ar];
            $information->save();
        }
        toastr()->success(__('messages.Update'));
        return redirect()->back();
    }
}
