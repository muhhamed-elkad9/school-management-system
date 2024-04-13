@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة طالب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة طالب
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

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="col-xs-12">
                    <div class="col-md-12">

                        <form method="post" action="{{ route('students.store') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                                {{ __('students/students.personal_information') }}</h6><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Name_ar') }} : <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name_ar" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Name_en') }} : <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="name_en" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Email') }} : </label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Password') }} :</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">{{ __('students/students.Gender') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="gender_id">
                                            <option selected disabled>{{ __('students/students.Gender_Choose') }}...
                                            </option>
                                            @foreach ($Genders as $Gender)
                                                <option value="{{ $Gender->id }}">{{ $Gender->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nal_id">{{ __('students/students.Nationality') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="nationalitie_id">
                                            <option selected disabled>
                                                {{ __('students/students.Nationality_Choose') }}...</option>
                                            @foreach ($nationals as $nal)
                                                <option value="{{ $nal->id }}">{{ $nal->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bg_id">{{ __('students/students.blood_type') }} : </label>
                                        <select class="custom-select mr-sm-2" name="blood_id">
                                            <option selected disabled>
                                                {{ __('students/students.blood_type_Choose') }}...</option>
                                            @foreach ($bloods as $bg)
                                                <option value="{{ $bg->id }}">{{ $bg->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Date_of_Birth') }} :</label>
                                        <input class="form-control" type="text" id="datepicker-action"
                                            name="Date_Birth" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>

                            </div>

                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                                {{ __('students/students.Student_information') }}</h6><br>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ __('students/students.Grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Grade_id">
                                            <option selected disabled>{{ __('students/students.Grade_Choose') }}...
                                            </option>
                                            @foreach ($my_classes as $c)
                                                <option value="{{ $c->id }}">{{ $c->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Classroom_id">{{ __('students/students.classrooms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Classroom_id">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="section_id">{{ __('students/students.section') }} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="parent_id">{{ __('students/students.parent') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="parent_id">
                                            <option selected disabled>{{ __('students/students.parent_Choose') }}...
                                            </option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->Name_Father }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{ __('students/students.academic_year') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year">
                                            <option selected disabled>
                                                {{ __('students/students.academic_year_Choose') }}...</option>
                                            @php
                                                $current_year = date('Y');
                                            @endphp
                                            @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{ __('students/students.Attachments') }} : <span
                                                class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" name="photos[]" multiple>
                                    </div>
                                </div>
                            </div><br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ __('students/students.Save') }}</button>
                        </form>
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
