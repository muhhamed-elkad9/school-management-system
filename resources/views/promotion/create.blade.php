@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    ادارة ترقية الطلاب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    ادارة ترقية الطلاب
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

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                تراجع الكل
                            </button>
                            <br><br>


                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{ __('promotion/promotion.Name') }}</th>
                                            <th class="alert-danger">{{ __('promotion/promotion.Grade_Old') }}</th>
                                            <th class="alert-danger">{{ __('promotion/promotion.academic_year_Old') }}
                                            </th>
                                            <th class="alert-danger">{{ __('promotion/promotion.classrooms_Old') }}
                                            </th>
                                            <th class="alert-danger">{{ __('promotion/promotion.section_Old') }}</th>
                                            <th class="alert-success">{{ __('promotion/promotion.Grade_New') }}</th>
                                            <th class="alert-success">{{ __('promotion/promotion.academic_year_New') }}
                                            </th>
                                            <th class="alert-success">{{ __('promotion/promotion.classrooms_New') }}
                                            </th>
                                            <th class="alert-success">{{ __('promotion/promotion.section_New') }}</th>
                                            <th>{{ __('promotion/promotion.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $promotion->students->name }}</td>
                                                {{-- <td>{{ $promotion->students->getTranslation('name', 'ar') }}</td> --}}

                                                <td>{{ $promotion->Grade->Name }}</td>
                                                <td>{{ $promotion->academic_year }}</td>
                                                <td>{{ $promotion->Classroom->Name_Class }}
                                                </td>
                                                <td>{{ $promotion->Sections->Name_Section }}
                                                </td>
                                                <td>{{ $promotion->Grades->Name }}</td>
                                                <td>{{ $promotion->academic_year_new }}</td>
                                                <td>{{ $promotion->Classrooms->Name_Class }}
                                                </td>
                                                <td>{{ $promotion->Sectionss->Name_Section }}
                                                </td>
                                                <td>

                                                    <button type="button" class="btn btn-outline-danger mb-2"
                                                        data-toggle="modal"
                                                        data-target="#Delete_one{{ $promotion->id }}">ارجاع
                                                        الطالب</button>
                                                    <button type="button" class="btn btn-outline-success"
                                                        data-toggle="modal"
                                                        data-target="#Graduated{{ $promotion->id }}">تخرج
                                                        الطالب</button>
                                                </td>
                                            </tr>

                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_all" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('promotion/promotion.return_all_students') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('promotion.destroy') }}"
                                                                method="post">
                                                                @csrf

                                                                <input type="hidden" name="page_id" value="1">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ __('promotion/promotion.Returning_studentss') }}
                                                                </h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('promotion/promotion.Close') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ __('promotion/promotion.Save') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_one{{ $promotion->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('promotion/promotion.return_students') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('promotion.destroy') }}"
                                                                method="post">
                                                                @csrf

                                                                <input type="hidden" name="id"
                                                                    value="{{ $promotion->id }}">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{ __('promotion/promotion.Returning_students') }}
                                                                    ({{ $promotion->students->name }})
                                                                </h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('promotion/promotion.Close') }}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{ __('promotion/promotion.Save') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                </table>
                            </div>
                        </div>
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
