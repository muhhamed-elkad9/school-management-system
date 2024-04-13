@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    عرض بيانات الطالب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    عرض بيانات الطالب
@stop
<!-- breadcrumb -->
@endsection
@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{ __('students/students.Student_information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02"
                                    aria-selected="false">{{ __('students/students.Attachments') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ __('students/students.Name') }}</th>
                                            <td>{{ $Students->name }}</td>
                                            <th scope="row">{{ __('students/students.Email') }}</th>
                                            <td>{{ $Students->email }}</td>
                                            <th scope="row">{{ __('students/students.Gender') }}</th>
                                            <td>{{ $Students->gender->Name }}</td>
                                            <th scope="row">{{ __('students/students.Nationality') }}</th>
                                            <td>{{ $Students->nationalitie->Name }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ __('students/students.Grade') }}</th>
                                            <td>{{ $Students->Grades->Name }}</td>
                                            <th scope="row">{{ __('students/students.classrooms') }}</th>
                                            <td>{{ $Students->classroom->Name_Class }}</td>
                                            <th scope="row">{{ __('students/students.section') }}</th>
                                            <td>{{ $Students->Sections->Name_Section }}</td>
                                            <th scope="row">{{ __('students/students.Date_of_Birth') }}</th>
                                            <td>{{ $Students->Date_Birth }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ __('students/students.parent') }}</th>
                                            <td>{{ $Students->parent->Name_Father }}</td>
                                            <th scope="row">{{ __('students/students.academic_year') }}</th>
                                            <td>{{ $Students->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('students.Upload_attachment') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        for="academic_year">{{ __('students/students.Attachments') }}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple
                                                        required>
                                                    <input type="hidden" name="student_name"
                                                        value="{{ $Students->name }}">
                                                    <input type="hidden" name="student_id"
                                                        value="{{ $Students->id }}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{ __('students/students.Save') }}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('students/students.filename') }}</th>
                                                <th scope="col">{{ __('students/students.created_at') }}</th>
                                                <th scope="col">{{ __('students/students.Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Students->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $attachment->filename }}</td>
                                                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{ url('students/Download_attachment') }}/{{ $attachment->imageable->name }}/{{ $attachment->filename }}"
                                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                                            {{ __('students/students.Download') }}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_img{{ $attachment->id }}"
                                                            title="{{ __('students/students.Delete') }}">{{ __('students/students.Delete') }}
                                                        </button>

                                                    </td>
                                                </tr>

                                                <!-- Deleted inFormation Student -->
                                                <div class="modal fade" id="Delete_img{{ $attachment->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">
                                                                    {{ __('students/students.Delete_attachment') }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('students.Delete_attachment') }}"
                                                                    method="get">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $attachment->id }}">

                                                                    <input type="hidden" name="student_name"
                                                                        value="{{ $attachment->imageable->name }}">
                                                                    <input type="hidden" name="student_id"
                                                                        value="{{ $attachment->imageable->id }}">

                                                                    <h5 style="font-family: 'Cairo', sans-serif;">
                                                                        {{ __('students/students.Delete_attachment_tilte') }}
                                                                    </h5>
                                                                    <input type="text" name="filename" readonly
                                                                        value="{{ $attachment->filename }}"
                                                                        class="form-control">

                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('students/students.Close') }}</button>
                                                                        <button
                                                                            class="btn btn-danger">{{ __('students/students.Delete') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
