@extends('layouts.master')
@section('css')

@section('title')
    {{ __('grades/Grades.edit_Grade') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ __('grades/Grades.edit_Grade') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('grades/Grades.Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('grades/Grades.Greades') }}</li>
            </ol>
        </div>
    </div>
</div>
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

@if (session()->has('add'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('grades/Grades.Add') }}',
                type: "success"
            })
        }
    </script>
@endif


@if (session()->has('Err'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('grades/Grades.Err') }}',
                type: "success"
            })
        }
    </script>
@endif

@if (session()->has('deleted'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('grades/Grades.deleted') }}',
                type: "success"
            })
        }
    </script>
@endif

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <a class="button x-small mb-4" href="{{ route('grade.index') }}">{{ __('grades/Grades.Back') }}</a>

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

@endsection
