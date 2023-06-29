@extends('layouts.master')
@section('css')

@section('title')
    {{ __('sections/sections.edit_Sections') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ __('sections/sections.edit_Sections') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ __('sections/sections.sections') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('sections/sections.Sections_list') }}</li>
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
                msg: '{{ __('sections/sections.Add') }}',
                type: "success"
            })
        }
    </script>
@endif


@if (session()->has('Err'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('sections/sections.Err') }}',
                type: "success"
            })
        }
    </script>
@endif

@if (session()->has('deleted'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('sections/sections.deleted') }}',
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
                    href="{{ route('sections.index') }}">{{ __('sections/sections.Back') }}</a>
                <form action="{{ route('sections.update', $Section->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="text" name="Name_Section_Ar" class="form-control"
                                value="{{ $Section->getTranslation('Name_Section', 'ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="Name_Section_En" class="form-control"
                                value="{{ $Section->getTranslation('Name_Section', 'en') }}">
                            <input id="id" type="hidden" name="id" class="form-control"
                                value="{{ $Section->id }}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName" class="control-label">{{ __('sections/sections.Name_Grade') }}</label>
                        <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="{{ $Section->Grade->id }}">
                                {{ $Section->Grade->Name }}
                            </option>
                            @foreach ($list_Grades as $list_Grade)
                                <option value="{{ $list_Grade->id }}">
                                    {{ $list_Grade->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ __('sections/sections.Name_Class') }}</label>
                        <select name="Class_id" class="custom-select">
                            <option value="{{ $Section->ClassRooms->id }}">
                                {{ $Section->ClassRooms->Name_Class }}
                            </option>
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <div class="form-check">

                            @if ($Section->Status === 1)
                                <input type="checkbox" checked class="form-check-input" name="Status"
                                    id="exampleCheck1">
                            @else
                                <input type="checkbox" class="form-check-input" name="Status" id="exampleCheck1">
                            @endif
                            <label class="form-check-label"
                                for="exampleCheck1">{{ __('sections/sections.Status') }}</label><br>

                            {{-- <div class="col">
                                    <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                                    <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                        @foreach ($list_Sections->teachers as $teacher)
                                            <option selected value="{{$teacher['id']}}">{{$teacher['Name']}}</option>
                                        @endforeach

                                        @foreach ($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('sections/sections.Save') }}</button>
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
