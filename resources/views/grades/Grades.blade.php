@extends('layouts.master')
@section('css')

@endsection
@section('title')
    {{ __('grades/Grades.Greades') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('grades/Grades.Greades') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('grades/Grades.Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('grades/Grades.Greades') }}</li>
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
                    msg: '{{ __('grades/Grades.Add') }}',
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('Err_Grade'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('grades/Grades.Err_Grade') }}',
                    type: "error"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('grades/Grades.deleted') }}',
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

                    <a class="button x-small" href="{{ route('grade.create') }}">
                        {{ __('grades/Grades.add_Grade') }}
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('grades/Grades.Name') }}</th>
                                    <th>{{ __('grades/Grades.Notes') }}</th>
                                    <th>{{ __('grades/Grades.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($Grades as $Grade)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Grade->Name }}</td>
                                        <td>{{ $Grade->Notes }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('grade.edit', $Grade->id) }}"
                                                title="{{ __('grades/Grades.Edit') }}"><i class="fa fa-edit"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $Grade->id }}"
                                                title="{{ __('grades/Grades.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>



                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ __('grades/Grades.delete_grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('grade.destroy', $Grade->id) }}" method="get">
                                                        @csrf
                                                        {{ __('grades/Grades.Warning_Grade') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $Grade->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('grades/Grades.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('grades/Grades.Delete') }}</button>
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
    <!-- row closed -->
@endsection
@section('js')

@endsection
