<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageStudentsController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $student = Student::find(Auth::user()->id);
        if (!$student)
            return redirect()->back();

        //////////////// Table student
        if (auth('student')->check()) {
            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'attachments/profile/student/' . Auth::user()->id);

                $student->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('attachments/profile/student/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $student->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('attachments/profile/student/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'attachments/profile/student/' . Auth::user()->id);

                $student->update([
                    'avatar' => $file_name,
                ]);
            }
        }
        toastr()->success(__('messages.Update'));
        return redirect()->back();
    }
}
