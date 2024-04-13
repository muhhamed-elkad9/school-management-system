<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\online_classes;
use App\Http\Traits\MeetingZoomTrait;
use Illuminate\Http\Request;

class OnlineClassesController extends Controller
{
    use MeetingZoomTrait;

    public function index()
    {
        $online_classes = online_classes::where('created_by', auth()->user()->email)->get();
        return view('online_classes.index', compact('online_classes'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('online_classes.add', compact('Grades'));
    }

    public function store(Request $request)
    {
        try {

            $meeting = $this->createMeeting($request);
            online_classes::create([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);

            toastr()->success(__('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
