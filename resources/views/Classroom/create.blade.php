@extends('layouts.master')
@section('css')

@section('title')
    {{ __('Classroom/Classroom.add_Class') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ __('Classroom/Classroom.add_Class') }}</h4>
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

                <form class=" row mb-30" action="{{ route('Classroom.store') }}" method="POST" autocomplete="on">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ __('Classroom/Classroom.Name_ar') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name" />
                                        </div>


                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ __('Classroom/Classroom.Name_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name_class_en" />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ __('Classroom/Classroom.Name_grade') }}
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="Grade_id">
                                                    @foreach ($Grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ __('Classroom/Classroom.Processes') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                value="{{ __('Classroom/Classroom.Delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12 mb-4">
                                    <input class="button" data-repeater-create type="button"
                                        value="{{ __('Classroom/Classroom.add_row') }}" />
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit"
                                    class="btn btn-success">{{ __('Classroom/Classroom.Save') }}</button>
                            </div>


                        </div>
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
