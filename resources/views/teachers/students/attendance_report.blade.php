@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تقرير الحضور والغياب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تقارير الحضور والغياب
@stop
<!-- breadcrumb -->

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('attendance.search') }}" autocomplete="off">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات البحث</h6><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student">الطلاب</label>
                                    <select class="custom-select mr-sm-2" name="student_id">
                                        <option value="0">الكل</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-body datepicker-form">
                                <div class="input-group" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control range-from date-picker-default"
                                        placeholder="تاريخ البداية" required name="from">
                                    <span class="input-group-addon">الي تاريخ</span>
                                    <input class="form-control range-to date-picker-default" placeholder="تاريخ النهاية"
                                        type="text" required name="to">
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            type="submit">{{ __('students/students.Save') }}</button>
                    </form>
                    @isset($Students)
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{ __('students/students.Name') }}</th>
                                        <th class="alert-success">{{ __('students/students.Grade') }}</th>
                                        <th class="alert-success">{{ __('students/students.section') }}</th>
                                        <th class="alert-success">التاريخ</th>
                                        <th class="alert-warning">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $student->students->name }}</td>
                                            <td>{{ $student->grade->Name }}</td>
                                            <td>{{ $student->section->Name_Section }}</td>
                                            <td>{{ $student->attendence_date }}</td>
                                            <td>

                                                @if ($student->attendence_status == 0)
                                                    <span class="btn-danger">غياب</span>
                                                @else
                                                    <span class="btn-success">حضور</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="Delete_Student{{ $student->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            {{ __('students/students.delete_students') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('students.destroy', $student->id) }}"
                                                            method="post">
                                                            @csrf

                                                            <input type="hidden" name="id" value="{{ $student->id }}">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">
                                                                {{ __('Students_trans.Deleted_Student_tilte') }}</h5>
                                                            <input type="text" readonly value="{{ $student->name }}"
                                                                class="form-control">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('Students_trans.Close') }}</button>
                                                                <button
                                                                    class="btn btn-danger">{{ __('Students_trans.submit') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </table>
                        </div>
                    @endisset

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
