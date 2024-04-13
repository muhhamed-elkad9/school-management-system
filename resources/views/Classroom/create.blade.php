@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة صف جديد
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة صف جديد
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
@toastr_js
@toastr_render
@endsection
