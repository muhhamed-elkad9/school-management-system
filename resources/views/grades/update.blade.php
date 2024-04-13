@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل المرحلة
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل المرحلة
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
                    href="{{ route('grade.index') }}">{{ __('grades/Grades.Back') }}</a>

                <form action="{{ route('grade.update', $Grades->id) }}" method="POST">
                    {{ method_field('POST') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ __('grades/Grades.Name_ar') }}
                                :</label>
                            <input id="Name" type="text" value="{{ $Grades->getTranslation('Name', 'ar') }}"
                                name="Name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ __('grades/Grades.Name_en') }}
                                :</label>
                            <input type="text" value="{{ $Grades->getTranslation('Name', 'en') }}"
                                class="form-control" name="Name_en">
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="exampleFormControlTextarea1">{{ __('grades/Grades.Notes') }}
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{ $Grades->Notes }}</textarea>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('grades/Grades.Save') }}</button>
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
