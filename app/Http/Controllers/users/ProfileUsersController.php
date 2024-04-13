<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileUsersController extends Controller
{
    public function index()
    {
        $information = User::findorFail(auth()->user()->id);
        return view('users.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = User::findorFail($id);

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
