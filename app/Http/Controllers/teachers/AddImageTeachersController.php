<?php

namespace App\Http\Controllers\teachers;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageTeachersController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $teacher = Teacher::find(Auth::user()->id);
        if (!$teacher)
            return redirect()->back();

        //////////////// Table student
        if (auth('teacher')->check()) {
            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'attachments/profile/teacher/' . Auth::user()->id);

                $teacher->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('attachments/profile/teacher/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $teacher->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('attachments/profile/teacher/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'attachments/profile/teacher/' . Auth::user()->id);

                $teacher->update([
                    'avatar' => $file_name,
                ]);
            }
        }
        toastr()->success(__('messages.Update'));
        return redirect()->back();
    }
}
