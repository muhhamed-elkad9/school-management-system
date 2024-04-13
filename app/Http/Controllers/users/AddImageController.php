<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if (!$user)
            return redirect()->back();

        //////////////// Table Admin
        if (auth('web')->check()) {

            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'attachments/profile/Admin/' . Auth::user()->id);

                $user->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('attachments/profile/Admin/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $user->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('attachments/profile/Admin/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'attachments/profile/Admin/' . Auth::user()->id);

                $user->update([
                    'avatar' => $file_name,
                ]);
            }
        }

        toastr()->success(__('messages.Update'));
        return redirect()->back();
    }
}
