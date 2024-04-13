@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة الطلاب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة الطلاب
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
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{ route('students.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ __('students/students.add_students') }}</a><br><br>

                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('students/students.Name') }}</th>
                                            <th>{{ __('students/students.Email') }}</th>
                                            <th>{{ __('students/students.Gender') }}</th>
                                            <th>{{ __('students/students.Grade') }}</th>
                                            <th>{{ __('students/students.classrooms') }}</th>
                                            <th>{{ __('students/students.section') }}</th>
                                            <th>{{ __('students/students.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($Students as $Student)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $Student->name }}</td>
                                                <td>{{ $Student->email }}</td>
                                                <td>{{ $Student->gender->Name }}</td>
                                                <td>{{ $Student->Grades->Name }}</td>
                                                <td>{{ $Student->classroom->Name_Class }}</td>
                                                <td>{{ $Student->Sections->Name_Section }}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ __('students/students.Processes') }}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                            <a class="dropdown-item"
                                                                href="{{ route('students.show', $Student->id) }}"><i
                                                                    style="color: #ffc107"
                                                                    class="far fa-eye "></i>&nbsp;
                                                                {{ __('students/students.Show') }}</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('students.edit', $Student->id) }}"><i
                                                                    style="color:green" class="fa fa-edit"></i>&nbsp;
                                                                {{ __('students/students.edit_students') }}</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('Fees_Invoices.show', $Student->id) }}"><i
                                                                    style="color: #0000cc"
                                                                    class="fa fa-edit"></i>&nbsp;اضافة
                                                                فاتورة رسوم&nbsp;</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('Receipt_Student.show', $Student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fas fa-money-bill-alt"></i>&nbsp;
                                                                &nbsp;سند قبض</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('ProcessingFee.show', $Student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fas fa-money-bill-alt"></i>&nbsp;
                                                                &nbsp; استبعاد رسوم</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('Payment_students.show', $Student->id) }}"><i
                                                                    style="color:goldenrod"
                                                                    class="fas fa-donate"></i>&nbsp;
                                                                &nbsp;سند صرف</a>

                                                            <a class="dropdown-item"
                                                                data-target="#delete{{ $Student->id }}"
                                                                data-toggle="modal"
                                                                href="##delete{{ $Student->id }}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                {{ __('students/students.Delete') }}</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            <!-- delete_modal_Grade -->
                                            <div class="modal fade" id="delete{{ $Student->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{ __('students/students.delete_students') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('students.destroy', $Student->id) }}"
                                                                method="get">
                                                                @csrf
                                                                {{ __('students/students.Warning_students') }}
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $Student->id }}">

                                                                {{-- @foreach ($images as $attachment)
                                                                    <input type="text" name="student_id"
                                                                        value="{{ $attachment->id }}">
                                                                    <input type="text" name="student_name"
                                                                        value="{{ $attachment->filename }}">
                                                                @endforeach --}}

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('students/students.Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ __('students/students.Delete') }}</button>
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
