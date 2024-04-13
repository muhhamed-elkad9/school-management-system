@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة قسم جديد
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة قسم جديد
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

                <form action="{{ route('sections.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="text" name="Name_Section_Ar" class="form-control"
                                placeholder="{{ __('sections/sections.Name_Section_ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="Name_Section_En" class="form-control"
                                placeholder="{{ __('sections/sections.Name_Section_en') }}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName" class="control-label">{{ __('sections/sections.Name_Grade') }}</label>
                        <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected disabled>{{ __('sections/sections.Select_Grade') }}
                            </option>
                            @foreach ($list_Grades as $list_Grade)
                                <option value="{{ $list_Grade->id }}"> {{ $list_Grade->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ __('sections/sections.Name_Class') }}</label>
                        <select name="Class_id" class="custom-select"></select>
                    </div><br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ __('sections/sections.Name_Teacher') }}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                            @endforeach
                        </select>
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

<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('sections/classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Class_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="Class_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
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
