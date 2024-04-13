@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل الصف
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل الصف
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

                <a class="btn btn-success btn-sm mb-4" role="button" aria-pressed="true"
                    href="{{ route('Classroom.index') }}">{{ __('Classroom/Classroom.Back') }}</a>

                <form action="{{ route('Classroom.update', $Classes->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ __('Classroom/Classroom.Name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="Name" class="form-control"
                                value="{{ $Classes->getTranslation('Name_Class', 'ar') }}" required>
                            <input id="id" type="hidden" name="id" class="form-control"
                                value="{{ $Classes->id }}">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ __('Classroom/Classroom.Name_en') }}
                                :</label>
                            <input type="text" class="form-control"
                                value="{{ $Classes->getTranslation('Name_Class', 'en') }}" name="Name_en" required>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ __('Classroom/Classroom.Name_grade') }}
                            :</label>
                        <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="Grade_id">
                            <option value="{{ $Classes->Grades->id }}">
                                {{ $Classes->Grades->Name }}
                            </option>
                            @foreach ($Grades as $Grade)
                                <option value="{{ $Grade->id }}">
                                    {{ $Grade->Name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('Classroom/Classroom.Save') }}</button>
                    </div>
                </form>

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
