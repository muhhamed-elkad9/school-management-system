<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('library.create', compact('grades'));
    }

    public function store(Request $request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $this->uploadFile($request, 'library', 'file_name');

            toastr()->success(__('messages.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $book = Library::find($id);
        $grades = Grade::all();
        return view('library.edit', compact('book', 'grades'));
    }

    public function update(Request $request, $id)
    {
        try {
            $book = Library::find($id);

            $book->title = $request->title;

            if ($request->hasfile('file_name')) {

                $this->deleteFile($book->file_name);

                $this->uploadFile($request, 'library', 'file_name');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();

            toastr()->success(__('messages.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->deleteFile($request->file_name);
        library::destroy($request->id);
        toastr()->success(__('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/' . $filename));
    }
}
