@extends('layouts.master')
@section('css')

@endsection
@section('title')
    {{ __('teachers/teachers.Teachers_List') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('teachers/teachers.Teachers_List') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ __('teachers/teachers.Teachers') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('teachers/teachers.Teachers_List') }}</li>
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
                    msg: '{{ __('teachers/teachers.Add') }}',
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('teachers/teachers.Err') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('teachers/teachers.deleted') }}',
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
                    <a class="button x-small" href="{{ route('teachers.create') }}">
                        {{ __('teachers/teachers.add_Teachers') }}</a>
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
                                                <table class="table center-aligned-table mb-0">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>{{ __('teachers/teachers.Name_Teachers') }}</th>
                                                            <th>{{ __('teachers/teachers.Gender') }}</th>
                                                            <th>{{ __('teachers/teachers.Joining_Date') }}</th>
                                                            <th>{{ __('teachers/teachers.Specialization') }}</th>
                                                            <th>{{ __('teachers/teachers.Processes') }}</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($Teachers as $Teacher)
                                                            <tr>
                                                                <?php $i++; ?>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $Teacher->Name }}</td>
                                                                <td>{{ $Teacher->genders->Name }}</td>
                                                                <td>{{ $Teacher->Joining_Date }}</td>
                                                                <td>{{ $Teacher->Specialization->Name }}</td>

                                                                <td>

                                                                    <a class="btn btn-info btn-sm"
                                                                        href="{{ route('teachers.edit', $Teacher->id) }}"
                                                                        title="{{ __('teachers/teachers.Edit') }}"><i
                                                                            class="fa fa-edit"></i></a>

                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#delete{{ $Teacher->id }}"
                                                                        title="{{ __('teachers/teachers.Delete') }}"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>


                                                            <!-- delete_modal_Grade -->
                                                            <div class="modal fade" id="delete{{ $Teacher->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                class="modal-title" id="exampleModalLabel">
                                                                                {{ __('teachers/teachers.delete_Teachers') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('teachers.destroy', $Teacher->id) }}"
                                                                                method="get">
                                                                                @csrf
                                                                                {{ __('teachers/teachers.Warning_Teachers') }}
                                                                                <input id="id" type="hidden"
                                                                                    name="id" class="form-control"
                                                                                    value="{{ $Teacher->id }}">
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ __('teachers/teachers.Close') }}</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">{{ __('teachers/teachers.Delete') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
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

@endsection
