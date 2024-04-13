@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل بيانات الطالب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل بيانات الطالب
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

                        <a class="btn btn-success btn-sm mb-4" role="button" aria-pressed="true"
                            href="{{ route('students.index') }}">{{ __('students/students.Back') }}</a>
                        <br>


                        <form method="post" action="{{ route('students.update', $Students->id) }}" autocomplete="off">
                            @csrf
                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                                {{ __('students/students.personal_information') }}</h6><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Name_ar') }} : <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name_ar"
                                            value="{{ $Students->getTranslation('name', 'ar') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Name_en') }} : <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="name_en"
                                            value="{{ $Students->getTranslation('name', 'en') }}" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Email') }} : </label>
                                        <input type="email" name="email" value="{{ $Students->email }}"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('students/students.Password') }} :</label>
                                        <input type="password" name="password" value="{{ $Students->password }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">{{ __('students/students.Gender') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="gender_id">
                                            <option disabled>{{ __('students/students.Gender_Choose') }}...
                                            </option>
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->gender->Name }}
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
                                            <option disabled>
                                                {{ __('students/students.Nationality_Choose') }}...</option>
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->nationalitie->Name }}
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
                                            <option disabled>
                                                {{ __('students/students.blood_type_Choose') }}...</option>
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->blood->Name }}
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
                                            name="Date_Birth" value="{{ $Students->Date_Birth }}"
                                            data-date-format="yyyy-mm-dd">
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
                                            <option disabled>{{ __('students/students.Grade_Choose') }}...</option>
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->Grades->Name }}</option>
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
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->classroom->Name_Class }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="section_id">{{ __('students/students.section') }} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->Sections->Name_Section }}</option>
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
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->parent->Name_Father }}</option>
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
                                            <option selected value="{{ $Students->id }}">
                                                {{ $Students->academic_year }}</option>
                                            @php
                                                $current_year = date('Y');
                                            @endphp
                                            @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
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

<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('students/Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Classroom_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id"]').append(
                                '<option selected disabled >{{ __('students/students.classrooms_Choose') }}...</option>'
                            );
                            $('select[name="Classroom_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('students/Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
