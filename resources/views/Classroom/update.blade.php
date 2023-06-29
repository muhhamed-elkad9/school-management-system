@extends('layouts.master')
@section('css')

@section('title')
    {{ __('Classroom/Classroom.edit_Class') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ __('Classroom/Classroom.edit_Class') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ __('Classroom/Classroom.Classroom') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('Classroom/Classroom.Classes_list') }}</li>
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
                msg: '{{ __('Classroom/Classroom.Add') }}',
                type: "success"
            })
        }
    </script>
@endif


@if (session()->has('Err'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('Classroom/Classroom.Err') }}',
                type: "success"
            })
        }
    </script>
@endif

@if (session()->has('deleted'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('Classroom/Classroom.deleted') }}',
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

                <a class="button x-small mb-4"
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

@endsection
