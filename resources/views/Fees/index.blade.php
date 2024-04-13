@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الرسوم الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    الرسوم الدراسية
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
                    <a href="{{ route('Fees.create') }}" class="btn btn-success btn-sm" role="button"
                        aria-pressed="true">اضافة رسوم جديدة</a><br><br>
                </div>

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            <div class="row">
                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <div class="d-block d-md-flex justify-content-between">
                                                <div class="d-block">
                                                </div>
                                            </div>
                                            <div class="table-responsive mt-15">
                                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                                    data-page-length="50" style="text-align: center">
                                                    <thead>
                                                        <tr class="alert-success">
                                                            <th>#</th>
                                                            <th>الاسم</th>
                                                            <th>المبلغ</th>
                                                            <th>المرحلة الدراسية</th>
                                                            <th>الصف الدراسي</th>
                                                            <th>السنة الدراسية</th>
                                                            <th>نوع الرسوم</th>
                                                            <th>ملاحظات</th>
                                                            <th>العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Fees as $Fee)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $Fee->title }}</td>
                                                                <td>{{ number_format($Fee->amount, 2) }}</td>
                                                                <td>{{ $Fee->grade->Name }}</td>
                                                                <td>{{ $Fee->classroom->Name_Class }}</td>
                                                                <td>{{ $Fee->year }}</td>
                                                                <td>

                                                                    <?php

                                                                    if ($Fee->Fee_type == 1) {
                                                                        echo 'رسوم دراسية';
                                                                    } else {
                                                                        echo 'رسوم باص';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>{{ $Fee->description }}</td>
                                                                <td>
                                                                    <a href="{{ route('Fees.edit', $Fee->id) }}"
                                                                        class="btn btn-info btn-sm" role="button"
                                                                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#Delete_Fee{{ $Fee->id }}"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>



                                                            <!-- Deleted inFormation Student -->
                                                            <div class="modal fade" id="Delete_Fee{{ $Fee->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                class="modal-title" id="exampleModalLabel">
                                                                                حذف بيانات الرسوم
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('Fees.destroy', $Fee->id) }}"
                                                                                method="get">
                                                                                @csrf

                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $Fee->id }}">
                                                                                <h5
                                                                                    style="font-family: 'Cairo', sans-serif;">
                                                                                    هل انت متاكد مع عملية الحذف ؟</h5>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">اغلاق</button>
                                                                                    <button
                                                                                        class="btn btn-danger">حفظ</button>
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

            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
