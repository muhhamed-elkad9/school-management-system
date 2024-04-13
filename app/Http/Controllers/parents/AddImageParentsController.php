<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\My_Parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageParentsController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $parent = My_Parent::find(Auth::user()->id);
        if (!$parent)
            return redirect()->back();

        //////////////// Table parent
        if (auth('parent')->check()) {
            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'attachments/profile/parent/' . Auth::user()->id);

                $parent->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('attachments/profile/parent/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $parent->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('attachments/profile/parent/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'attachments/profile/parent/' . Auth::user()->id);

                $parent->update([
                    'avatar' => $file_name,
                ]);
            }
        }
        toastr()->success(__('messages.Update'));
        return redirect()->back();
    }
}
