@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل القسم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل القسم
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

                            <div class="col">
                                <label for="inputName"
                                    class="control-label">{{ __('sections/sections.Name_Teacher') }}</label><br>
                                <select multiple name="teacher_id[]" class="form-control"
                                    id="exampleFormControlSelect2">
                                    @foreach ($Section->teachers as $teacher)
                                        <option selected value="{{ $teacher['id'] }}">{{ $teacher['Name'] }}</option>
                                    @endforeach

                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
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

@toastr_js
@toastr_render
@endsection
