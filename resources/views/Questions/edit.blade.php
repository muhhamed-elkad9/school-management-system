@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل سؤال
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل سؤال :<span class="text-danger">{{ $questions->title }}</span>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('questions.update', $questions->id) }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-row">

                                <div class="col">
                                    <label for="title">اسم السؤال</label>
                                    <input type="text" name="title" id="input-name"
                                        class="form-control form-control-alternative" value="{{ $questions->title }}">

                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">الاجابات</label>
                                    <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ $questions->answers }}</textarea>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">الاجابة الصحيحة</label>
                                    <input type="text" name="right_answer" id="input-name"
                                        class="form-control form-control-alternative"
                                        value="{{ $questions->right_answer }}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">الدرجة : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="score">
                                            <option selected disabled> حدد الدرجة...</option>
                                            <option value="5" {{ $questions->score == 5 ? 'selected' : '' }}>5
                                            </option>
                                            <option value="10" {{ $questions->score == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="15" {{ $questions->score == 15 ? 'selected' : '' }}>15
                                            </option>
                                            <option value="20" {{ $questions->score == 20 ? 'selected' : '' }}>20
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
                                البيانات</button>
                        </form>
                    </div>
                </div>
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
