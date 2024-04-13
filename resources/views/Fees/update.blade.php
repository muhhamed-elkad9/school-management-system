@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل رسوم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل رسوم
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('Fees.update', $Fees->id) }}" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">الاسم باللغة العربية</label>
                            <input type="text" value="{{ $Fees->getTranslation('title', 'ar') }}" name="title_ar"
                                class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for="inputEmail4">الاسم باللغة الانجليزية</label>
                            <input type="text" value="{{ $Fees->getTranslation('title', 'en') }}" name="title_en"
                                class="form-control">
                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">المبلغ</label>
                            <input type="number" value="{{ $Fees->amount }}" name="amount" class="form-control">
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputState">المرحلة الدراسية</label>
                            <select class="custom-select mr-sm-2" name="Grade_id">
                                <option disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                <option selected value="{{ $Fees->Grade_id }}">{{ $Fees->grade->Name }}</option>
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">الصف الدراسي</label>
                            <select class="custom-select mr-sm-2" name="Classroom_id">
                                <option value="{{ $Fees->Classroom_id }}">{{ $Fees->classroom->Name_Class }}</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip">السنة الدراسية</label>
                            <select class="custom-select mr-sm-2" name="year">
                                <option disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                <option selected value="{{ $Fees->year }}">{{ $Fees->year }}</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">نوع الرسوم</label>
                            <select class="custom-select mr-sm-2" name="Fee_type">
                                <option value="{{ $Fees->Fee_type }}">

                                    <?php
                                    
                                    if ($Fees->Fee_type == 1) {
                                        echo 'رسوم دراسية';
                                    } else {
                                        echo 'رسوم باص';
                                    }
                                    ?>

                                </option>
                                <option value="1">رسوم دراسية</option>
                                <option value="2">رسوم باص</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">ملاحظات</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{ $Fees->description }}</textarea>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">تاكيد</button>

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
