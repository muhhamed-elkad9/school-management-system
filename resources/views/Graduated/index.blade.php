@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة المتخرجين
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة المتخرجين
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ __('students/students.Name') }}</th>
                                            <th>{{ __('students/students.Email') }}</th>
                                            <th>{{ __('students/students.Gender') }}</th>
                                            <th>{{ __('students/students.Grade') }}</th>
                                            <th>{{ __('students/students.classrooms') }}</th>
                                            <th>{{ __('students/students.section') }}</th>
                                            <th>{{ __('students/students.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->gender->Name }}</td>
                                                <td>{{ $student->Grades->Name }}</td>
                                                <td>{{ $student->classroom->Name_Class }}</td>
                                                <td>{{ $student->Sections->Name_Section }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Return_Student{{ $student->id }}"
                                                        title="{{ __('students/students.return_students') }}">{{ __('students/students.return_students') }}</button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_Student{{ $student->id }}"
                                                        title="{{ __('students/students.delete_students') }}">{{ __('students/students.delete_students') }}</button>

                                                </td>
                                            </tr>

                                            <!-- Return inFormation Student -->
                                            <div class="modal fade" id="Return_Student{{ $student->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('students/students.return_students') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('Graduated.update', $student->id) }}"
                                                                method="post" autocomplete="off">

                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $student->id }}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ __('students/students.Returning_students') }}
                                                                </h5>
                                                                <input type="text" readonly
                                                                    value="{{ $student->name }}" class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('students/students.Close') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ __('students/students.Save') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_Student{{ $student->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('students/students.delete_students') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('Graduated.destroy', $student->id) }}"
                                                                method="get">
                                                                @csrf


                                                                <input type="hidden" name="id"
                                                                    value="{{ $student->id }}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ __('students/students.Warning_students') }}
                                                                </h5>
                                                                <input type="text" readonly
                                                                    value="{{ $student->name }}" class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('students/students.Close') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ __('students/students.Save') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                </table>
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
